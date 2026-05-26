<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-P5L8CQNB');</script>
    <!-- End Google Tag Manager -->


    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    {{-- Dynamic Title --}}
    <title>@yield('title', 'Care365 - Luxury Retirement Living in Sri Lanka | Elder Care Homes')</title>

    {{-- Basic Meta Tags --}}
    <meta name="author" content="@yield('meta_author', 'Care365')">
    <meta name="description" content="@yield('meta_description', 'CARE 365: Luxury retirement living where seniors thrive with joy, independence, and exceptional care. We provide compassionate and personalized care for seniors in a warm and home-like environment in Sri Lanka.')">
    <meta name="keywords" content="@yield('meta_keywords', 'Elder care homes in Sri Lanka, Elderly homes in Sri Lanka, Best retirement homes for seniors in Sri Lanka, Elder care, senior living facilities Sri Lanka, 24/7 medical elder care in Sri Lanka, Safe and secure elder care homes, Affordable luxury senior care Sri Lanka, Trusted elder care for Sri Lanka, Senior living with luxury amenities Sri Lanka, Senior Care facilities')">
    <meta name="robots" content="INDEX,FOLLOW">

    {{-- Canonical URL --}}
    <link rel="canonical" href="{{ url()->current() }}" />

    {{-- Open Graph Meta Tags --}}
    <meta property="og:title" content="@yield('title', 'Care365 - Luxury Retirement Living in Sri Lanka | Elder Care Homes')">
    <meta property="og:description" content="@yield('meta_description', 'CARE 365: Luxury retirement living where seniors thrive with joy, independence, and exceptional care. We provide compassionate and personalized care for seniors in a warm and home-like environment in Sri Lanka.')">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('assets/img/logo.webp'))">
    <meta property="og:site_name" content="Care365">
    <meta property="og:locale" content="en_US">

    {{-- Twitter Card Tags --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'Care365 - Luxury Retirement Living in Sri Lanka | Elder Care Homes')">
    <meta name="twitter:description" content="@yield('meta_description', 'CARE 365: Luxury retirement living where seniors thrive with joy, independence, and exceptional care.')">
    <meta name="twitter:image" content="@yield('og_image', asset('assets/img/logo.webp'))">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- For Window Tab Color -->
    <meta name="theme-color" content="#1A4137">
    <meta name="msapplication-navbutton-color" content="#1A4137">
    <meta name="apple-mobile-web-app-status-bar-style" content="#1A4137">

    <!-- Optimized Favicons (reduced redundancy) -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/logo.webp') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/logo.webp') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/logo.webp') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('assets/img/logo.webp') }}">

    <!--==============================
    Resource Hints for Performance
    ============================== -->
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!--==============================
    Preload Critical Resources
    ============================== -->
    <link rel="preload" href="{{ asset('assets/css/bootstrap.min.css') }}" as="style">
    <link rel="preload" href="{{ asset('assets/css/style.css') }}" as="style">
    <link rel="preload" href="{{ asset('assets/js/plugins.js') }}" as="script">

    <!--==============================
    Google Fonts - Combined & Optimized
    ============================== -->
    <link
        href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&family=Onest:wght@100..900&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!--==============================
    Critical CSS (loaded immediately)
    ============================== -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css">

    <!--==============================
    Non-Critical CSS (loaded asynchronously)
    ============================== -->
    <link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" media="print"
        onload="this.media='all'; this.onload=null;">
    <link href="{{ asset('assets/css/swiper.css') }}" rel="stylesheet" type="text/css" media="print"
        onload="this.media='all'; this.onload=null;">
    <link href="{{ asset('assets/css/coloring.css') }}" rel="stylesheet" type="text/css" media="print"
        onload="this.media='all'; this.onload=null;">
    <link id="colors" href="{{ asset('assets/css/colors/scheme-01.css') }}" rel="stylesheet" type="text/css"
        media="print" onload="this.media='all'; this.onload=null;">


    <link href="assets/css/style.css" rel="stylesheet" type="text/css">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-QVPVV72YJ5"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-QVPVV72YJ5');
    </script>

    {{-- Google Search Console  --}}
    <meta name="google-site-verification" content="rtFgIYtRxlqOXwyPvRLxERPISEtvSZ0flkgD9e9WCbE" />

    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-58HHBB2G');
    </script>
    <!-- End Google Tag Manager -->

    {{-- Fallback for browsers that don't support onload --}}
    <noscript>
        <link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/css/swiper.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/css/coloring.css') }}" rel="stylesheet" type="text/css">
        <link id="colors" href="{{ asset('assets/css/colors/scheme-01.css') }}" rel="stylesheet"
            type="text/css">
    </noscript>

    @stack('head')
    @stack('styles')


    {{-- Schema.org Markup for Local Business --}}
    @verbatim
        <script type="application/ld+json">
        {
        "@context": "https://schema.org",
        "@type": "NursingHome",
        "name": "Care365",
        "description": "Luxury retirement living where seniors thrive with joy, independence, and exceptional care in Sri Lanka.",
        "url": "{{ url('/') }}",
        "telephone": "0779191818",
        "address": {
            "@type": "PostalAddress",
            "addressCountry": "LK"
        },
        "sameAs": [
            "https://www.facebook.com/Care36t5"
        ]
        }
        </script>
    @endverbatim

</head>

<body>

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P5L8CQNB"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->


<!-- 
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P5L8CQNB"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
 -->


    <div id="wrapper">
        @include('frontend.components.popups')
        <div class="float-text show-on-scroll">
            <span><a href="#">Scroll to top</a></span>
        </div>
        <div class="scrollbar-v show-on-scroll"></div>

        <!-- page preloader begin -->
        <div id="de-loader"></div>
        <!-- page preloader close -->

        <!-- header begin -->
        @include('frontend.components.header')
        <!-- header close -->

        <!-- content begin -->
        <main class="no-bottom no-top" id="content" role="main">
            <div id="top"></div>
            @yield('content')
        </main>
        <!-- content close -->

        <!-- footer begin -->
        @include('frontend.components.footer')
        <!-- footer close -->
    </div>

    <!--==============================
    JavaScript Files - Optimized Loading
    ============================== -->
    {{-- Non-critical JavaScript - Deferred loading --}}
    <script src="{{ asset('assets/js/plugins.js') }}" defer></script>

    {{-- Non-critical JavaScript - Deferred loading --}}
    <script src="{{ asset('assets/js/designesia.js') }}" defer></script>
    <script src="{{ asset('assets/js/swiper.js') }}" defer></script>
    <script src="{{ asset('assets/js/custom-marquee.js') }}" defer></script>
    <script src="{{ asset('assets/js/custom-swiper-1.js') }}" defer></script>
    <script src="{{ asset('assets/js/jquery.event.move.js') }}" defer></script>
    <script src="{{ asset('assets/js/jquery.twentytwenty.js') }}" defer></script>

    {{-- Initialize TwentyTwenty after all scripts load --}}
    <script>
        // Use window load event for all resources including deferred scripts
        window.addEventListener('load', function() {
            // Check if jQuery and twentytwenty are available
            if (typeof $ !== 'undefined' && $.fn.twentytwenty) {
                $(".twentytwenty-container[data-orientation!='vertical']").twentytwenty({
                    default_offset_pct: 0.5
                });
                $(".twentytwenty-container[data-orientation='vertical']").twentytwenty({
                    default_offset_pct: 0.5,
                    orientation: 'vertical'
                });
            }
        });
    </script>

    @stack('scripts')

</body>

</html>
