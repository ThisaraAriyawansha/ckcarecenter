<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Dynamic Title --}}
    <title>@yield('title', 'C & K Home Nursing and Care Center | Professional Home Nursing in Sri Lanka')</title>

    {{-- Basic Meta Tags --}}
    <meta name="author" content="C & K Home Nursing and Care Center">
    <meta name="description" content="@yield('meta_description', 'C & K Home Nursing and Care Center provides professional home nursing and elder care services in Piliyandala, Sri Lanka. Compassionate, trusted, and affordable care at your doorstep.')">
    <meta name="keywords" content="@yield('meta_keywords', 'home nursing Sri Lanka, elder care Piliyandala, nursing care Kesbewa, C&K home nursing, home nursing services Sri Lanka, elder care center Sri Lanka, professional nursing care, home care services')">
    <meta name="robots" content="INDEX,FOLLOW">

    {{-- Canonical URL --}}
    <link rel="canonical" href="{{ url()->current() }}" />

    {{-- Open Graph Meta Tags --}}
    <meta property="og:title" content="@yield('title', 'C & K Home Nursing and Care Center | Professional Home Nursing in Sri Lanka')">
    <meta property="og:description" content="@yield('meta_description', 'C & K Home Nursing and Care Center provides professional home nursing and elder care services in Piliyandala, Sri Lanka. Compassionate, trusted, and affordable care at your doorstep.')">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('assets/image/logo/og_image.webp'))">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="C & K Home Nursing and Care Center">
    <meta property="og:locale" content="en_US">

    {{-- Twitter Card Tags --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'C & K Home Nursing and Care Center | Professional Home Nursing in Sri Lanka')">
    <meta name="twitter:description" content="@yield('meta_description', 'C & K Home Nursing and Care Center provides professional home nursing and elder care services in Piliyandala, Sri Lanka.')">
    <meta name="twitter:image" content="@yield('og_image', asset('assets/image/logo/og_image.webp'))">

    {{-- Theme Colors --}}
    <meta name="theme-color" content="#1A4137">
    <meta name="msapplication-navbutton-color" content="#1A4137">
    <meta name="apple-mobile-web-app-status-bar-style" content="#1A4137">

    {{-- Favicons --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/image/logo/logo_4.webp') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/image/logo/logo_4.webp') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/image/logo/logo_4.webp') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/image/logo/logo_4.webp') }}">

    {{-- Stylesheets --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/shishirraven/animate-on-scroll@v1.2/animation_utility.css">

    @stack('styles')

    {{-- Schema.org Markup for Local Business --}}
    @verbatim
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "LocalBusiness",
        "name": "C & K Home Nursing and Care Center",
        "description": "Professional home nursing and elder care services in Piliyandala, Sri Lanka.",
        "url": "https://nursingcare.lk",
        "telephone": "+94773768767",
        "email": "candkhomenursing17@gmail.com",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "No 50, Kudamaduwa Road, Siddamull",
            "addressLocality": "Piliyandala",
            "addressRegion": "Kesbewa",
            "addressCountry": "LK"
        },
        "sameAs": [
            "https://www.facebook.com/candkhomenursingandcarecenter.lk/"
        ]
    }
    </script>
    @endverbatim

</head>

<body>
    <!-- Header -->
    
    <!-- End Header -->

    <!-- Main -->
    <main>
        @include('frontend.components.header')

        @yield('content')

        @include('frontend.components.footer')
    </main>



    <!-- Scripts -->
    <script src="{{ asset('assets/js/vendor/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/js/swiper-script.js') }}"></script>
    <script src="{{ asset('assets/js/submit-form.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/video_embedded.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/fslightbox.js') }}"></script>
    <script
        src="https://cdn.jsdelivr.net/gh/shishirraven/animate-on-scroll@v1.0/oyethemes_onscroll_animation.js"></script>

    @stack('scripts')
</body>

</html>