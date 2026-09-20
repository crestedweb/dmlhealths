<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>{{ $title ?? config('site.name') }}</title><meta name="description" content="{{ $description ?? config('site.description') }}"><link rel="canonical" href="{{ url()->current() }}"><meta property="og:title" content="{{ $title ?? config('site.name') }}"><meta property="og:description" content="{{ $description ?? config('site.description') }}"><link rel="stylesheet" href="{{ asset('css/app.css') }}"></head><body>
<header><div class="header-inner"><a class="logo" href="{{ route('home') }}" aria-label="DMI Healths home"><img src="{{ asset('images/logo.jpeg') }}" alt="DMI Healths logo" class="logo-image"><div>DMI HEALTHS<span class="logo-sub">Support for Intellectual Disability</span></div></a><nav class="desktop-nav" aria-label="Primary"><a href="{{ route('home') }}">Home</a><a href="{{ route('services') }}">Services</a><div class="nav-dropdown"><button type="button" class="nav-dropdown-toggle" aria-haspopup="true" aria-expanded="false">Eligibility <span aria-hidden="true">⌄</span></button><div class="nav-dropdown-menu"><a href="{{ route('eligibility','intellectual-disability') }}">Intellectual Disability</a><a href="{{ route('eligibility','cerebral-palsy') }}">Cerebral Palsy</a><a href="{{ route('eligibility','autism') }}">Autism</a><a href="{{ route('eligibility','epilepsy') }}">Epilepsy</a><a href="{{ route('eligibility','intellectual-related') }}">Intellectual Related Conditions</a></div></div><a href="{{ route('approach') }}">Our Approach</a><a href="{{ route('mission') }}">Our Mission</a><a href="{{ route('contact') }}">Contact Us</a><a class="mobile-support-link" href="{{ route('support-us') }}">Support Us</a></nav><a href="{{ route('support-us') }}" class="nav-cta support-cta"><img src="{{ asset('images/logo.jpeg') }}" alt="DMI Healths logo" class="support-logo"><span>Support Us</span></a><button class="hamburger" aria-label="Menu" aria-expanded="false"><span></span><span></span><span></span></button></div></header>
@if(session('status'))<div class="notice" role="status">{{ session('status') }}</div>@endif<main id="main">@yield('content')</main><footer class="site-footer"><div><strong>DMI HEALTHS</strong><p>{{ config('site.description') }}</p></div><div><strong>Connect</strong><p>{{ config('site.contact.address') }}<br><a href="tel:{{ config('site.contact.phone') }}">{{ config('site.contact.phone') }}</a><br><a href="mailto:{{ config('site.contact.email') }}">{{ config('site.contact.email') }}</a></p></div><form method="post" action="{{ route('newsletter.subscribe') }}">@csrf<label for="newsletter">Stay Connected With DMI Healths</label><div class="subscribe"><input id="newsletter" name="email" type="email" required placeholder="Your email address"><button>Subscribe</button></div><small>By subscribing, you agree to receive DMI updates. You can unsubscribe at any time.</small></form><p class="footer-bottom">© {{ now()->year }} DMI Healths. All rights reserved. <a href="#">Privacy Policy</a> · <a href="#">Accessibility Statement</a></p></footer><script>
  const dropdown = document.querySelector('.nav-dropdown');
  const dropdownToggle = document.querySelector('.nav-dropdown-toggle');

  if (dropdown && dropdownToggle) {
    dropdownToggle.addEventListener('click', function (event) {
      event.preventDefault();
      const isOpen = dropdown.classList.toggle('is-open');
      dropdownToggle.setAttribute('aria-expanded', String(isOpen));
    });

    document.addEventListener('click', function (event) {
      if (!dropdown.contains(event.target)) {
        dropdown.classList.remove('is-open');
        dropdownToggle.setAttribute('aria-expanded', 'false');
      }
    });

    dropdown.querySelectorAll('a').forEach(function (link) {
      link.addEventListener('click', function () {
        dropdown.classList.remove('is-open');
        dropdownToggle.setAttribute('aria-expanded', 'false');
      });
    });
  }

  document.querySelector('.hamburger')?.addEventListener('click', e => {
    let n = document.querySelector('.desktop-nav');
    const isOpen = n.classList.toggle('open');
    e.currentTarget.classList.toggle('is-open', isOpen);
    e.currentTarget.setAttribute('aria-expanded', isOpen)
  });
</script></body></html>
