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
    <div class="breadcumb-wrapper ">
        <div class="breadcumb-bg-thumb" data-overlay="title" data-opacity="5" data-bg-src="assets/img/bg/breadcumb-bg.png"></div>
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="breadcumb-content">
                        <h1 class="breadcumb-title text-anim" data-cue="slideInUp" data-delay="100">Our Team</h1>
                        <ul class="breadcumb-menu">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li>Team</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--==============================
Team Area  
==============================-->
    <section class="space overflow-hidden position-relative team-area-2">
        <div class="team-bg-2"><img src="assets/img/bg/team-bg-2.png" alt="img"></div>
        <div class="container th-container2">
            <div class="row gy-4 justify-content-center">
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="th-team team-card" data-cue="slideInUp">
                        <div class="img-wrap">
                            <div class="team-img">
                                <img src="assets/img/team/team-2-1.jpg" alt="Team">
                            </div>
                            <div class="rating">4.9 <i class="fa-solid fa-star"></i></div>
                        </div>
                        <div class="team-card-content">
                            <div class="left">
                                <h3 class="box-title"><a href="team-details.html">Alex Javed</a></h3>
                                <span class="team-desig">Pet Expert</span>
                            </div>

                            <div class="team-social-hover">
                                <a href="#" class="team-social-hover_btn">
                                    <i class="fa-solid fa-share-nodes"></i>
                                </a>
                                <div class="th-social">
                                    <a target="_blank" href="https://vimeo.com/"><i class="fab fa-vimeo-v"></i></a>
                                    <a target="_blank" href="https://linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                                    <a target="_blank" href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                                    <a target="_blank" href="https://facebook.com/"><i class="fab fa-facebook-f"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="th-team team-card" data-cue="slideInUp">
                        <div class="img-wrap">
                            <div class="team-img">
                                <img src="assets/img/team/team-2-2.jpg" alt="Team">
                            </div>
                            <div class="rating">4.9 <i class="fa-solid fa-star"></i></div>
                        </div>
                        <div class="team-card-content">
                            <div class="left">
                                <h3 class="box-title"><a href="team-details.html">Jessica Lauren</a></h3>
                                <span class="team-desig">Pet Expert</span>
                            </div>

                            <div class="team-social-hover">
                                <a href="#" class="team-social-hover_btn">
                                    <i class="fa-solid fa-share-nodes"></i>
                                </a>
                                <div class="th-social">
                                    <a target="_blank" href="https://vimeo.com/"><i class="fab fa-vimeo-v"></i></a>
                                    <a target="_blank" href="https://linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                                    <a target="_blank" href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                                    <a target="_blank" href="https://facebook.com/"><i class="fab fa-facebook-f"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="th-team team-card" data-cue="slideInUp">
                        <div class="img-wrap">
                            <div class="team-img">
                                <img src="assets/img/team/team-2-3.jpg" alt="Team">
                            </div>
                            <div class="rating">4.9 <i class="fa-solid fa-star"></i></div>
                        </div>
                        <div class="team-card-content">
                            <div class="left">
                                <h3 class="box-title"><a href="team-details.html">Jenny William</a></h3>
                                <span class="team-desig">Pet Expert</span>
                            </div>

                            <div class="team-social-hover">
                                <a href="#" class="team-social-hover_btn">
                                    <i class="fa-solid fa-share-nodes"></i>
                                </a>
                                <div class="th-social">
                                    <a target="_blank" href="https://vimeo.com/"><i class="fab fa-vimeo-v"></i></a>
                                    <a target="_blank" href="https://linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                                    <a target="_blank" href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                                    <a target="_blank" href="https://facebook.com/"><i class="fab fa-facebook-f"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="th-team team-card" data-cue="slideInUp">
                        <div class="img-wrap">
                            <div class="team-img">
                                <img src="assets/img/team/team-2-4.jpg" alt="Team">
                            </div>
                            <div class="rating">4.9 <i class="fa-solid fa-star"></i></div>
                        </div>
                        <div class="team-card-content">
                            <div class="left">
                                <h3 class="box-title"><a href="team-details.html">Daniel Thomas</a></h3>
                                <span class="team-desig">Pet Expert</span>
                            </div>

                            <div class="team-social-hover">
                                <a href="#" class="team-social-hover_btn">
                                    <i class="fa-solid fa-share-nodes"></i>
                                </a>
                                <div class="th-social">
                                    <a target="_blank" href="https://vimeo.com/"><i class="fab fa-vimeo-v"></i></a>
                                    <a target="_blank" href="https://linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                                    <a target="_blank" href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                                    <a target="_blank" href="https://facebook.com/"><i class="fab fa-facebook-f"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="th-team team-card" data-cue="slideInUp">
                        <div class="img-wrap">
                            <div class="team-img">
                                <img src="assets/img/team/team-2-5.jpg" alt="Team">
                            </div>
                            <div class="rating">4.9 <i class="fa-solid fa-star"></i></div>
                        </div>
                        <div class="team-card-content">
                            <div class="left">
                                <h3 class="box-title"><a href="team-details.html">Olivia Grace</a></h3>
                                <span class="team-desig">Pet Expert</span>
                            </div>

                            <div class="team-social-hover">
                                <a href="#" class="team-social-hover_btn">
                                    <i class="fa-solid fa-share-nodes"></i>
                                </a>
                                <div class="th-social">
                                    <a target="_blank" href="https://vimeo.com/"><i class="fab fa-vimeo-v"></i></a>
                                    <a target="_blank" href="https://linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                                    <a target="_blank" href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                                    <a target="_blank" href="https://facebook.com/"><i class="fab fa-facebook-f"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="th-team team-card" data-cue="slideInUp">
                        <div class="img-wrap">
                            <div class="team-img">
                                <img src="assets/img/team/team-2-6.jpg" alt="Team">
                            </div>
                            <div class="rating">4.9 <i class="fa-solid fa-star"></i></div>
                        </div>
                        <div class="team-card-content">
                            <div class="left">
                                <h3 class="box-title"><a href="team-details.html">Ethan Parker</a></h3>
                                <span class="team-desig">Pet Expert</span>
                            </div>

                            <div class="team-social-hover">
                                <a href="#" class="team-social-hover_btn">
                                    <i class="fa-solid fa-share-nodes"></i>
                                </a>
                                <div class="th-social">
                                    <a target="_blank" href="https://vimeo.com/"><i class="fab fa-vimeo-v"></i></a>
                                    <a target="_blank" href="https://linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                                    <a target="_blank" href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                                    <a target="_blank" href="https://facebook.com/"><i class="fab fa-facebook-f"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="th-team team-card" data-cue="slideInUp">
                        <div class="img-wrap">
                            <div class="team-img">
                                <img src="assets/img/team/team-2-7.jpg" alt="Team">
                            </div>
                            <div class="rating">4.9 <i class="fa-solid fa-star"></i></div>
                        </div>
                        <div class="team-card-content">
                            <div class="left">
                                <h3 class="box-title"><a href="team-details.html">Sophia Bennett</a></h3>
                                <span class="team-desig">Pet Expert</span>
                            </div>

                            <div class="team-social-hover">
                                <a href="#" class="team-social-hover_btn">
                                    <i class="fa-solid fa-share-nodes"></i>
                                </a>
                                <div class="th-social">
                                    <a target="_blank" href="https://vimeo.com/"><i class="fab fa-vimeo-v"></i></a>
                                    <a target="_blank" href="https://linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                                    <a target="_blank" href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                                    <a target="_blank" href="https://facebook.com/"><i class="fab fa-facebook-f"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="th-team team-card" data-cue="slideInUp">
                        <div class="img-wrap">
                            <div class="team-img">
                                <img src="assets/img/team/team-2-8.jpg" alt="Team">
                            </div>
                            <div class="rating">4.9 <i class="fa-solid fa-star"></i></div>
                        </div>
                        <div class="team-card-content">
                            <div class="left">
                                <h3 class="box-title"><a href="team-details.html">Liam Carter</a></h3>
                                <span class="team-desig">Pet Expert</span>
                            </div>

                            <div class="team-social-hover">
                                <a href="#" class="team-social-hover_btn">
                                    <i class="fa-solid fa-share-nodes"></i>
                                </a>
                                <div class="th-social">
                                    <a target="_blank" href="https://vimeo.com/"><i class="fab fa-vimeo-v"></i></a>
                                    <a target="_blank" href="https://linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                                    <a target="_blank" href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                                    <a target="_blank" href="https://facebook.com/"><i class="fab fa-facebook-f"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--==============================
