<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Stripe\Checkout\Session as CheckoutSession;
use Stripe\Exception\SignatureVerificationException;
use Stripe\StripeClient;
use Stripe\Webhook;
use UnexpectedValueException;

class TrainingPaymentController extends Controller
{
    public function checkout(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190'],
            'phone' => ['required', 'string', 'max:40'],
            'course' => ['required', 'string', 'max:190'],
            'training_option' => ['required', 'string', 'max:190'],
            'message' => ['nullable', 'string', 'max:2500'],
            'website' => ['nullable', 'max:0'],
        ]);
        unset($data['website']);

        if (! config('services.stripe.key')) {
            return back()->withInput()->withErrors([
                'payment' => 'Online checkout is not configured yet. Please send a training request or contact us for help.',
            ]);
        }

        $offer = collect(config('training_courses'))
            ->first(fn (array $course) => $course['name'] === $data['course']);
        $option = collect($offer['pricing_options'] ?? [])
            ->first(fn (array $item) => $item['name'] === $data['training_option'] && $item['format'] === 'Online course');

        if (! $option) {
            return back()->withInput()->withErrors([
                'training_option' => 'Online payment is available only for the online course option. Please submit a training request for in-person or hybrid training.',
            ]);
        }

        $orderId = DB::table('training_orders')->insertGetId([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'course' => $data['course'],
            'training_option' => $option['name'],
            'amount_cents' => (int) round($option['price'] * 100),
            'currency' => 'usd',
            'status' => 'pending',
            'message' => $data['message'] ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        try {
            $session = (new StripeClient(config('services.stripe.key')))->checkout->sessions->create([
                'mode' => 'payment',
                'customer_email' => $data['email'],
                'client_reference_id' => (string) $orderId,
                'metadata' => ['training_order_id' => (string) $orderId],
                'line_items' => [[
                    'quantity' => 1,
                    'price_data' => [
                        'currency' => 'usd',
                        'unit_amount' => (int) round($option['price'] * 100),
                        'product_data' => ['name' => $option['name']],
                    ],
                ]],
                'success_url' => route('cpr-training.payment-success', absolute: true).'?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('cpr-training', absolute: true).'?payment=cancelled#training-enquiry',
            ]);

            DB::table('training_orders')->where('id', $orderId)->update([
                'stripe_checkout_session_id' => $session->id,
                'updated_at' => now(),
            ]);

            return redirect()->away($session->url);
        } catch (\Throwable $exception) {
            DB::table('training_orders')->where('id', $orderId)->update([
                'status' => 'checkout_error',
                'updated_at' => now(),
            ]);
            Log::error('Stripe CPR training checkout could not be created.', [
                'training_order_id' => $orderId,
                'error' => $exception->getMessage(),
            ]);

            return back()->withInput()->withErrors([
                'payment' => 'We could not start checkout right now. Please try again or send a training request.',
            ]);
        }
    }

    public function success(Request $request): View
    {
        $data = $request->validate(['session_id' => ['required', 'string', 'max:255']]);
        $order = DB::table('training_orders')
            ->where('stripe_checkout_session_id', $data['session_id'])
            ->first();

        abort_if(! $order, 404);

        return view('payments.training-success', ['paid' => $order->status === 'paid']);
    }

    public function webhook(Request $request)
    {
        $secret = config('services.stripe.webhook_secret');
        abort_if(! $secret, 503, 'Stripe webhook is not configured.');

        try {
            $event = Webhook::constructEvent(
                $request->getContent(),
                (string) $request->header('Stripe-Signature'),
                $secret,
            );
        } catch (UnexpectedValueException|SignatureVerificationException $exception) {
            return response('Invalid Stripe webhook.', 400);
        }

        if (! in_array($event->type, ['checkout.session.completed', 'checkout.session.async_payment_succeeded'], true)) {
            return response()->json(['received' => true]);
        }

        /** @var CheckoutSession $session */
        $session = $event->data->object;
        $orderId = $session->metadata->training_order_id ?? null;
        if (! $orderId || $session->payment_status !== 'paid') {
            return response()->json(['received' => true]);
        }

        $notification = DB::transaction(function () use ($orderId, $session) {
            $order = DB::table('training_orders')->where('id', $orderId)->lockForUpdate()->first();
            if (! $order || $order->status === 'paid') {
                return null;
            }

            if ((int) $session->amount_total !== (int) $order->amount_cents
                || strtolower((string) $session->currency) !== strtolower((string) $order->currency)
                || ($order->stripe_checkout_session_id && $session->id !== $order->stripe_checkout_session_id)) {
                Log::warning('Stripe payment did not match its CPR training order.', [
                    'training_order_id' => $orderId,
                    'stripe_session_id' => $session->id,
                ]);
                return null;
            }

            DB::table('training_orders')->where('id', $orderId)->update([
                'status' => 'paid',
                'stripe_checkout_session_id' => $session->id,
                'stripe_payment_intent_id' => is_string($session->payment_intent) ? $session->payment_intent : null,
                'paid_at' => now(),
                'updated_at' => now(),
            ]);

            $order->status = 'paid';
            return $order;
        });

        if ($notification) {
            $this->sendPaymentNotifications($notification);
        }

        return response()->json(['received' => true]);
    }

    private function sendPaymentNotifications(object $order): void
    {
        $details = implode(PHP_EOL, [
            'Payment status: PAID',
            'Amount: $'.number_format($order->amount_cents / 100, 2).' USD',
            'Course: '.$order->course,
            'Option: '.$order->training_option,
            'Name: '.$order->name,
            'Email: '.$order->email,
            'Phone: '.$order->phone,
            'Customer note: '.($order->message ?: 'None'),
        ]);

        try {
            Mail::raw("Thank you. Your payment has been received. Our training team will email you with the next steps for your online course.\n\n{$details}", function ($mail) use ($order) {
                $mail->to($order->email)
                    ->replyTo(config('site.contact.support_email'))
                    ->subject('Payment received: '.$order->course);
            });
        } catch (\Throwable $exception) {
            Log::error('CPR training payment confirmation email failed.', ['training_order_id' => $order->id, 'error' => $exception->getMessage()]);
        }

        try {
            Mail::raw($details, function ($mail) use ($order) {
                $mail->to(config('site.contact.support_email'))
                    ->replyTo($order->email, $order->name)
                    ->subject('CPR course payment received: '.$order->course);
            });
        } catch (\Throwable $exception) {
            Log::error('CPR training paid-order notification email failed.', ['training_order_id' => $order->id, 'error' => $exception->getMessage()]);
        }
    }
}
