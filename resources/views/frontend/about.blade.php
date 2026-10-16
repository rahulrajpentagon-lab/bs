@extends('layouts.app')

@section('content')
<section class="inner-banner">
    <div class="container">
        <h1>Affordable Web Development Company in India</h1>
        <p>
            Kayacode delivers professional website development and custom web
            applications with premium quality at affordable prices for businesses
            across India.
        </p>
    </div>
</section>

<section class="page-section">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <span class="section-label">WHO WE ARE</span>
                <h2 class="mt-3 mb-3" style="color:var(--dark);font-family:Manrope,sans-serif;font-weight:800;">
                    Built for Indian businesses that need value and quality
                </h2>
                <p>
                    Kayacode is an affordable website development company in India
                    focused on high quality website development at affordable prices.
                    We help startups and small businesses launch professional websites,
                    custom web applications and cost-effective digital systems.
                </p>
                <p>
                    Whether you need affordable business website development,
                    Laravel web application development, eCommerce website development
                    or a custom admin panel, we start with your goals and reply within
                    one day with a clear quote.
                </p>
                <p>
                    We serve clients across India — including Delhi, Mumbai, Bangalore,
                    Hyderabad, Chennai, Pune and Kochi — with budget-friendly website
                    development that still looks and performs premium.
                </p>
                <a href="{{ route('enquiry.create') }}" class="btn-primary-custom mt-2">
                    Tell Us About Your Project <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="col-lg-6">
                <img
                    class="img-fluid rounded-4 shadow"
                    src="{{ asset('assets/images/hero/team-table.jpg') }}"
                    alt="Affordable website development company in India collaborating on a business website project"
                    width="900"
                    height="500"
                    loading="lazy"
                    decoding="async">
            </div>
        </div>
    </div>
</section>

<section class="why-section section-padding">
    <div class="container">
        <div class="section-title">
            <span class="section-label">WHY WORK WITH US</span>
            <h2>Professional websites at affordable prices</h2>
            <p>
                Cost-effective website development and custom web applications
                designed for Indian businesses and real business outcomes.
            </p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="stat-card h-100">
                    <div class="stat-card-icon" aria-hidden="true"><i class="bi bi-chat-dots"></i></div>
                    <strong>Clear first reply</strong>
                    <span>We respond within one day with price details based on what you share.</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card h-100">
                    <div class="stat-card-icon" aria-hidden="true"><i class="bi bi-phone"></i></div>
                    <strong>Mobile-first builds</strong>
                    <span>Every website and app is designed to work well on phones and desktops.</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card h-100">
                    <div class="stat-card-icon" aria-hidden="true"><i class="bi bi-graph-up-arrow"></i></div>
                    <strong>Growth-ready setup</strong>
                    <span>Start with a website and expand into systems, commerce or apps when needed.</span>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
