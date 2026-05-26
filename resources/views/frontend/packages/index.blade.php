@extends('layouts.frontend')

<!doctype html>
<html class="no-js" lang="zxx" dir="ltr">



<body class="">

    <!--[if lte IE 9]>
    	<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  	<![endif]-->


    <!--********************************
   		Code Start From Here 
	******************************** -->
    <div class="cursor-follower"></div>

    <!-- slider drag cursor -->
    <!-- <div class="slider-drag-cursor"> DRAG </div> -->

    <!--==============================
    Breadcumb
============================== -->
    <div class="breadcumb-wrapper bg-smoke2">
        <div class="breadcumb-bg-thumb" data-overlay="title" data-opacity="5" data-bg-src="assets/img/bg/breadcumb-bg.png"></div>
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="breadcumb-content">
                        <h1 class="breadcumb-title text-anim" data-cue="slideInUp" data-delay="100">Pricing Plan</h1>
                        <ul class="breadcumb-menu">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li>Pricing Plan</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--==============================
Price Area  
==============================-->
    <section class="price-sec-2 overflow-hidden space" data-bg-src="assets/img/bg/pricing-2-bg.png">
        <div class="container th-container2">
            <div class="wrapper-pack">
                <div class="row gy-4 justify-content-center">

                    <div class="col-xl-6 col-lg-8 col-md-10" data-cue="slideInUp">
                        <div class="price-card active-plan">
                            <p class="premium">Premium Care Package</p>
                            <div class="price-card-inner">
                                <h3 class="box-title">Private Heaven</h3>
                                <p class="box-text">Monthly Package</p>
                                <div class="price_card-wrap">
                                    <h4 class="price-card_price">LKR 175,000<span class="duration"> Upwards/Monthly</span></h4>
                                    <p style="margin-top: 10px; font-size: 14px; color: #666;">(Approximately $575 USD Monthly)</p>
                                </div>

                                <div class="checklist">
                                    <ul>
                                        <li><i class="fa-solid fa-check"></i> Individual Room</li>
                                        <li><i class="fa-solid fa-check"></i> Wardrobe/ Mirror/Chair with Mini Table</li>
                                        <li><i class="fa-solid fa-check"></i> In Suit Bathroom</li>
                                        <li><i class="fa-solid fa-check"></i> Separate Double Bed with double layer Mattress + Pillow + Bedding</li>
                                        <li><i class="fa-solid fa-check"></i> PEO TV Facility</li>
                                        <li><i class="fa-solid fa-check"></i> Additional Medication Management (T&amp;C Apply)</li>
                                        <li><i class="fa-solid fa-check"></i> Extra Meal Package &amp; Switch Menu x 2 (T&amp;C Apply)</li>
                                        <li><i class="fa-solid fa-check"></i> Birthday Surprise service with Pik Bokz</li>
                                        <li><i class="fa-solid fa-check"></i> Mini Fridge</li>
                                        <li><i class="fa-solid fa-check"></i> Air Conditioning (T&amp;C Apply)</li>
                                        <li><i class="fa-solid fa-check"></i> Door Bell Communication System</li>
                                        <li><i class="fa-solid fa-check"></i> Common Library/ TV Lobby / Garden</li>
                                        <li><i class="fa-solid fa-check"></i> Weekend News Papers</li>
                                        <li><i class="fa-solid fa-check"></i> Monthly activity plans &amp; access to our "Fun Time Club"</li>
                                    </ul>
                                </div>
                                
                                <div style="text-align: center; margin-top: 30px;">
                                    <a href="{{ route('contact') }}" class="th-btn">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>    </section>
    <!--==============================
