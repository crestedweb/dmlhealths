@extends('layouts.app')

@section('content')
<style>
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
  .training-course-bottom{display:flex;align-items:center;justify-content:space-between;gap:20px;margin-top:22px;padding:26px 30px;border-radius:16px;background:var(--course-blue);color:#fff}
  .training-course-bottom h2{margin:0 0 6px;font-size:22px}
  .training-course-bottom p{margin:0;color:#d5e3f1;font-size:14px;line-height:1.5}
  .training-course-bottom a{flex:0 0 auto;display:inline-flex;min-height:48px;align-items:center;padding:0 18px;border-radius:9px;background:#fff;color:#123b66;font-weight:800;text-decoration:none}
  @media(max-width:800px){.training-course-page{padding:22px 14px 48px}.training-course-hero{grid-template-columns:1fr;gap:23px;padding:24px}.training-course-photo{grid-row:1}.training-course-photo img{height:clamp(210px,52vw,340px)}.training-course-hero h1{font-size:clamp(31px,8vw,44px)}.training-course-summary{font-size:15px}.training-course-info{grid-template-columns:1fr}.training-course-bottom{align-items:flex-start;flex-direction:column;padding:22px}.training-course-bottom h2{font-size:20px}}
  .training-course-page,.training-course-page *{box-sizing:border-box}
  .training-course-wrap,.training-course-hero>div,.training-course-panel{min-width:0}
  .training-course-hero h1,.training-course-crumbs span,.training-course-panel,.training-course-note{overflow-wrap:anywhere}
  @media(max-width:520px){.training-course-page{padding:18px 12px 36px}.training-course-crumbs{gap:6px;margin-bottom:14px;font-size:12px;flex-wrap:wrap}.training-course-hero{gap:17px;padding:16px;border-radius:15px}.training-course-photo img{height:clamp(190px,58vw,270px);border-radius:11px}.training-course-kicker{font-size:10px;letter-spacing:.1em}.training-course-hero h1{font-size:clamp(29px,9vw,38px)}.training-course-summary{font-size:15px;line-height:1.55}.training-course-actions{display:grid;grid-template-columns:1fr;gap:9px;margin-top:18px}.training-course-actions a{width:100%;min-height:48px;padding:10px 12px;text-align:center}.training-course-location{align-items:flex-start;font-size:12px;line-height:1.5}.training-course-info{gap:12px;margin-top:14px}.training-course-panel{padding:19px 17px;border-radius:13px}.training-course-panel h2{font-size:19px}.training-course-panel p,.training-course-panel ul{font-size:14px}.training-course-note{padding:15px 16px;font-size:13px}.training-course-bottom{gap:15px;margin-top:14px;padding:19px;border-radius:13px}.training-course-bottom h2{font-size:19px}.training-course-bottom a{width:100%;min-height:48px;justify-content:center;text-align:center}.training-course-photo figcaption{text-align:left;line-height:1.5}}
</style>

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
        <figcaption>Photo by {{ $course['photo_credit'] }} on <a href="{{ $course['photo_url'] }}" target="_blank" rel="noopener noreferrer">Pexels</a></figcaption>
      </figure>
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
@endsection