Marquee Area  
==============================-->
    <div class="space-bottom overflow-hidden">
        <div class="container-fluid p-0" data-cue="slideInUp">
            <div class="swiper th-slider marquee-slider1" data-slider-options='{"breakpoints":{"0":{"slidesPerView":"auto"}},"autoplay":{"delay":0,"disableOnInteraction":false},"noSwiping":"true","speed":10000,"spaceBetween":0}'>
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="marquee-card">
                            <div class="marquee-icon">
                                <img src="assets/img/icon/marquee-icon1-1.svg" alt="img">
                            </div>
                            <a target="_blank" href="#">
                                Professionalism </a>
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
                    <div class="swiper-slide">
                        <div class="marquee-card">
                            <div class="marquee-icon">
                                <img src="assets/img/icon/marquee-icon1-1.svg" alt="img">
                            </div>
                            <a target="_blank" href="#">
                                Pet Care </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="marquee-card">
                            <div class="marquee-icon">
                                <img src="assets/img/icon/marquee-icon1-1.svg" alt="img">
                            </div>
                            <a target="_blank" href="#">
                                Quality </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="marquee-card">
                            <div class="marquee-icon">
                                <img src="assets/img/icon/marquee-icon1-1.svg" alt="img">
                            </div>
                            <a target="_blank" href="#">
                                Consulting </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="marquee-card">
                            <div class="marquee-icon">
                                <img src="assets/img/icon/marquee-icon1-1.svg" alt="img">
                            </div>
                            <a target="_blank" href="#">
                                Professionalism </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="marquee-card">
                            <div class="marquee-icon">
                                <img src="assets/img/icon/marquee-icon1-1.svg" alt="img">
                            </div>
                            <a target="_blank" href="#">
                                Professionalism </a>
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
                    <div class="swiper-slide">
                        <div class="marquee-card">
                            <div class="marquee-icon">
                                <img src="assets/img/icon/marquee-icon1-1.svg" alt="img">
                            </div>
                            <a target="_blank" href="#">
                                Pet Care </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="marquee-card">
                            <div class="marquee-icon">
                                <img src="assets/img/icon/marquee-icon1-1.svg" alt="img">
                            </div>
                            <a target="_blank" href="#">
                                Quality </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="marquee-card">
                            <div class="marquee-icon">
                                <img src="assets/img/icon/marquee-icon1-1.svg" alt="img">
                            </div>
                            <a target="_blank" href="#">
                                Consulting </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="marquee-card">
                            <div class="marquee-icon">
                                <img src="assets/img/icon/marquee-icon1-1.svg" alt="img">
                            </div>
                            <a target="_blank" href="#">
                                Professionalism </a>
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