<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function create() { return view('pages.contact'); }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'], 'email' => ['required', 'email', 'max:190'],
            'phone' => ['nullable', 'string', 'max:40'], 'subject' => ['required', 'string', 'max:160'],
            'reason' => ['required', 'in:Residential Care,Services,Partnership,Donation,Volunteer,General Inquiry'],
            'message' => ['required', 'string', 'max:4000'], 'website' => ['nullable', 'max:0'],
        ]);
        unset($data['website']);
        DB::table('contact_messages')->insert($data + ['created_at' => now(), 'updated_at' => now()]);
        try {
            Mail::raw($this->contactMessageBody($data), function ($message) use ($data) {
                $message->to(config('site.contact.support_email'))
                    ->replyTo($data['email'], $data['name'])
                    ->subject('Website contact: ' . $data['subject']);
            });
            return back()->with('status', 'Thank you. Your message has been received.');
        } catch (\Throwable $exception) {
            Log::error('Contact message email delivery failed.', [
                'recipient' => config('site.contact.support_email'),
                'subject' => $data['subject'],
                'error' => $exception->getMessage(),
            ]);
            return back()->with('status', 'Your message was saved, but email delivery is temporarily unavailable. We will review it shortly.');
        }
    }

    private function contactMessageBody(array $data): string
    {
        return implode(PHP_EOL, [
            'A new contact message was submitted through the DMI Healths website.',
            '',
            'Name: ' . $data['name'],
            'Email: ' . $data['email'],
            'Phone: ' . ($data['phone'] ?: 'Not provided'),
            'Reason: ' . $data['reason'],
            'Subject: ' . $data['subject'],
            '',
            'Message:',
            $data['message'],
        ]);
    }

    public function requestInfo() { return view('pages.request-information'); }

    public function storeTraining(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190'],
            'phone' => ['required', 'string', 'max:40'],
            'course' => ['required', 'in:BLS & BLS Renewal,ACLS & ACLS Renewal,PALS & PALS Renewal,AHA Bundle Courses,First Aid/CPR/AED,Pediatric First Aid/CPR/AED (Childcare),Online Only Courses,Group Training'],
            'training_type' => ['required', 'in:Individual,Group / workplace'],
            'payment_preference' => ['required', 'in:Online card payment,Bank transfer'],
            'message' => ['nullable', 'string', 'max:2500'],
            'website' => ['nullable', 'max:0'],
        ]);
        unset($data['website']);

        $contact = [
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'subject' => 'CPR training enquiry: ' . $data['course'],
            'reason' => 'Services',
            'message' => "Course: {$data['course']}\nTraining type: {$data['training_type']}\nPayment preference: {$data['payment_preference']}\n\n" . ($data['message'] ?: 'No additional details provided.'),
        ];

        DB::table('contact_messages')->insert($contact + ['created_at' => now(), 'updated_at' => now()]);

        try {
            Mail::raw($this->contactMessageBody($contact), function ($message) use ($contact) {
                $message->to(config('site.contact.support_email'))
                    ->replyTo($contact['email'], $contact['name'])
                    ->subject($contact['subject']);
            });
        } catch (\Throwable $exception) {
            Log::error('CPR training enquiry email delivery failed.', ['error' => $exception->getMessage()]);
        }

        return back()->with('status', 'Thank you. Our training team will confirm availability with you shortly.');
    }

    public function storeInfo(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'], 'email' => ['required', 'email', 'max:190'], 'phone' => ['nullable', 'string', 'max:40'],
            'preferred_contact_method' => ['required', 'in:Email,Phone'], 'support_area' => ['required', 'string', 'max:120'],
            'message' => ['nullable', 'string', 'max:2500'], 'website' => ['nullable', 'max:0'],
        ]);
        unset($data['website']);
        DB::table('information_requests')->insert($data + ['created_at' => now(), 'updated_at' => now()]);
        return back()->with('status', 'Thank you. We will be in touch using your preferred method.');
    }

    public function subscribe(Request $request): RedirectResponse
    {
        $data = $request->validate(['email' => ['required', 'email', 'max:190']]);
        DB::table('newsletter_subscribers')->updateOrInsert(['email' => $data['email']], ['consented_at' => now(), 'updated_at' => now(), 'created_at' => now()]);
        return back()->with('status', 'Thank you for subscribing.');
    }
}
