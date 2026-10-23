<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $title ?? 'DMI Healths — Support for Intellectual Disability' }}</title>
<link rel="stylesheet" href="{{ asset('css/app.css') }}?v=20261023-warm-home-hero-fix9">
</head>
<body>

<header>
  <div class="header-inner">
    <a class="logo" href="{{ route('home') }}" aria-label="DMI Healths home">
      <img src="{{ asset('images/logo.jpeg') }}" alt="DMI Healths logo" class="logo-image">
      <div>DMI HEALTHS<span class="logo-sub">Support for Intellectual Disability</span></div>
    </a>
    <nav class="desktop-nav">
      <a href="#" class="active">Home</a>
      <a href="{{ route('about') }}">About Us</a>
      <a href="#services">Our Services</a>
      <a href="{{ route('cpr-training') }}">CPR Training</a>
      <div class="nav-dropdown">
        <button type="button" class="nav-dropdown-toggle" aria-haspopup="true" aria-expanded="false">Eligibility <span aria-hidden="true">⌄</span></button>
        <div class="nav-dropdown-menu">
          <a href="{{ route('eligibility', 'intellectual-disability') }}">Intellectual Disability</a>
          <a href="{{ route('eligibility', 'cerebral-palsy') }}">Cerebral Palsy</a>
          <a href="{{ route('eligibility', 'autism') }}">Autism</a>
          <a href="{{ route('eligibility', 'epilepsy') }}">Epilepsy</a>
          <a href="{{ route('eligibility', 'intellectual-related') }}">Intellectual Related Conditions</a>
        </div>
      </div>
      <a href="#life">Life at DMI</a>
      <a href="{{ route('mission') }}">Our Mission</a>
      <a class="mobile-support-link" href="{{ route('support-us') }}">Support Us</a>
    </nav>
    <a href="{{ route('support-us') }}" class="nav-cta support-cta"><img src="{{ asset('images/logo.jpeg') }}" alt="DMI Healths logo" class="support-logo"><span>Support Us</span></a>
    <button type="button" class="hamburger" aria-label="Menu" aria-expanded="false"><span></span><span></span><span></span></button>
  </div>
</header>

<section class="hero" style="padding-top:0;">
  <div class="hero-grid">
    <div class="hero-media">
      <img class="photo hero-photo" src="{{ config('site.images.hero') }}" alt="A care professional supporting an adult wheelchair user in a welcoming care setting">
    </div>
    <div class="hero-text">
      <p class="hero-kicker">Person-centred support <span aria-hidden="true">•</span> DMI Healths</p>
      <h1><span>Care That Sees</span><span>the Person,</span><span>Not Just the Need.</span></h1>
      <p class="desc">Personalised residential care and support for adults with intellectual and developmental disabilities—helping people live safe, healthy and fulfilling lives.</p>
      <div class="hero-btns">
        <a href="#services" class="hero-btn">Explore Our Services →</a>
        <a href="#life" class="hero-btn ghost community-showcase">Meet Our Community</a>
        <a href="tel:+16616005915" class="hero-btn ghost mobile-call-button">Call Us</a>
      </div>
      <div class="hero-values" aria-label="Our values">
        <span class="hero-values-rule" aria-hidden="true"></span>
        <span class="hero-value"><svg width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="#087e78" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="9" cy="8" r="3"></circle><path d="M3.5 20c0-3.3 2.2-5.5 5.5-5.5s5.5 2.2 5.5 5.5"></path><path d="M15 5.5a2.5 2.5 0 010 5M17 14.5c2.2.6 3.5 2.4 3.5 5.5"></path></svg>Person-centred care</span>
        <span class="hero-value-divider" aria-hidden="true"></span>
        <span class="hero-value"><svg width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="#087e78" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 3l8 3v5.5c0 4.6-3 7.7-8 9.5-5-1.8-8-4.9-8-9.5V6l8-3z"></path><path d="M8.5 12l2.2 2.2 4.8-5"></path></svg>Dignity</span>
        <span class="hero-value-divider" aria-hidden="true"></span>
        <span class="hero-value"><svg width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="#087e78" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.8 8.8c0 5-8.8 10.2-8.8 10.2S3.2 13.8 3.2 8.8a4.6 4.6 0 018.8-1.7 4.6 4.6 0 018.8 1.7z"></path></svg>Belonging</span>
      </div>
    </div>
    <svg class="hero-wave" viewBox="0 0 1600 100" preserveAspectRatio="none" aria-hidden="true"><path fill="#dff3ef" d="M0 46C185 8 322 22 495 57c166 34 278 12 423-7 173-23 310 20 447 12 91-5 165-30 235-53v91H0z"></path></svg>
  </div>
