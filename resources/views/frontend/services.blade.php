@extends('layouts.app')

@section('content')
<section class="inner-banner">
    <div class="container">
        <h1>Affordable Website Development Company</h1>
        <p>
            Professional website development, custom web application development
            and cost-effective digital solutions for businesses across India.
        </p>
    </div>
</section>

@include('frontend.partials.services-grid')

<section class="section-padding" style="padding-top:0;">
    <div class="container">
        <div class="section-title">
            <span class="section-label">WHO WE HELP</span>
            <h2>Website development for businesses across India</h2>
            <p>
                Targeted solutions for startups, small businesses and growing brands
                in Delhi, Mumbai, Bangalore, Hyderabad, Chennai, Pune, Kochi and beyond.
            </p>
        </div>
        <div class="row g-4">
            @foreach ([
                ['title' => 'Small businesses & startups', 'text' => 'Affordable websites for startups and small businesses that need a professional online presence quickly.'],
                ['title' => 'eCommerce & booking', 'text' => 'eCommerce website development and booking website development for stores, hotels and service brands.'],
                ['title' => 'Custom business software', 'text' => 'CRM, ERP, job portals, admin panels and database-driven web application development.'],
                ['title' => 'Industry websites', 'text' => 'Hotel, restaurant, real estate, education, hospital and recruitment website development.'],
            ] as $item)
                <div class="col-md-6 col-lg-3">
                    <div class="stat-card h-100">
                        <strong>{{ $item['title'] }}</strong>
                        <span>{{ $item['text'] }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="container text-center">
        <h2>Need affordable professional website development?</h2>
        <p>Tell us about your business and receive a tailored quote within one day.</p>
        <a href="{{ route('enquiry.create') }}" class="btn-primary-custom">
            Get a Free Quote <i class="bi bi-arrow-right"></i>
        </a>
    </div>
</section>
@endsection
