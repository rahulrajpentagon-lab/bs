<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $seoTitle = $seo['title'] ?? config('seo.default_title');
        $seoDescription = $seo['description'] ?? config('seo.default_description');
        $seoCanonical = $seo['canonical'] ?? url()->current();
        $seoKeywords = $seo['keywords'] ?? implode(', ', config('seo.keywords'));
        $seoOgImage = $seo['og_image'] ?? asset('assets/images/logo/kayacode-logo.jpg');
        $cssVersion = @filemtime(public_path('assets/css/app.min.css')) ?: time();
        $jsVersion = @filemtime(public_path('assets/js/app.min.js')) ?: time();
    @endphp

    <title>@yield('title', $seoTitle)</title>

    <meta name="description" content="@yield('meta_description', $seoDescription)">
    <meta name="keywords" content="@yield('meta_keywords', $seoKeywords)">
    <meta name="author" content="{{ config('company.name') }}">
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <meta name="geo.region" content="IN">
    <meta name="geo.placename" content="India">

    <link rel="canonical" href="@yield('canonical', $seoCanonical)">

    <meta property="og:site_name" content="{{ config('company.name') }}">
    <meta property="og:locale" content="en_IN">
    <meta property="og:title" content="@yield('og_title', $seoTitle)">
    <meta property="og:description" content="@yield('og_description', $seoDescription)">
    <meta property="og:type" content="website">
    <meta property="og:url" content="@yield('canonical', $seoCanonical)">
    <meta property="og:image" content="@yield('og_image', $seoOgImage)">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', $seoTitle)">
    <meta name="twitter:description" content="@yield('og_description', $seoDescription)">
    <meta name="twitter:image" content="@yield('og_image', $seoOgImage)">

    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/images/logo/kayacode-icon.svg') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/logo/kayacode-icon.svg') }}">

    {{-- Critical CSS: local, no CDN round-trips --}}
    <link rel="preload" href="{{ asset('assets/css/app.min.css') }}?v={{ $cssVersion }}" as="style">
    <link rel="preload" href="{{ asset('assets/css/bootstrap.min.css') }}" as="style">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}?v={{ $cssVersion }}">

    {{-- Non-critical: icons + fonts (swap after load) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"></noscript>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;600;700&family=Manrope:wght@800&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    <noscript><link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;600;700&family=Manrope:wght@800&display=swap" rel="stylesheet"></noscript>

    <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'ProfessionalService',
            'name' => config('company.name'),
            'url' => url('/'),
            'logo' => asset('assets/images/logo/kayacode-logo.jpg'),
            'image' => $seoOgImage,
            'description' => config('seo.default_description'),
            'email' => config('company.email'),
            'telephone' => config('company.phone'),
            'priceRange' => '$$',
            'areaServed' => [
                '@type' => 'Country',
                'name' => 'India',
            ],
            'address' => [
                '@type' => 'PostalAddress',
                'addressCountry' => 'IN',
                'addressRegion' => 'India',
            ],
            'sameAs' => [],
            'knowsAbout' => [
                'Affordable Website Development',
                'Professional Website Development',
                'Custom Web Application Development',
                'Business Website Development',
                'eCommerce Website Development',
                'Laravel Web Application Development',
            ],
            'makesOffer' => [
                [
                    '@type' => 'Offer',
                    'itemOffered' => [
                        '@type' => 'Service',
                        'name' => 'Affordable Website Development',
                        'areaServed' => 'India',
                    ],
                ],
                [
                    '@type' => 'Offer',
                    'itemOffered' => [
                        '@type' => 'Service',
                        'name' => 'Custom Web Application Development',
                        'areaServed' => 'India',
                    ],
                ],
            ],
        ], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}
    </script>

    @stack('styles')
</head>

<body>

    <x-header />

    <main>
        @yield('content')
    </main>

    <x-footer />

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/app.min.js') }}?v={{ $jsVersion }}" defer></script>
    @stack('scripts')

</body>

</html>