</section>

<script>
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

  document.querySelector('.hamburger')?.addEventListener('click', function (event) {
    const navigation = document.querySelector('.desktop-nav');
    const isOpen = navigation.classList.toggle('open');
    event.currentTarget.classList.toggle('is-open', isOpen);
    event.currentTarget.setAttribute('aria-expanded', String(isOpen));
  });

  document.addEventListener('DOMContentLoaded', function () {
    const spotlightTrack = document.querySelector('.testimonial-track');
    const spotlightSection = spotlightTrack?.closest('.spotlight');
    const spotlightCards = spotlightTrack ? Array.from(spotlightTrack.children) : [];
    const spotlightDots = Array.from(document.querySelectorAll('.dots span'));
    let spotlightIndex = 0;
    let spotlightTimer;
    let spotlightVisible = false;
    let spotlightPaused = false;

    if (spotlightTrack && spotlightCards.length > 1) {
      const updateSpotlight = function () {
        spotlightDots.forEach((dot, index) => dot.classList.toggle('active', index === spotlightIndex));
        spotlightTrack.scrollTo({ left: spotlightCards[spotlightIndex].offsetLeft, behavior: 'smooth' });
      };

      const startSpotlight = function () {
        window.clearInterval(spotlightTimer);
        if (!spotlightVisible || spotlightPaused) return;
        spotlightTimer = window.setInterval(function () {
          spotlightIndex = (spotlightIndex + 1) % spotlightCards.length;
          updateSpotlight();
        }, 5000);
      };

      spotlightTrack.addEventListener('mouseenter', function () {
        spotlightPaused = true;
        window.clearInterval(spotlightTimer);
      });
      spotlightTrack.addEventListener('mouseleave', function () {
        spotlightPaused = false;
        startSpotlight();
      });
      spotlightTrack.addEventListener('focusin', function () {
        spotlightPaused = true;
        window.clearInterval(spotlightTimer);
      });
      spotlightTrack.addEventListener('focusout', function () {
        spotlightPaused = false;
        startSpotlight();
      });

      if ('IntersectionObserver' in window) {
        const spotlightObserver = new IntersectionObserver(function (entries) {
          spotlightVisible = entries[0].isIntersecting;
          if (spotlightVisible) {
            startSpotlight();
          } else {
            window.clearInterval(spotlightTimer);
          }
        }, { threshold: 0.35 });
        spotlightObserver.observe(spotlightSection || spotlightTrack);
      } else {
        spotlightVisible = true;
        startSpotlight();
      }
    }
  });
</script>

