@extends('layouts.app')

@section('content')
<style>
  body:has(.consult-page){background:#f4f8fc}
  body:has(.consult-page)>header,body:has(.consult-page)>.site-footer{display:none!important}
  body:has(.consult-page)>.notice{display:none!important}
  body:has(.consult-page) #main{width:100%;max-width:none;margin:0;padding:0}
  .consult-page,.consult-page *{box-sizing:border-box}
  .consult-page{--navy:#082f68;--blue:#0759aa;--teal:#38b9b6;--ink:#183653;--muted:#5d7288;color:var(--ink);font-family:Arial,Helvetica,sans-serif;background:#f4f8fc;min-height:100vh}
  .consult-header{position:relative;z-index:3;background:#fff;border-bottom:1px solid #dce6ef}
  .consult-head-inner{max-width:1480px;min-height:78px;padding:10px 5%;margin:auto;display:flex;align-items:center;justify-content:space-between;gap:20px}
  .consult-brand{display:flex;align-items:center;gap:11px;color:#092b59;text-decoration:none;font-size:18px;font-weight:850;letter-spacing:.015em}
  .consult-brand img{width:52px;height:52px;object-fit:contain}.consult-brand b{color:#16827c}
  .consult-call{display:inline-flex;align-items:center;justify-content:center;gap:9px;min-height:46px;padding:0 18px;border-radius:10px;background:var(--navy);color:#fff;text-decoration:none;font-weight:750;white-space:nowrap}
  .consult-nav{display:flex;justify-content:center;align-items:center;gap:clamp(16px,3vw,42px);padding:13px 16px;border-top:1px solid #edf1f5}
  .consult-nav a{color:#172331;font-size:13px;font-weight:800;text-decoration:none;white-space:nowrap}.consult-nav a:hover{color:var(--blue)}.consult-nav .consultation-nav-link{padding:8px 13px;border:1px solid #c6e7e3;border-radius:999px;background:#eaf7f5;color:#08746f}.consult-nav .consultation-nav-link[aria-current="page"]{background:#08746f;border-color:#08746f;color:#fff}
  .consult-wrap{width:min(1200px,calc(100% - 40px));margin:auto;padding:28px 0 66px}
  .consult-crumb{display:flex;gap:10px;align-items:center;margin:0 0 20px;color:#708399;font-size:14px}.consult-crumb a{color:#0758a5;font-weight:750;text-decoration:none}
  .consult-hero{overflow:hidden;display:grid;grid-template-columns:1.03fr .97fr;background:#fff;border:1px solid #e3ebf3;border-radius:24px;box-shadow:0 18px 48px rgba(11,48,86,.09)}
  .consult-copy{align-self:center;padding:clamp(30px,5vw,66px)}
  .consult-kicker{display:inline-flex;align-items:center;gap:9px;margin:0 0 18px;color:#087a80;font-size:12px;font-weight:850;letter-spacing:.15em;text-transform:uppercase}.consult-kicker:before{content:'';width:9px;height:9px;border-radius:50%;background:var(--teal);box-shadow:0 0 0 5px #e0f5f4}
  .consult-copy h1{max-width:620px;margin:0 0 18px;color:var(--navy);font-size:clamp(38px,5vw,62px);letter-spacing:-.045em;line-height:1.03}
  .consult-lead{max-width:570px;margin:0;color:#536d85;font-size:18px;line-height:1.7}
  .consult-free{display:inline-flex;align-items:center;gap:10px;margin-top:22px;padding:11px 14px;border:1px solid #ccece8;border-radius:999px;background:#effaf8;color:#126c68;font-size:14px;font-weight:800}
  .consult-free span{display:grid;place-items:center;width:22px;height:22px;border-radius:50%;background:#d2f2ec;font-size:14px}
  .consult-photo{position:relative;min-height:460px;margin:0;background:#dceaf2}.consult-photo img{display:block;width:100%;height:100%;min-height:460px;object-fit:cover;object-position:center}.consult-photo:after{content:'';position:absolute;inset:45% 0 0;background:linear-gradient(transparent,rgba(6,35,67,.45));pointer-events:none}
  .consult-photo-badge{position:absolute;z-index:1;left:22px;bottom:22px;display:flex;gap:12px;align-items:center;max-width:calc(100% - 44px);padding:14px 17px;border:1px solid #ffffff70;border-radius:14px;background:#ffffffed;box-shadow:0 8px 24px #082f6825}.consult-photo-badge strong{display:block;color:#133c67;font-size:14px}.consult-photo-badge small{display:block;margin-top:4px;color:#627a91;font-size:12px}
  .consult-steps{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin:24px 0}.consult-step{display:flex;gap:13px;align-items:flex-start;padding:20px;border:1px solid #e2eaf1;border-radius:16px;background:#fff}.consult-step-num{display:grid;place-items:center;flex:0 0 34px;height:34px;border-radius:11px;background:#eaf3fc;color:#0759aa;font-weight:850}.consult-step strong{display:block;color:#143b65;font-size:14px}.consult-step p{margin:6px 0 0;color:#687d91;font-size:13px;line-height:1.5}
  .consult-options{display:grid;grid-template-columns:.8fr 1.2fr;gap:24px;margin-top:25px}.consult-options-intro{padding:30px 10px 20px 4px}.consult-options-intro .consult-kicker{margin-bottom:12px}.consult-options-intro h2{margin:0 0 12px;color:var(--navy);font-size:clamp(27px,3vw,38px);line-height:1.12;letter-spacing:-.025em}.consult-options-intro p{margin:0;color:var(--muted);font-size:15px;line-height:1.7}
  .consult-mode-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:12px}.consult-mode{padding:22px 18px;border:1px solid #e0e9f1;border-radius:16px;background:#fff;box-shadow:0 8px 20px #163e6008}.consult-mode-icon{display:grid;place-items:center;width:42px;height:42px;margin-bottom:15px;border-radius:13px;background:#eaf5ff;color:#0759aa;font-size:20px}.consult-mode h3{margin:0 0 8px;color:#163b64;font-size:16px}.consult-mode p{margin:0;color:#687d91;font-size:13px;line-height:1.55}
  .consult-form-section{display:grid;grid-template-columns:.72fr 1.28fr;gap:24px;margin-top:28px;padding:clamp(22px,4vw,42px);border-radius:22px;background:linear-gradient(140deg,#082f68,#0b4a88);box-shadow:0 18px 42px #082f6822}
  .consult-form-aside{color:#fff;padding:10px 5px}.consult-form-aside .consult-kicker{color:#8ce2da}.consult-form-aside h2{margin:0 0 13px;font-size:clamp(28px,3vw,38px);line-height:1.1;letter-spacing:-.025em}.consult-form-aside p{max-width:340px;margin:0;color:#d9e8f5;font-size:15px;line-height:1.7}.consult-form-aside ul{display:grid;gap:12px;margin:23px 0 0;padding:0;list-style:none;color:#edf6ff;font-size:14px}.consult-form-aside li{display:flex;gap:9px;align-items:flex-start}.consult-form-aside li:before{content:'✓';color:#7be0d6;font-weight:900}
  .consult-form-card{padding:clamp(20px,3vw,32px);border-radius:17px;background:#fff}.consult-form-card h3{margin:0 0 6px;color:#123b68;font-size:23px}.consult-form-card>p{margin:0 0 21px;color:#667b91;font-size:14px;line-height:1.55}
  .consult-alert{margin:0 0 16px;padding:12px 14px;border:1px solid #cdebe2;border-radius:10px;background:#effaf4;color:#176444;font-size:14px;line-height:1.5}
  .consult-fields{display:grid;grid-template-columns:1fr 1fr;gap:14px}.consult-field{display:grid;gap:7px;min-width:0}.consult-field.wide{grid-column:1/-1}.consult-field label{color:#233f5c;font-size:13px;font-weight:750}.consult-field input,.consult-field select,.consult-field textarea{width:100%;min-height:48px;padding:11px 13px;border:1px solid #d3deea;border-radius:9px;background:#fff;color:#183653;font:inherit;font-size:14px;outline:none}.consult-field textarea{min-height:105px;resize:vertical}.consult-field input:focus,.consult-field select:focus,.consult-field textarea:focus{border-color:#1681cc;box-shadow:0 0 0 3px #1681cc20}.consult-field select option.first-aid-course-option{color:#c62828;font-weight:700}.consult-error{color:#b42318;font-size:12px}.consult-submit{grid-column:1/-1;display:flex;align-items:center;justify-content:center;gap:9px;min-height:52px;margin-top:2px;border:0;border-radius:10px;background:#0759aa;color:#fff;font:inherit;font-weight:800;cursor:pointer;box-shadow:0 8px 18px #0759aa28}.consult-submit:hover{background:#064b90}.consult-privacy{grid-column:1/-1;margin:-4px 0 0;color:#708399;font-size:12px;line-height:1.5;text-align:center}
  .consult-footer{padding:22px 5%;background:#102c4e;color:#dbe8f5}.consult-footer-inner{display:flex;justify-content:space-between;gap:12px 24px;flex-wrap:wrap;width:min(1200px,100%);margin:auto;font-size:13px}.consult-footer p{margin:0}.consult-footer a{color:#fff}
  @media(max-width:900px){.consult-hero{grid-template-columns:1fr 1fr}.consult-copy{padding:34px}.consult-photo,.consult-photo img{min-height:400px}.consult-options{grid-template-columns:1fr}.consult-options-intro{padding:10px 0 0}.consult-form-section{grid-template-columns:1fr}.consult-form-aside p{max-width:620px}.consult-form-aside ul{grid-template-columns:repeat(3,1fr)}}
  @media(max-width:700px){.consult-head-inner{min-height:64px;padding:8px 15px;gap:10px}.consult-brand{gap:7px;font-size:14px}.consult-brand img{width:42px;height:42px}.consult-call{min-height:40px;padding:0 11px;font-size:12px}.consult-nav{justify-content:flex-start;gap:22px;padding:12px 15px;overflow-x:auto;scrollbar-width:none}.consult-nav::-webkit-scrollbar{display:none}.consult-nav a{font-size:12px}.consult-wrap{width:min(100% - 24px,600px);padding:17px 0 38px}.consult-crumb{margin-bottom:13px;font-size:12px}.consult-hero{grid-template-columns:1fr;border-radius:17px}.consult-copy{padding:25px 22px 22px}.consult-kicker{font-size:10px;letter-spacing:.12em}.consult-copy h1{font-size:clamp(34px,9vw,48px)}.consult-lead{font-size:15px;line-height:1.6}.consult-free{margin-top:17px;font-size:12px}.consult-photo{grid-row:1;min-height:240px;max-height:340px}.consult-photo img{min-height:240px;max-height:340px}.consult-photo-badge{left:13px;bottom:13px;padding:11px 12px}.consult-photo-badge strong{font-size:12px}.consult-photo-badge small{font-size:11px}.consult-steps{grid-template-columns:1fr;gap:9px;margin:15px 0}.consult-step{padding:15px}.consult-options{gap:14px;margin-top:22px}.consult-options-intro h2{font-size:29px}.consult-mode-grid{grid-template-columns:1fr;gap:9px}.consult-mode{display:grid;grid-template-columns:42px 1fr;column-gap:13px;padding:15px}.consult-mode-icon{grid-row:span 2;width:42px;height:42px;margin:0}.consult-mode h3{align-self:end;font-size:14px}.consult-mode p{font-size:12px}.consult-form-section{gap:16px;margin-top:20px;padding:18px;border-radius:17px}.consult-form-aside{padding:3px}.consult-form-aside h2{font-size:29px}.consult-form-aside p{font-size:14px}.consult-form-aside ul{grid-template-columns:1fr;gap:8px;margin-top:15px;font-size:13px}.consult-form-card{padding:19px 15px;border-radius:13px}.consult-form-card h3{font-size:21px}.consult-form-card>p{font-size:13px;margin-bottom:16px}.consult-fields{grid-template-columns:1fr;gap:12px}.consult-field.wide,.consult-submit,.consult-privacy{grid-column:1}.consult-field input,.consult-field select{min-height:48px;font-size:16px}.consult-field textarea{font-size:16px}.consult-submit{min-height:50px}.consult-footer{padding:18px 15px}.consult-footer-inner{font-size:12px;gap:8px}}
  @media(max-width:380px){.consult-brand{font-size:12px}.consult-brand img{width:36px;height:36px}.consult-call{font-size:11px;padding:0 8px}.consult-copy{padding:22px 17px}.consult-copy h1{font-size:33px}}
</style>

<div class="consult-page">
  <header class="consult-header">
    <div class="consult-head-inner">
      <a class="consult-brand" href="{{ route('cpr-training') }}" aria-label="CPR Training home"><img src="{{ asset('images/dmi-logo-transparent.png') }}" alt=""><span>CPR <b>TRAINING</b></span></a>
      <a class="consult-call" href="tel:+16616005915" aria-label="Call +1 (661) 600-5915">☎ <span>+1 (661) 600-5915</span></a>
    </div>
    <nav class="consult-nav" aria-label="CPR training navigation">
      <a href="{{ route('cpr-training') }}#courses">CLASSES</a><a href="{{ route('cpr-training') }}#courses">ONLINE CLASSES</a><a href="{{ route('cpr-training') }}#class-finder">LOCATIONS</a><a href="{{ route('cpr-training') }}#courses">GROUP TRAINING</a><a class="consultation-nav-link" href="{{ route('cpr-training.consultation') }}" aria-current="page">CONSULTATION</a><a href="{{ route('cpr-training') }}#training-enquiry">HELP</a>
    </nav>
  </header>

  <main class="consult-wrap">
    <nav class="consult-crumb" aria-label="Breadcrumb"><a href="{{ route('cpr-training') }}">CPR Training</a><span aria-hidden="true">/</span><span>Free Consultation</span></nav>
    <section class="consult-hero" aria-labelledby="consult-title">
      <div class="consult-copy">
        <p class="consult-kicker">PERSONAL GUIDANCE · DMI HEALTHS</p>
        <h1 id="consult-title">Let’s find the right training for you.</h1>
        <p class="consult-lead">Talk with our team about the course, format, and schedule that fit your needs. Whether you’re planning for yourself or a whole team, we’ll help you understand the next steps.</p>
        <div class="consult-free"><span aria-hidden="true">✓</span> Free consultation · No fee to ask questions</div>
      </div>
      <figure class="consult-photo">
        <img src="{{ asset('images/training/consultation-workshop.jpg') }}" alt="CPR instructor guiding learners as they practice on training mannequins" fetchpriority="high">
        <figcaption class="consult-photo-badge"><span aria-hidden="true">✦</span><span><strong>Practical, people-first guidance</strong><small>We’ll talk through your training options</small></span></figcaption>
      </figure>
    </section>

    <section class="consult-steps" aria-label="How the consultation works">
      <article class="consult-step"><span class="consult-step-num">01</span><div><strong>Tell us what you need</strong><p>Share a course, team, or training goal you have in mind.</p></div></article>
      <article class="consult-step"><span class="consult-step-num">02</span><div><strong>Explore the format</strong><p>Discuss in-person, online, or hybrid possibilities.</p></div></article>
      <article class="consult-step"><span class="consult-step-num">03</span><div><strong>Choose your next step</strong><p>We’ll follow up so you can decide how you’d like to proceed.</p></div></article>
    </section>

    <section class="consult-options" aria-labelledby="consult-options-title">
      <div class="consult-options-intro"><p class="consult-kicker">FLEXIBLE OPTIONS</p><h2 id="consult-options-title">Training that can fit your plans.</h2><p>Let us know what you’re considering. We’ll discuss availability and details with you. In-person training is based in Palmdale, Los Angeles, CA.</p></div>
      <div class="consult-mode-grid">
        <article class="consult-mode"><span class="consult-mode-icon" aria-hidden="true">⌖</span><h3>In-person</h3><p>Ask about training in Palmdale, Los Angeles, CA.</p></article>
        <article class="consult-mode"><span class="consult-mode-icon" aria-hidden="true">▣</span><h3>Online</h3><p>Discuss online course options and what’s included.</p></article>
        <article class="consult-mode"><span class="consult-mode-icon" aria-hidden="true">⇄</span><h3>Hybrid</h3><p>Explore a mix of online learning and in-person practice.</p></article>
      </div>
    </section>

    <section class="consult-form-section" aria-labelledby="consult-form-title">
      <div class="consult-form-aside"><p class="consult-kicker">A GOOD PLACE TO START</p><h2>Tell us a little about what you’re looking for.</h2><p>Send a few details and our training team will reach out to discuss your questions. This request does not book a class or require payment.</p><ul><li>No consultation fee</li><li>Ask about individual or group training</li><li>Use your preferred contact method</li></ul></div>
      <div class="consult-form-card">
        <h3 id="consult-form-title">Request your free consultation</h3><p>Fields marked required help us get back to you.</p>
        @if(session('status'))<div class="consult-alert" role="status">{{ session('status') }}</div>@endif
        @if($errors->any())<div class="consult-alert" role="alert">Please check the highlighted fields and try again.</div>@endif
        <form method="post" action="{{ route('cpr-training.consultation.store') }}"><input type="hidden" name="website" value="" tabindex="-1" autocomplete="off" aria-hidden="true">@csrf
          <div class="consult-fields">
            <div class="consult-field"><label for="consult-name">Full name *</label><input id="consult-name" name="name" value="{{ old('name') }}" autocomplete="name" required>@error('name')<span class="consult-error">{{ $message }}</span>@enderror</div>
            <div class="consult-field"><label for="consult-email">Email address *</label><input id="consult-email" type="email" name="email" value="{{ old('email') }}" autocomplete="email" required>@error('email')<span class="consult-error">{{ $message }}</span>@enderror</div>
            <div class="consult-field"><label for="consult-phone">Phone number *</label><input id="consult-phone" type="tel" name="phone" value="{{ old('phone') }}" autocomplete="tel" required>@error('phone')<span class="consult-error">{{ $message }}</span>@enderror</div>
            <div class="consult-field"><label for="consult-course">Course you’re interested in</label><select id="consult-course" name="course"><option value="">Not sure yet</option>@foreach(config('training_courses') as $course)<option value="{{ $course['name'] }}" @class(['first-aid-course-option' => str_contains($course['name'], 'First Aid')]) @selected(old('course') === $course['name'])>@if(str_contains($course['name'], 'First Aid'))&#10010; @endif{{ $course['name'] }}</option>@endforeach</select>@error('course')<span class="consult-error">{{ $message }}</span>@enderror</div>
            <div class="consult-field"><label for="consult-format">Preferred training format *</label><select id="consult-format" name="format" required><option value="">Choose a format</option>@foreach(['In-person in Palmdale','Online','Hybrid (online and in-person)','Not sure yet'] as $format)<option value="{{ $format }}" @selected(old('format') === $format)>{{ $format }}</option>@endforeach</select>@error('format')<span class="consult-error">{{ $message }}</span>@enderror</div>
            <div class="consult-field"><label for="consult-contact">How should we contact you? *</label><select id="consult-contact" name="preferred_contact" required><option value="">Choose one</option>@foreach(['Email','Phone'] as $method)<option value="{{ $method }}" @selected(old('preferred_contact') === $method)>{{ $method }}</option>@endforeach</select>@error('preferred_contact')<span class="consult-error">{{ $message }}</span>@enderror</div>
            <div class="consult-field wide"><label for="consult-message">Questions or details <span>(optional)</span></label><textarea id="consult-message" name="message" rows="4" placeholder="For example: group size, preferred dates, or what you’d like to learn more about.">{{ old('message') }}</textarea>@error('message')<span class="consult-error">{{ $message }}</span>@enderror</div>
            <button class="consult-submit" type="submit">Send consultation request <span aria-hidden="true">→</span></button>
            <p class="consult-privacy">Your request is sent to the DMI Healths training team. No payment is collected on this page.</p>
          </div>
        </form>
      </div>
    </section>
  </main>

  <footer class="consult-footer"><div class="consult-footer-inner"><p>© {{ now()->year }} DMI Healths CPR Training</p><p>Palmdale, Los Angeles, CA · <a href="tel:+16616005915">+1 (661) 600-5915</a></p><p><a href="{{ route('cpr-training') }}">Back to CPR Training</a></p></div></footer>
</div>
@endsection