Cta Area  
==============================-->
    <!-- <section class="overflow-hidden space-top">
        <div class="cta-wrap3 bg-theme-dark">
            <div class="container th-container">
                <div class="row gy-4">
                    <div class="col-lg-6">
                        <div class="cta2-content-wrap mega-hover" data-cue="slideInUp" data-bg-src="assets/img/bg/cta-bg-3-1.png">
                            <div class="shape-mockup d-xl-block d-none jump" data-left="39%" data-top="60%">
                                <img src="assets/img/shape/shape1-49.png" alt="img">
                            </div>
                            <div class="left-content">
                                <span class="subtitle">15% OFF</span>
                                <h4 class="box-title">Fresh Natural Pets Food</h4>
                                <a href="shop.html" class="th-btn style3">Shop Now</a>
                            </div>
                            <div class="img-box">
                                <img src="assets/img/cta/cta-2-1.png" alt="img">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="cta2-content-wrap mega-hover" data-cue="slideInUp" data-bg-src="assets/img/bg/cta-bg-3-2.png">
                            <div class="left-content">
                                <span class="subtitle">15% OFF</span>
                                <h4 class="box-title">Fresh Natural Pets Food</h4>
                                <a href="shop.html" class="th-btn style3">Shop Now</a>
                            </div>
                            <div class="img-box">
                                <img src="assets/img/cta/cta-2-2.png" alt="img">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <!--==============================
Marquee Area  
==============================-->
    <div class="overflow-hidden space-bottom">
        <div class="container-fluid p-0" data-cue="slideInUp">
            <div class="swiper th-slider marquee-slider1" data-slider-options='{"breakpoints":{"0":{"slidesPerView":"auto"}},"autoplay":{"delay":0,"disableOnInteraction":false},"noSwiping":"true","speed":10000,"spaceBetween":0}'>
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="marquee-card">
                            <div class="marquee-icon">
                                <img src="assets/img/icon/marquee-icon1-1.svg" alt="img">
                            </div>
                            <a target="_blank" href="#">
                                Comfort </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="marquee-card">
                            <div class="marquee-icon">
                                <img src="assets/img/icon/marquee-icon1-1.svg" alt="img">
                            </div>
                            <a target="_blank" href="#">
                                Quality of Life </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="marquee-card">
                            <div class="marquee-icon">
                                <img src="assets/img/icon/marquee-icon1-1.svg" alt="img">
                            </div>
                            <a target="_blank" href="#">
                                Continuum of Care </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="marquee-card">
                            <div class="marquee-icon">
                                <img src="assets/img/icon/marquee-icon1-1.svg" alt="img">
                            </div>
                            <a target="_blank" href="#">
                                friendly Staff </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="marquee-card">
                            <div class="marquee-icon">
                                <img src="assets/img/icon/marquee-icon1-1.svg" alt="img">
                            </div>
                            <a target="_blank" href="#">
                                Customized Care Plans </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="marquee-card">
                            <div class="marquee-icon">
                                <img src="assets/img/icon/marquee-icon1-1.svg" alt="img">
                            </div>
                            <a target="_blank" href="#">
                                Holistic Approach </a>
                        </div>
                    </div>
                    
                    <div class="swiper-slide">
                        <div class="marquee-card">
                            <div class="marquee-icon">
                                <img src="assets/img/icon/marquee-icon1-1.svg" alt="img">
                            </div>
                            <a target="_blank" href="#">
                                Expertise </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    

    <!--********************************
			Code End  Here 
	******************************** -->

    <!-- Scroll To Top -->
    <div class="scroll-top">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;"></path>
        </svg>
    </div>

    <!--==============================
    All Js File
============================== -->
    <!-- Jquery -->
    <script src="assets/js/vendor/jquery-3.7.1.min.js"></script>
    <!-- Swiper Js -->
    <script src="assets/js/swiper-bundle.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Magnific Popup -->
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <!-- Counter Up -->
    <script src="assets/js/jquery.counterup.min.js"></script>
    <!-- Range Slider -->
    <script src="assets/js/jquery-ui.min.js"></script>
    <!-- Isotope Filter -->
    <script src="assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="assets/js/isotope.pkgd.min.js"></script>
    <!-- Cue Js -->
    <script src="assets/js/scrollCue.min.js"></script>
    <!-- Gsap -->
    <script src="assets/js/gsap.min.js"></script>
    <!-- Scroll Trigger -->
    <script src="assets/js/ScrollTrigger.min.js"></script>
    <!-- Split Text -->
    <script src="assets/js/SplitText.min.js"></script>
    <!-- Lenis Js -->
    <script src="assets/js/lenis.min.js"></script>

    <!-- Perticle Js -->
    <script src="assets/js/particles.min.js"></script>
    <script src="assets/js/particles-config.js"></script>

    <!-- Main Js File -->
    <script src="assets/js/main.js"></script>
</body>

</html>