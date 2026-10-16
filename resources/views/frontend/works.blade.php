@extends('layouts.app')

@section('content')
@php
    $works = config('works.all', []);
    $websites = collect($works)->whereIn('type', ['website', 'webapp'])->values();
    $apps = collect($works)->where('type', 'mobile')->values();
@endphp

<section class="inner-banner">
    <div class="container">
        <h1>Our Works</h1>
        <p>
            Explore websites, web applications and mobile apps designed for businesses
            across India — shown in simple laptop and phone previews.
        </p>
    </div>
</section>

<section class="works-page-section section-padding" id="websites">
    <div class="container">
        <div class="section-title">
            <span class="section-label">WEBSITES & WEB APPS</span>
            <h2>Designs presented on laptop screens</h2>
            <p>
                Business websites, stores and dashboards crafted to look clean on
                desktop and stay fully responsive on mobile.
            </p>
        </div>

        <div class="row g-4 g-xl-5">
            @foreach ($websites as $work)
                <div class="col-md-6">
                    <article class="work-device-card h-100">
                        <div class="device-laptop device-laptop-sm">
                            <div class="device-laptop-screen">
                                <div class="device-laptop-camera" aria-hidden="true"></div>
                                <img
                                    src="{{ asset($work['image']) }}"
                                    alt="{{ $work['title'] }} website on laptop"
                                    class="device-screen-img"
                                    width="1280"
                                    height="720"
                                    loading="lazy"
                                    decoding="async">
                            </div>
                            <div class="device-laptop-base" aria-hidden="true">
                                <div class="device-laptop-notch"></div>
                            </div>
                        </div>
                        <div class="work-card-body">
                            <span class="works-category">{{ $work['category'] }}</span>
                            <h3>{{ $work['title'] }}</h3>
                            <p>{{ $work['desc'] }}</p>
                            <ul class="works-points">
                                @foreach ($work['features'] ?? [] as $feature)
                                    <li><i class="bi bi-check-circle-fill"></i> {{ $feature }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </article>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="mobile-apps-section section-padding" id="mobile-apps">
    <div class="container">
        <div class="section-title">
            <span class="section-label">MOBILE APPLICATIONS</span>
            <h2>App screens shown on mobile devices</h2>
            <p>
                Simple, clear mobile app interfaces for ordering, booking,
                memberships and property discovery.
            </p>
        </div>

        <div class="row g-4 mb-5">
            @foreach ([
                ['icon' => 'bi-phone', 'title' => 'Native-feel UI', 'text' => 'Clean screens designed for thumbs-first mobile use.'],
                ['icon' => 'bi-lightning-charge', 'title' => 'Fast journeys', 'text' => 'Simple flows for browse, book, order and track.'],
                ['icon' => 'bi-bell', 'title' => 'Engagement ready', 'text' => 'Built for notifications, status updates and retention.'],
                ['icon' => 'bi-shield-check', 'title' => 'Business focused', 'text' => 'Practical features that support real operations.'],
            ] as $item)
                <div class="col-6 col-lg-3">
                    <div class="stat-card h-100 text-center p-3">
                        <div class="stat-card-icon mx-auto mb-2" aria-hidden="true"><i class="bi {{ $item['icon'] }}"></i></div>
                        <strong>{{ $item['title'] }}</strong>
                        <span>{{ $item['text'] }}</span>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row g-4 justify-content-center">
            @foreach ($apps as $app)
                <div class="col-sm-6 col-lg-4">
                    <article class="app-device-card h-100">
                        <div class="app-screen">
                            <img
                                src="{{ asset($app['image']) }}"
                                alt="{{ $app['title'] }} mobile application UI"
                                class="app-screen-img img-fluid"
                                width="864"
                                height="1152"
                                loading="lazy"
                                decoding="async">
                        </div>
                        <div class="app-card-body text-center">
                            <span class="works-category">{{ $app['category'] }}</span>
                            <h3>{{ $app['title'] }}</h3>
                            <p>{{ $app['desc'] }}</p>
                            <ul class="works-points d-inline-block text-start">
                                @foreach ($app['features'] ?? [] as $feature)
                                    <li><i class="bi bi-check-circle-fill"></i> {{ $feature }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </article>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="container text-center">
        <h2>Want a website or mobile app like these?</h2>
        <p>Tell us your idea and get a tailored quote within one day.</p>
        <a href="{{ route('enquiry.create') }}" class="btn-primary-custom">
            Get a Free Quote <i class="bi bi-arrow-right"></i>
        </a>
    </div>
</section>
@endsection