<section id="services">
  <div class="wrap">
    <div class="section-head">
      <h2>Our Services</h2>
      <p>Comprehensive support for every stage of life.</p>
    </div>
    <div class="services-grid">
      <div class="service-card">
        <div class="icon-badge bg-teal icon-teal"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 10l9-7 9 7"/><path d="M5 9v11h14V9"/></svg></div>
        <h3>Residential Care</h3>
        <p>A safe and comfortable home environment with 24/7 support and personal care.</p>
        <a class="learn-more" href="#">Learn More →</a>
      </div>
      <div class="service-card">
        <div class="icon-badge bg-teal icon-teal"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="3"/><path d="M6 21c0-3.3 2.7-6 6-6s6 2.7 6 6"/></svg></div>
        <h3>Personalized Care Plans</h3>
        <p>Tailored to each resident's unique needs, goals and preferences.</p>
        <a class="learn-more" href="#">Learn More →</a>
      </div>
      <div class="service-card">
        <div class="icon-badge bg-purple icon-purple"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.8 4.6a5.5 5.5 0 00-7.8 0L12 5.6l-1-1a5.5 5.5 0 00-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 000-7.8z"/></svg></div>
        <h3>Health &amp; Wellness</h3>
        <p>Medical support, nutritious meals and opportunities for physical and mental well-being.</p>
        <a class="learn-more" href="#">Learn More →</a>
      </div>
      <div class="service-card">
        <div class="icon-badge bg-peach icon-white"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 12H3v9h8z"/><path d="M11 3l4 4-4 4"/><path d="M21 21V9l-6 6"/></svg></div>
        <h3>Social &amp; Recreational</h3>
        <p>Arts, crafts, outings and more — creating joy, friendship and engagement.</p>
        <a class="learn-more" href="#">Learn More →</a>
      </div>
      <div class="service-card wide">
        <div class="icon-badge bg-teal icon-teal"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="7" r="3"/><path d="M2 21c0-3.9 3.1-7 7-7s7 3.1 7 7"/><circle cx="17" cy="8" r="2.5"/><path d="M23 21c0-2.8-2-5-5-5.5"/></svg></div>
        <h3>Community Integration</h3>
        <p>Participation in local events, volunteer work and meaningful community connections.</p>
        <a class="learn-more" href="#">Learn More →</a>
      </div>
    </div>
  </div>
</section>

<section id="support" class="who-section">
  <div class="wrap">
    <div class="section-head">
      <h2>Who We Support</h2>
      <p>We provide specialized support for adults with:</p>
    </div>
    <div class="who-grid">
      <div class="who-card who-purple"><div class="icon-circle"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4.4 3.6-8 8-8s8 3.6 8 8"/></svg></div><span>Intellectual Disabilities</span></div>
      <div class="who-card who-peach"><div class="icon-circle"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19.4 15a1.7 1.7 0 00.3-1.9l-.9-1.6a1.7 1.7 0 010-1.7l.9-1.5a1.7 1.7 0 00-1.5-2.6h-1.8a1.7 1.7 0 01-1.5-.9l-.9-1.6a1.7 1.7 0 00-2.9 0L10.2 5.3a1.7 1.7 0 01-1.5.9H6.9a1.7 1.7 0 00-1.5 2.6l.9 1.5a1.7 1.7 0 010 1.7l-.9 1.6A1.7 1.7 0 006 15.8h1.8c.6 0 1.2.3 1.5.9l.9 1.6a1.7 1.7 0 002.9 0l.9-1.6c.3-.6.9-.9 1.5-.9H17"/></svg></div><span>Autism Spectrum</span></div>
      <div class="who-card who-green"><div class="icon-circle"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="18" r="3"/><circle cx="18" cy="6" r="2"/><path d="M8 18l4-9 4 2"/></svg></div><span>Cerebral Palsy</span></div>
      <div class="who-card who-blue"><div class="icon-circle"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3a7 7 0 00-7 7c0 3 1.5 4.5 2 6l1 4h8l1-4c.5-1.5 2-3 2-6a7 7 0 00-7-7z"/></svg></div><span>Epilepsy</span></div>
    </div>
  </div>
</section>

