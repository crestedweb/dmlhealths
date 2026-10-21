@extends('layouts.app')

@section('content')
<style>
  body:has(.training-course-page){background:#f6f9fc}
  body:has(.training-course-page)>header,body:has(.training-course-page)>.site-footer{display:none!important}
  body:has(.training-course-page) #main{width:100%;max-width:none;margin:0;padding:0}
  .course-site-header{position:relative;z-index:5;background:#fff;border-bottom:1px solid #0b4f91}
  .course-site-top{height:70px;max-width:1500px;margin:0 auto;padding:0 5%;display:flex;align-items:center;justify-content:space-between;gap:18px}
  .course-site-logo{display:flex;align-items:center;gap:9px;flex:0 0 auto;color:#111;font-size:17px;font-weight:800;text-decoration:none}
  .course-site-logo img{width:52px;height:52px;object-fit:contain}
  .course-site-logo b{color:#1c8577}
  .course-site-actions{display:flex;gap:9px;align-items:center}
  .course-site-actions a{display:inline-flex;min-height:42px;align-items:center;padding:0 17px;border-radius:5px;background:#05265f;color:#fff;font-weight:700;text-decoration:none;white-space:nowrap}
  .course-site-actions a:last-child{background:#0052a4}
  .course-site-nav{min-height:42px;padding:0 16px;display:flex;align-items:center;justify-content:center;gap:38px;border-top:1px solid #e5edf5}
  .course-site-nav a{color:#202020;font-size:15px;font-weight:700;text-decoration:none;white-space:nowrap}.course-site-nav .course-consultation-link{padding:8px 13px;border:1px solid #08746f;border-radius:999px;background:#08746f;color:#fff;font-weight:800;transition:background .15s,color .15s,box-shadow .15s}.course-site-nav .course-consultation-link:hover{background:#075e5a;border-color:#075e5a;color:#fff;box-shadow:0 3px 10px rgba(8,116,111,.18)}
  .course-site-menu{display:none;width:44px;height:44px;align-items:center;justify-content:center;border:1px solid #d5e0eb;border-radius:8px;background:#fff;color:#123761;font-size:22px}
  .course-site-footer{padding:25px max(5%,calc((100% - 1440px)/2));background:#41474d;color:#e8edf1}
  .course-site-footer-inner{display:flex;flex-wrap:wrap;justify-content:space-between;gap:15px 25px}
  .course-site-footer p{margin:0;font-size:13px;line-height:1.7}
  .course-site-footer a{color:#fff}
  .training-course-page{--course-blue:#0b376d;--course-accent:#087e83;background:#f6f9fc;color:#16324b;padding:34px 20px 72px}
  .training-course-wrap{width:min(1160px,100%);margin:0 auto}
  .training-course-crumbs{display:flex;gap:9px;align-items:center;margin:0 0 22px;color:#67809a;font-size:13px}
  .training-course-crumbs a{color:#07569c;font-weight:700;text-decoration:none}
  .training-course-crumbs a:hover{text-decoration:underline}
  .training-course-hero{display:grid;grid-template-columns:minmax(0,1.02fr) minmax(360px,.98fr);gap:34px;align-items:center;padding:34px;background:#fff;border:1px solid #e3ebf3;border-radius:22px;box-shadow:0 16px 42px rgba(15,50,82,.08)}
  .training-course-kicker{margin:0 0 12px;color:var(--course-accent);font-size:12px;font-weight:800;letter-spacing:.14em;text-transform:uppercase}
  .training-course-hero h1{margin:0 0 15px;color:var(--course-blue);font-size:clamp(34px,4vw,52px);line-height:1.08;letter-spacing:-.035em}
  .training-course-summary{margin:0;color:#50667a;font-size:17px;line-height:1.7}
  .training-course-actions{display:flex;gap:12px;flex-wrap:wrap;margin-top:24px}
  .training-course-actions a{display:inline-flex;min-height:48px;align-items:center;justify-content:center;padding:0 18px;border-radius:9px;font-weight:750;text-decoration:none}
  .training-course-primary{background:#0758a5;color:white;box-shadow:0 6px 15px rgba(7,88,165,.18)}
  .training-course-secondary{border:1px solid #cbd9e7;color:#184a78;background:#fff}
  .training-course-location{display:flex;gap:9px;align-items:center;margin:18px 0 0;color:#60788e;font-size:13px}
  .training-course-location strong{color:#274f70}
  .training-course-photo{margin:0;min-width:0}
  .training-course-photo img{display:block;width:100%;height:350px;object-fit:cover;border-radius:15px;background:#e8eff5}
  .training-course-photo figcaption{margin-top:8px;color:#718397;font-size:11px;text-align:right}
  .training-course-photo figcaption a{color:#55728e}
  .training-course-info{display:grid;grid-template-columns:1fr 1fr;gap:18px;margin-top:22px}
  .training-course-panel{padding:25px 28px;background:#fff;border:1px solid #e3ebf3;border-radius:16px}
  .training-course-panel h2{margin:0 0 12px;color:var(--course-blue);font-size:21px}
  .training-course-panel p{margin:0;color:#526a80;font-size:15px;line-height:1.7}
  .training-course-panel ul{display:grid;gap:10px;margin:0;padding-left:20px;color:#526a80;font-size:14px;line-height:1.6}
  .training-course-note{margin-top:18px;padding:18px 20px;border-left:4px solid #0b8b8a;border-radius:8px;background:#eaf5f5;color:#365d68;font-size:14px;line-height:1.6}
  .training-pricing{margin-top:24px;padding:clamp(24px,4vw,42px);border:1px solid #e0eaf2;border-radius:20px;background:linear-gradient(145deg,#fff,#f8fbff);box-shadow:0 14px 36px rgba(15,50,82,.07)}
  .training-pricing-heading{display:flex;align-items:flex-end;justify-content:space-between;gap:20px;margin-bottom:22px}
  .training-pricing-kicker{margin:0 0 8px;color:#0b8580;font-size:11px;font-weight:850;letter-spacing:.16em;text-transform:uppercase}
  .training-pricing-heading h2{margin:0;color:var(--course-blue);font-size:clamp(25px,3vw,35px);line-height:1.15;letter-spacing:-.025em}
  .training-pricing-heading p{max-width:330px;margin:0;color:#657b90;font-size:13px;line-height:1.55}
  .training-pricing-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:15px}
  .training-price-card{position:relative;display:flex;flex-direction:column;min-width:0;padding:21px;border:1px solid #dfe8f0;border-radius:15px;background:#fff;box-shadow:0 7px 20px rgba(17,53,85,.05)}
  .training-price-format{align-self:flex-start;margin:0 0 14px;padding:6px 10px;border-radius:999px;background:#e9f5f5;color:#087978;font-size:11px;font-weight:800}
  .training-price-card h3{margin:0 0 9px;color:#153b65;font-size:17px;line-height:1.35}
  .training-price-description{min-height:42px;margin:0 0 14px;color:#63788d;font-size:13px;line-height:1.55}
  .training-price-amount{display:flex;align-items:baseline;gap:7px;margin:0 0 17px;color:#0b376d}
  .training-price-amount strong{font-size:34px;line-height:1;font-weight:850;letter-spacing:-.04em}
  .training-price-amount span{color:#718397;font-size:12px;font-weight:700}
  .training-price-contact{margin:0 0 17px;color:#0b376d;font-size:21px;font-weight:850;line-height:1.25;letter-spacing:-.02em}
  .training-price-request{display:flex;align-items:center;justify-content:center;gap:8px;min-height:46px;margin-top:auto;padding:9px 12px;border-radius:9px;background:#0758a5;color:#fff;text-align:center;text-decoration:none;font-size:13px;font-weight:800;line-height:1.35;transition:background .15s ease,transform .15s ease}
  .training-price-request:hover{background:#064783;transform:translateY(-1px)}
  .training-price-footnote{margin:15px 0 0;color:#718397;font-size:12px;line-height:1.55}
  .training-course-bottom{display:flex;align-items:center;justify-content:space-between;gap:20px;margin-top:22px;padding:26px 30px;border-radius:16px;background:var(--course-blue);color:#fff}
  .training-course-bottom h2{margin:0 0 6px;font-size:22px}
  .training-course-bottom p{margin:0;color:#d5e3f1;font-size:14px;line-height:1.5}
  .training-course-bottom a{flex:0 0 auto;display:inline-flex;min-height:48px;align-items:center;padding:0 18px;border-radius:9px;background:#fff;color:#123b66;font-weight:800;text-decoration:none}
  @media(max-width:800px){.training-course-page{padding:22px 14px 48px}.training-course-hero{grid-template-columns:1fr;gap:23px;padding:24px}.training-course-photo{grid-row:1}.training-course-photo img{height:clamp(210px,52vw,340px)}.training-course-hero h1{font-size:clamp(31px,8vw,44px)}.training-course-summary{font-size:15px}.training-course-info{grid-template-columns:1fr}.training-course-bottom{align-items:flex-start;flex-direction:column;padding:22px}.training-course-bottom h2{font-size:20px}.training-pricing-grid{grid-template-columns:repeat(2,minmax(0,1fr))}.training-pricing-heading{align-items:flex-start;flex-direction:column;gap:9px}}
  .training-course-page,.training-course-page *{box-sizing:border-box}
  .training-course-wrap,.training-course-hero>div,.training-course-panel{min-width:0}
  .training-course-hero h1,.training-course-crumbs span,.training-course-panel,.training-course-note{overflow-wrap:anywhere}
  @media(max-width:520px){.training-course-page{padding:18px 12px 36px}.training-course-crumbs{gap:6px;margin-bottom:14px;font-size:12px;flex-wrap:wrap}.training-course-hero{gap:17px;padding:16px;border-radius:15px}.training-course-photo img{height:clamp(190px,58vw,270px);border-radius:11px}.training-course-kicker{font-size:10px;letter-spacing:.1em}.training-course-hero h1{font-size:clamp(29px,9vw,38px)}.training-course-summary{font-size:15px;line-height:1.55}.training-course-actions{display:grid;grid-template-columns:1fr;gap:9px;margin-top:18px}.training-course-actions a{width:100%;min-height:48px;padding:10px 12px;text-align:center}.training-course-location{align-items:flex-start;font-size:12px;line-height:1.5}.training-course-info{gap:12px;margin-top:14px}.training-course-panel{padding:19px 17px;border-radius:13px}.training-course-panel h2{font-size:19px}.training-course-panel p,.training-course-panel ul{font-size:14px}.training-course-note{padding:15px 16px;font-size:13px}.training-course-bottom{gap:15px;margin-top:14px;padding:19px;border-radius:13px}.training-course-bottom h2{font-size:19px}.training-course-bottom a{width:100%;min-height:48px;justify-content:center;text-align:center}.training-course-photo figcaption{text-align:left;line-height:1.5}.training-pricing{margin-top:15px;padding:18px 15px;border-radius:15px}.training-pricing-heading{margin-bottom:16px}.training-pricing-heading h2{font-size:25px}.training-pricing-heading p{font-size:12px}.training-pricing-grid{grid-template-columns:1fr;gap:10px}.training-price-card{padding:17px}.training-price-description{min-height:0}.training-price-amount strong{font-size:32px}.training-price-request{min-height:48px;font-size:14px}}
  @media(max-width:760px){.course-site-top{height:60px;padding:0 14px}.course-site-logo{font-size:14px}.course-site-logo img{width:44px;height:44px}.course-site-actions{margin-left:auto}.course-site-actions a{min-height:38px;padding:0 10px;font-size:12px}.course-site-menu{display:inline-flex;flex:0 0 auto}.course-site-nav{display:none;align-items:stretch;gap:0;padding:6px 18px 12px;flex-direction:column}.course-site-nav.is-open{display:flex}.course-site-nav a{padding:12px 0;border-bottom:1px solid #e8edf2;font-size:14px}.course-site-nav a:last-child{border-bottom:0}}
  @media(max-width:420px){.course-site-top{gap:8px;padding:0 10px}.course-site-logo{gap:5px;font-size:12px}.course-site-logo img{width:38px;height:38px}.course-site-actions a{padding:0 8px;font-size:11px}.course-site-actions a:last-child{display:none}}
</style>

<header class="course-site-header">
  <div class="course-site-top">
    <a class="course-site-logo" href="{{ route('cpr-training') }}" aria-label="CPR Training home"><img src="{{ asset('images/dmi-logo-transparent.png') }}" alt=""><span>CPR <b>TRAINING</b></span></a>
    <div class="course-site-actions"><a href="tel:+16616005915">☎ +1 (661) 600-5915</a><a href="{{ route('cpr-training') }}#class-finder">Find a Class</a></div>
    <button class="course-site-menu" type="button" aria-label="Open CPR training navigation" aria-expanded="false">☰</button>
  </div>
  <nav class="course-site-nav" aria-label="CPR training navigation">
    <a href="{{ route('cpr-training') }}#courses">CLASSES</a><a href="{{ route('cpr-training') }}#courses">ONLINE CLASSES</a><a href="{{ route('cpr-training') }}#class-finder">LOCATIONS</a><a href="{{ route('cpr-training') }}#courses">GROUP TRAINING</a><a class="course-consultation-link" href="{{ route('cpr-training.consultation') }}">CONSULTATION</a><a href="{{ route('cpr-training') }}#training-enquiry">HELP</a>
  </nav>
</header>

<div class="training-course-page">
  <div class="training-course-wrap">
    <nav class="training-course-crumbs" aria-label="Breadcrumb">
      <a href="{{ route('cpr-training') }}">CPR Training</a><span aria-hidden="true">/</span><span>{{ $course['name'] }}</span>
    </nav>

    <section class="training-course-hero" aria-labelledby="training-course-title">
      <div>
        <p class="training-course-kicker">{{ $course['category'] }} · DMI Healths</p>
        <h1 id="training-course-title">{{ $course['name'] }}</h1>
        <p class="training-course-summary">{{ $course['summary'] }}</p>
        <div class="training-course-actions">
          <a class="training-course-primary" href="{{ route('cpr-training', ['course' => $course['name']]) }}#training-enquiry">Request this course</a>
          <a class="training-course-secondary" href="tel:+16616005915">Call +1 (661) 600-5915</a>
        </div>
        <p class="training-course-location"><span aria-hidden="true">●</span><span>Training location: <strong>Palmdale, Los Angeles, CA</strong></span></p>
      </div>
      <figure class="training-course-photo">
        <img src="{{ asset($course['image']) }}" alt="{{ $course['image_alt'] }}" fetchpriority="high">
      </figure>
    </section>

    <section class="training-pricing" aria-labelledby="training-pricing-title">
        <div class="training-pricing-heading">
          <div><p class="training-pricing-kicker">COURSE OPTIONS</p><h2 id="training-pricing-title">{{ !empty($course['pricing_options']) ? 'Choose your training format' : 'Ask us about course pricing' }}</h2></div>
          <p>{{ !empty($course['pricing_options']) ? 'Compare the available Red Cross course options and request the one that fits your needs. Prices are in U.S. dollars.' : 'We’ll share current pricing and available formats for this course when you contact our team.' }}</p>
        </div>
        @if(!empty($course['pricing_options']))
        <div class="training-pricing-grid">
          @foreach($course['pricing_options'] as $option)
            <article class="training-price-card">
              <p class="training-price-format">{{ $option['format'] }}</p>
              <h3>{{ $option['name'] }}</h3>
              <p class="training-price-description">{{ $option['description'] }}</p>
              <p class="training-price-amount"><strong>${{ number_format($option['price'], 0) }}</strong><span>USD</span></p>
              <a class="training-price-request" href="{{ route('cpr-training', ['course' => $course['name'], 'option' => $option['name'] . ' - $' . $option['price']]) }}#training-enquiry">Request this option <span aria-hidden="true">→</span></a>
            </article>
          @endforeach
        </div>
        <p class="training-price-footnote">Requesting an option does not reserve a class or collect payment. Our team will confirm details and next steps with you.</p>
        @else
          <div class="training-pricing-grid">
            <article class="training-price-card">
              <p class="training-price-format">Course pricing</p>
              <h3>{{ $course['name'] }}</h3>
              <p class="training-price-description">Ask our training team about the course options and details that fit your needs.</p>
              <p class="training-price-contact">Pricing available on request</p>
              <a class="training-price-request" href="{{ route('cpr-training', ['course' => $course['name'], 'option' => 'Request pricing for ' . $course['name']]) }}#training-enquiry">Request pricing <span aria-hidden="true">→</span></a>
            </article>
          </div>
        @endif
    </section>

    <div class="training-course-info">
      <section class="training-course-panel" aria-labelledby="training-course-audience">
        <h2 id="training-course-audience">Who this course is for</h2>
        <p>{{ $course['audience'] }}</p>
      </section>
      <section class="training-course-panel" aria-labelledby="training-course-planning">
        <h2 id="training-course-planning">Plan your request</h2>
        <ul>
          @foreach($course['planning'] as $item)
            <li>{{ $item }}</li>
          @endforeach
        </ul>
      </section>
    </div>

    <p class="training-course-note">Course format, dates, prerequisites, and completion or certification details vary by course. Our team will confirm the information that applies to your request before you book.</p>

    <section class="training-course-bottom" aria-label="Request course information">
      <div>
        <h2>Ready to ask about {{ $course['name'] }}?</h2>
        <p>Send a request and our team will follow up about availability in Palmdale.</p>
      </div>
      <a href="{{ route('cpr-training', ['course' => $course['name']]) }}#training-enquiry">Request course details</a>
    </section>
  </div>
</div>
<footer class="course-site-footer"><div class="course-site-footer-inner"><p>© {{ now()->year }} DMI Healths. All rights reserved.</p><p>Palmdale, Los Angeles, CA · <a href="tel:+16616005915">+1 (661) 600-5915</a></p><p><a href="{{ route('cpr-training') }}">Back to CPR Training</a></p></div></footer>
<script>
  (() => {
    const button = document.querySelector('.course-site-menu');
    const nav = document.querySelector('.course-site-nav');
    button?.addEventListener('click', () => {
      const expanded = nav.classList.toggle('is-open');
      button.setAttribute('aria-expanded', String(expanded));
      button.setAttribute('aria-label', expanded ? 'Close CPR training navigation' : 'Open CPR training navigation');
    });
  })();
</script>
@endsection
