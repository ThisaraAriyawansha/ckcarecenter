<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/shishirraven/animate-on-scroll@v1.2/animation_utility.css">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/image/logo/logo_4.webp') }}">
    <title>C & K Home Nursing and Care Center</title>
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
</body>

</html>