<section class="spotlight">
  <div class="wrap">
    <div class="section-head">
      <h2>Community Spotlight</h2>
      <p>Stories and testimonials from our community.</p>
    </div>
    <div class="testimonial-viewport"><div class="testimonial-track">
      <div class="t-card">
        <div class="avatar"><img class="photo" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&amp;fit=crop&amp;w=200&amp;q=80" alt="Family member testimonial"></div>
        <p>"The personal attention is remarkable."</p>
        <span class="name">— Family Member</span>
      </div>
      <div class="t-card">
        <div class="t-photo"><img class="photo" src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&amp;fit=crop&amp;w=700&amp;q=85" alt="Friends enjoying time together"></div>
        <p>"The residents are welcoming and lead active lives."</p>
        <span class="name">— Family Goure</span>
      </div>
      <div class="t-card">
        <div class="avatar"><img class="photo" src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&amp;fit=crop&amp;w=200&amp;q=80" alt="Family member testimonial"></div>
        <p>"The personal care and understanding they show means everything."</p>
        <span class="name">— Family Member</span>
      </div>
    </div></div>
    <div class="dots"><span class="active"></span><span></span><span></span></div>
  </div>
</section>

<section>
  <div class="wrap">
    <div class="section-head">
      <h2>Why Families Choose DMI Healths</h2>
      <p>We are more than a care facility — we are a community.</p>
    </div>
    <div class="why-grid">
      <div class="why-item"><div class="why-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l7 3v6c0 4.5-3 8-7 9-4-1-7-4.5-7-9V6z"/></svg></div><span>24/7 Support</span></div>
      <div class="why-item"><div class="why-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4.4 3.6-8 8-8s8 3.6 8 8"/></svg></div><span>Personalized Care</span></div>
      <div class="why-item"><div class="why-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 21V9l8-6 8 6v12"/><path d="M9 21v-6h6v6"/></svg></div><span>Experienced Staff</span></div>
      <div class="why-item"><div class="why-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 21V9l8-6 8 6v12"/><path d="M9 21v-8h6v8"/></svg></div><span>Safe Environment</span></div>
    </div>

    <div id="life" class="life-panel">
      <div class="life-head">
        <div>
          <h3>Life at DMI</h3>
          <p>Activities, friendships and community.</p>
        </div>
        <a class="life-cta" href="#">View Gallery →</a>
      </div>
      <div class="life-grid">
        <img class="photo" src="https://images.unsplash.com/photo-1517457373958-b7bdd4587205?auto=format&amp;fit=crop&amp;w=600&amp;q=85" alt="Friends enjoying a creative activity">
        <img class="photo" src="https://images.unsplash.com/photo-1509099836639-18ba1795216d?auto=format&amp;fit=crop&amp;w=600&amp;q=85" alt="People enjoying a shared meal">
        <img class="photo" src="https://images.unsplash.com/photo-1531206715517-5c0ba140b2b8?auto=format&amp;fit=crop&amp;w=600&amp;q=85" alt="Friends spending time outdoors">
        <img class="photo" src="https://images.unsplash.com/photo-1528605248644-14dd04022da1?auto=format&amp;fit=crop&amp;w=600&amp;q=85" alt="A group sharing a happy moment">
      </div>
      <div class="life-footer">
        <span>DMI HEALTHS</span>
        <div class="flinks"><a href="#">Home</a><a href="#">Our Services</a><a href="#">Who We Support</a><a href="#">Life at DMI</a></div>
      </div>
    </div>
  </div>
</section>

<footer id="contact">
  <div class="wrap">
    <div class="footer-top">
      <div class="footer-logo">
        <img src="{{ asset('images/logo.jpeg') }}" alt="DMI Healths logo" class="footer-logo-image">
        <div>DMI Healths<span class="sub">Support for Intellectual Disability</span></div>
      </div>
      <div class="social">
        <a href="#"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg></a>
        <a href="#"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1"/></svg></a>
        <a href="#"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/><path d="M10 9v12M10 13c0-2.2 1.8-4 4-4s4 1.8 4 4v8"/></svg></a>
      </div>
    </div>
    <div class="footer-links">
      <a href="{{ route('about') }}">About Us</a>
      <a href="#services">Services</a>
      <a href="{{ route('mission') }}">Our Mission</a>
      <a href="#careers">Careers</a>
      <a href="#contact">Contact</a>
      <a href="#">Home</a>
    </div>
    <div class="footer-bottom">© 2025 DMI Healths. All rights reserved · Privacy Policy</div>
  </div>
</footer>


</body>
</html>
