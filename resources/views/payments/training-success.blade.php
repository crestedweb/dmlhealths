@extends('layouts.app')

@section('content')
<main style="max-width:760px;margin:60px auto;padding:32px 22px;text-align:center;color:#173a5f">
    @if($paid)
        <h1>Payment received</h1>
        <p>Thank you for your purchase. We’ve emailed your confirmation and will send the next steps for your online course.</p>
    @else
        <h1>We’re confirming your payment</h1>
        <p>Your checkout returned successfully, and Stripe is still confirming the payment. We’ll email you when it is confirmed.</p>
    @endif
    <a href="{{ route('cpr-training') }}" style="display:inline-block;margin-top:16px;padding:12px 20px;border-radius:6px;background:#0052a4;color:#fff;text-decoration:none">Back to CPR training</a>
</main>
@endsection
