@extends('layouts.app')

@section('content')
<section class="services-hero">
  <img src="{{ config('site.images.services') }}" alt="A caring support professional spending time with a resident">
  <div class="services-hero-overlay"></div>
  <div class="services-hero-copy"><p class="eyebrow">What we do</p><h1>Compassionate care, shaped around each person.</h1><p>We provide secure residential support, personalized care and meaningful opportunities for adults with physical, intellectual and developmental disabilities.</p></div>
</section>

<section class="services-overview">
  <div class="services-overview-heading"><p class="eyebrow">Our services</p><h2>Support for everyday life and lasting connection.</h2><p>Our trained team works alongside residents, families and healthcare professionals to create care that is practical, respectful and genuinely personal.</p></div>
  <div class="services-detail-grid">
    <article class="services-detail-card"><span class="services-detail-number">01</span><h3>Residential Care</h3><p>Our facility offers a comfortable and secure residential setting for individuals who are unable to live independently due to physical, intellectual or developmental disabilities. Our trained and compassionate staff are available around the clock to assist with daily living activities, medication management and personal care.</p></article>
    <article class="services-detail-card"><span class="services-detail-number">02</span><h3>Personalized Care Plans</h3><p>We believe in an individualized approach to care. Our team works closely with each resident, their families and healthcare professionals to develop comprehensive care plans that reflect unique needs, goals and preferences. Regular assessments help ensure the right level of support at every stage.</p></article>
    <article class="services-detail-card"><span class="services-detail-number">03</span><h3>Social &amp; Recreational Activities</h3><p>Social interaction and engagement play an important role in wellbeing. We provide activities tailored to residents’ interests and abilities, from arts and crafts to community outings, creating an inclusive atmosphere where people can connect and explore new experiences.</p></article>
    <article class="services-detail-card"><span class="services-detail-number">04</span><h3>Health &amp; Wellness</h3><p>The health and wellness of our residents are central to our work. We collaborate with healthcare professionals to support medication management, regular check-ups and specialized therapies, while promoting nutritious meals, healthy routines and opportunities for physical activity.</p></article>
    <article class="services-detail-card services-detail-card-wide"><span class="services-detail-number">05</span><h3>Community Integration</h3><p>Everyone deserves to be an active and valued member of their community. We facilitate opportunities to participate in local events, volunteer work and social gatherings, encouraging residents to pursue their interests, engage with their surroundings and build meaningful relationships.</p></article>
  </div>
</section>

<section class="services-next-step"><div><p class="eyebrow">Let’s talk</p><h2>Find the right support for your needs.</h2><p>Our team welcomes conversations with individuals, families and professionals about care, services and next steps.</p></div><a class="button" href="{{ route('request-information') }}">Request Information</a></section>
@endsection
