@push('head')
<!-- Preload hero images with correct attributes for LCP optimization -->
<link rel="preload" as="image" 
      href="{{ asset('assets/img/hero/1.webp') }}" 
      media="(min-width: 769px)" 
      fetchpriority="high" 
      crossorigin>
<link rel="preload" as="image" 
      href="{{ asset('assets/img/hero/1.webp') }}" 
      media="(max-width: 768px)" 
      fetchpriority="high" 
      crossorigin>

<!-- Inline critical CSS for immediate rendering -->
<style>
/* Critical above-fold styles - prevents render delay */
section.section-dark.text-light.no-top.no-bottom.position-relative.overflow-hidden.z-1000 {
    height: 700px !important;
    min-height: 700px !important;
}
section.section-dark.text-light.no-top.no-bottom.position-relative.overflow-hidden.z-1000 .v-center,
section.section-dark.text-light.no-top.no-bottom.position-relative.overflow-hidden.z-1000 .swiper,
section.section-dark.text-light.no-top.no-bottom.position-relative.overflow-hidden.z-1000 .swiper-slide,
section.section-dark.text-light.no-top.no-bottom.position-relative.overflow-hidden.z-1000 .swiper-inner {
    height: 100%;
}
.swiper-inner {
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}
</style>
@endpush

<section class="section-dark text-light no-top no-bottom position-relative overflow-hidden z-1000">
    <div class="v-center">
        <div class="swiper">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slide 1 - Main Headline Focus - OPTIMIZED FOR LCP -->
                <div class="swiper-slide">
                    <!-- Use inline background-image for immediate load, NO loading="lazy" -->
                    <div class="swiper-inner" style="background-image: url('{{ asset('assets/img/hero/1.webp') }}');">
                        <div class="sw-caption">
                            <div class="container">
                                <div class="row g-4 justify-content-center">
                                    <div class="spacer-double"></div>
                                    <div class="col-lg-8 text-center">
                                        <div class="spacer-single"></div>
                                        <div class="sw-text-wrapper">
                                            <div class="subtitle mb-2">Premium Luxury Retirement Homes in Sri Lanka</div>
                                            <h1 class="slider-title mb-3">With Dignity, Safety & Compassion</h1>
                                            <p class="slider-teaser mb-3">Trusted by families locally and abroad to care for their loved ones.</p>
                                            <div class="spacer-10"></div>
                                            <div class="d-flex flex-column flex-md-row justify-content-center gap-3">
                                                <a class="btn-main bg-color-2 mb10 mb-3" href="{{ route('lead-form') }}#Admissions-Process">Request Admission Info</a>
                                                <a class="btn-main bg-transparent border-light text-light mb10 mb-3" href="{{ route('lead-form') }}" style="border: 1px solid white;">Book a Visit / Virtual Tour</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="spacer-single"></div>
                                </div>
                            </div>
                        </div>
                        <div class="sw-overlay op-4"></div>
                        <!-- PHSRC Registered Badge -->
                        <div class="phsrc-badge">
                            <img src="{{ asset('assets/img/Home-img/PHSRC.webp') }}" alt="PHSRC Registered" width="50" height="50">
                            <span class="phsrc-text">PHSRC Registered</span>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 - Luxury & Compassion Focus -->
                <div class="swiper-slide">
                    <div class="swiper-inner" 
                         data-bgimage="url(assets/img/hero/2.webp)" 
                         data-bgimage-mobile="url(assets/img/hero/2_mobile.webp)" 
                         loading="lazy">
                        <div class="sw-caption">
                            <div class="container">
                                <div class="row g-4 justify-content-center">
                                    <div class="spacer-double"></div>
                                    <div class="col-lg-8 text-center">
                                        <div class="spacer-single"></div>
                                        <div class="sw-text-wrapper">
                                            <div class="subtitle mb-2">Premium Luxury Living</div>
                                            <h2 class="slider-title mb-3" style="letter-spacing: 0.02em;">Where Compassion Meets Premium Care</h2>
                                            <p class="slider-teaser mb-3">Experience luxury retirement living with personalized care, safety, and dignity for your loved ones.</p>
                                            <div class="spacer-10"></div>
                                            <div class="d-flex flex-column flex-md-row justify-content-center gap-3">
                                                <a class="btn-main bg-color-2 mb10 mb-3" href="{{ route('lead-form') }}#Admissions-Process">Request Admission Info</a>
                                                <a class="btn-main bg-transparent border-light text-light mb10 mb-3" href="{{ route('lead-form') }}" style="border: 1px solid white;">Schedule a Virtual Tour</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="spacer-single"></div>
                                </div>
                            </div>
                        </div>
                        <div class="sw-overlay op-4"></div>
                        <!-- PHSRC Registered Badge -->
                        <div class="phsrc-badge">
                            <img src="{{ asset('assets/img/Home-img/PHSRC.webp') }}" alt="PHSRC Registered" width="50" height="50" loading="lazy">
                            <span class="phsrc-text">PHSRC Registered</span>
                        </div>
                    </div>
                </div>

                <!-- Slide 3 - Trust & Family Focus -->
                <div class="swiper-slide">
                    <div class="swiper-inner" 
                         data-bgimage="url(assets/img/hero/3.webp)" 
                         data-bgimage-mobile="url(assets/img/hero/3_mobile.webp)" 
                         loading="lazy">
                        <div class="sw-caption">
                            <div class="container">
                                <div class="row g-4 justify-content-center">
                                    <div class="spacer-double"></div>
                                    <div class="col-lg-8 text-center">
                                        <div class="spacer-single"></div>
                                        <div class="sw-text-wrapper">
                                            <div class="subtitle mb-2">Trusted by Families Worldwide</div>
                                            <h2 class="slider-title mb-3">Sri Lanka's Premier Retirement Homes</h2>
                                            <p class="slider-teaser mb-3">Providing exceptional care with dignity, safety, and compassion for elderly residents.</p>
                                            <div class="spacer-10"></div>
                                            <div class="d-flex flex-column flex-md-row justify-content-center gap-3">
                                                <a class="btn-main bg-color-2 mb10 mb-3" href="{{ route('lead-form') }}#Admissions-Process">Get Admission Details</a>
                                                <a class="btn-main bg-transparent border-light text-light mb10 mb-3" href="{{ route('lead-form') }}" style="border: 1px solid white;">Book an In-Person Visit</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="spacer-single"></div>
                                </div>
                            </div>
                        </div>
                        <div class="sw-overlay op-4"></div>
                        <!-- PHSRC Registered Badge -->
                        <div class="phsrc-badge">
                            <img src="{{ asset('assets/img/Home-img/PHSRC.webp') }}" alt="PHSRC Registered" width="50" height="50" loading="lazy">
                            <span class="phsrc-text">PHSRC Registered</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- If we need pagination -->
            <div class="swiper-pagination"></div>
            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
            <!-- If we need scrollbar -->
            <div class="swiper-scrollbar"></div>
        </div>
    </div>
</section>



<section class="pt-0 relative z-1000">
    <div class="container mt-min-50">
        <div class="row">
            <div class="col-lg-12">
                <div class="bg-white p-20 rounded-1 shadow-soft">
                    <div class="row g-4">

                        <!-- Feature 1: Years of Experience -->
                        <div class="col-lg-3 col-md-6">
                            <div class="relative">
                                <i class="icofont-history absolute id-color fs-36"></i>
                                <div class="ps-60">
                                    <p class="mb-0 fs-16 fw-600">Years of Experience</p>
                                    <p class="mb-0 fs-13">Decades of trusted senior care expertise.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Feature 2: 24/7 Medical Support -->
                        <div class="col-lg-3 col-md-6">
                            <div class="relative">
                                <i class="icofont-stethoscope-alt absolute id-color fs-36"></i>
                                <div class="ps-60">
                                    <p class="mb-0 fs-16 fw-600">24/7 Medical Support</p>
                                    <p class="mb-0 fs-13">Round-the-clock professional healthcare.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Feature 3: Secure & Comfortable Facilities -->
                        <div class="col-lg-3 col-md-6">
                            <div class="relative">
                                <i class="icofont-home absolute id-color fs-36"></i>
                                <div class="ps-60">
                                    <p class="mb-0 fs-16 fw-600">Secure & Comfortable</p>
                                    <p class="mb-0 fs-13">Designed for safety, comfort, and peace.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Feature 4: Engaging Activities -->
                        <div class="col-lg-3 col-md-6">
                            <div class="relative">
                                <i class="icofont-users-alt-5 absolute id-color fs-36"></i>
                                <div class="ps-60">
                                    <p class="mb-0 fs-16 fw-600">Engaging Activities</p>
                                    <p class="mb-0 fs-13">Highly rated by families.</p>
                                    <div class="rating-stars mt-1">
                                        <i class="icofont-star text-warning fs-12"></i>
                                        <i class="icofont-star text-warning fs-12"></i>
                                        <i class="icofont-star text-warning fs-12"></i>
                                        <i class="icofont-star text-warning fs-12"></i>
                                        <i class="icofont-star text-warning fs-12"></i>
                                        <span class="ms-1 fs-11">(4.9/5)</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                    <!-- CTA Link Centered Below Features -->
                    <div class="text-center mt-4 pt-2">
                        <a href="#testimonials" class="text-decoration-none fs-14 fw-600 text-dark">
                            <i class="icofont-arrow-right me-1 fs-12"></i>
                            See Why Families Trust Care365
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

            

<style>
/* ====== LCP OPTIMIZED STYLES ====== */

/* Hero Section Height - Set to 700px as client requested */
section.section-dark.text-light.no-top.no-bottom.position-relative.overflow-hidden.z-1000 {
    height: 700px !important;
    min-height: 700px !important;
}

/* Make all containers fill the 700px height */
section.section-dark.text-light.no-top.no-bottom.position-relative.overflow-hidden.z-1000 .v-center,
section.section-dark.text-light.no-top.no-bottom.position-relative.overflow-hidden.z-1000 .swiper,
section.section-dark.text-light.no-top.no-bottom.position-relative.overflow-hidden.z-1000 .swiper-slide,
section.section-dark.text-light.no-top.no-bottom.position-relative.overflow-hidden.z-1000 .swiper-inner {
    height: 100%;
}

/* Ensure background images cover properly within 700px height */
section.section-dark.text-light.no-top.no-bottom.position-relative.overflow-hidden.z-1000 .swiper-inner {
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

/* MAIN OVERLAY - Standard for all screens */
section.section-dark.text-light.no-top.no-bottom.position-relative.overflow-hidden.z-1000 .swiper-inner::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.4); /* Reduced from 0.5 to 0.4 for better visibility */
    z-index: 1;
}

/* Text content above overlay */
section.section-dark.text-light.no-top.no-bottom.position-relative.overflow-hidden.z-1000 .sw-caption {
    position: relative;
    z-index: 2;
}

/* Subtitle styling with proper contrast */
.subtitle {
    color: #F0F9FF; /* Light blue-white for excellent contrast on dark backgrounds */
}

/* ====== PHSRC REGISTERED BADGE STYLING ====== */
.phsrc-badge {
    position: absolute;
    top: 100px;
    right: 20px;
    z-index: 10;
    background: rgba(255, 255, 255, 0.95);
    padding: 2px 2px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    display: flex;
    align-items: center;
    gap: 10px;
    backdrop-filter: blur(5px);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.phsrc-badge:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
}

.phsrc-badge img {
    height: 50px;
    width: auto;
    display: block;
}

.phsrc-badge .phsrc-text {
    font-size: 11px;
    font-weight: 700;
    color: #1E293B;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    line-height: 1.3;
    max-width: 80px;
}

/* Desktop font sizes for 700px height */
section.section-dark.text-light.no-top.no-bottom.position-relative.overflow-hidden.z-1000 .slider-title {
    font-size: 2.5rem !important; /* 40px */
    line-height: 1.2 !important;
    margin-bottom: 0.5rem !important;
    color: #ffffff;
    letter-spacing: 0.05em !important; /* Desktop letter spacing */
}

section.section-dark.text-light.no-top.no-bottom.position-relative.overflow-hidden.z-1000 .subtitle {
    font-size: 1rem !important; /* 16px */
    margin-bottom: 1rem !important;
}

section.section-dark.text-light.no-top.no-bottom.position-relative.overflow-hidden.z-1000 .slider-teaser {
    font-size: 1.125rem !important; /* 18px */
    line-height: 1.5 !important;
    margin-bottom: 1.5rem !important;
    color: #F8FAFC;
}

/* ====== FEATURE SECTION UTILITY CLASSES ====== */
.fs-36 { font-size: 36px; }
.fs-16 { 
    font-size: 16px; 
    color: #0F172A; /* Ensure dark color for headings */
}
.fs-14 { font-size: 14px; }
.fs-13 { 
    font-size: 13px;
    color: #475569; /* Accessible gray color */
}
.fs-12 { font-size: 12px; }
.fs-11 { 
    font-size: 11px;
    color: #475569; /* Accessible gray color */
}
.fw-600 { font-weight: 600; }
.ps-60 { padding-left: 60px; }
.text-dark { color: #1E293B !important; }

/* Feature box hover effect */
.bg-white.p-20.rounded-1.shadow-soft {
    transition: box-shadow 0.3s ease;
}

.bg-white.p-20.rounded-1.shadow-soft:hover {
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
}

/* Feature icons positioning */
.relative {
    position: relative;
}

/*
.absolute {
    position: absolute;
    left: 0;
    top: 0;
}
/*

/* ====== MOBILE RESPONSIVENESS ====== */

/* Tablet - 768px and below */
@media (max-width: 768px) {
    section.section-dark.text-light.no-top.no-bottom.position-relative.overflow-hidden.z-1000 {
        height: 500px !important;
        min-height: 500px !important;
    }
    
    /* Better mobile image positioning */
    section.section-dark.text-light.no-top.no-bottom.position-relative.overflow-hidden.z-1000 .swiper-inner {
        background-position: center center !important;
        background-size: cover !important;
    }
    
    /* Mobile background image switching */
    section.section-dark.text-light.no-top.no-bottom.position-relative.overflow-hidden.z-1000 .swiper-slide:first-child .swiper-inner {
        background-image: url('{{ asset('assets/img/hero/1_mobile.webp') }}') !important;
    }
    
    /* LIGHTER overlay for mobile - text is already smaller so needs less darkness */
    section.section-dark.text-light.no-top.no-bottom.position-relative.overflow-hidden.z-1000 .swiper-inner::before {
        background: rgba(0, 0, 0, 0.35) !important; /* Lighter than desktop */
    }
    
    /* PHSRC Badge - Tablet */
    .phsrc-badge {
        top: 80px;
        right: 15px;
        padding: 2px 2px;
        gap: 8px;
    }
    
    .phsrc-badge img {
        height: 40px;
    }
    
    .phsrc-badge .phsrc-text {
        font-size: 10px;
        max-width: 70px;
    }
    
    /* Tablet font sizes */
    section.section-dark.text-light.no-top.no-bottom.position-relative.overflow-hidden.z-1000 .slider-title {
        font-size: 1.75rem !important; /* 28px */
        line-height: 1.3 !important;
        margin-bottom: 0.4rem !important;
        letter-spacing: 0.03em !important; /* Tablet letter spacing */
    }
    
    section.section-dark.text-light.no-top.no-bottom.position-relative.overflow-hidden.z-1000 .subtitle {
        font-size: 0.875rem !important; /* 14px */
        margin-bottom: 0.75rem !important;
    }
    
    section.section-dark.text-light.no-top.no-bottom.position-relative.overflow-hidden.z-1000 .slider-teaser {
        font-size: 0.95rem !important; /* 15px */
        line-height: 1.4 !important;
        margin-bottom: 1rem !important;
    }
    
    /* Feature section responsive */
    .ps-60 {
        padding-left: 55px;
    }
    
    .fs-36 {
        font-size: 32px;
    }
}

/* Small mobile - 576px and below */
@media (max-width: 576px) {
    section.section-dark.text-light.no-top.no-bottom.position-relative.overflow-hidden.z-1000 {
        height: 450px !important;
        min-height: 450px !important;
        padding: 0 15px !important;
    }
    
    /* Even lighter overlay for small screens */
    section.section-dark.text-light.no-top.no-bottom.position-relative.overflow-hidden.z-1000 .swiper-inner::before {
        background: rgba(0, 0, 0, 0.3) !important; /* Much lighter for mobile */
    }
    
    /* PHSRC Badge - Mobile */
    .phsrc-badge {
        top: 45px;
        right: 12px;
        padding: 2px 2px;
        gap: 6px;
        border-radius: 6px;
    }
    
    .phsrc-badge img {
        height: 35px;
    }
    
    .phsrc-badge .phsrc-text {
        font-size: 9px;
        max-width: 60px;
        letter-spacing: 0.3px;
    }
    
    /* Mobile font sizes */
    section.section-dark.text-light.no-top.no-bottom.position-relative.overflow-hidden.z-1000 .slider-title {
        font-size: 1.5rem !important; /* 24px */
        line-height: 1.3 !important;
        margin-bottom: 0.3rem !important;
        letter-spacing: 0.02em !important; /* Mobile letter spacing */
    }
    
    section.section-dark.text-light.no-top.no-bottom.position-relative.overflow-hidden.z-1000 .subtitle {
        font-size: 0.8rem !important; /* 13px */
        margin-bottom: 0.5rem !important;
    }
    
    section.section-dark.text-light.no-top.no-bottom.position-relative.overflow-hidden.z-1000 .slider-teaser {
        font-size: 0.875rem !important; /* 14px */
        line-height: 1.4 !important;
        margin-bottom: 0.75rem !important;
    }
    
    /* Feature section mobile */
    .ps-60 {
        padding-left: 50px;
    }
    
    .fs-36 {
        font-size: 28px;
    }
    
    .fs-16 {
        font-size: 15px;
    }
    
    .fs-13 {
        font-size: 12px;
    }
    
    /* Stack features on mobile for better readability */
    .col-md-6 {
        margin-bottom: 1.5rem;
    }
    
    .col-md-6:last-child {
        margin-bottom: 0;
    }
}

/* Extra small mobile - 375px and below */
@media (max-width: 375px) {
    section.section-dark.text-light.no-top.no-bottom.position-relative.overflow-hidden.z-1000 {
        height: 400px !important;
        min-height: 400px !important;
    }
    
    /* Very light overlay for tiny screens */
    section.section-dark.text-light.no-top.no-bottom.position-relative.overflow-hidden.z-1000 .swiper-inner::before {
        background: rgba(0, 0, 0, 0.25) !important; /* Minimal overlay */
    }
    
    /* PHSRC Badge - Extra Small */
    .phsrc-badge {
        top: 50px;
        right: 10px;
        padding: 2px 2px;
        gap: 5px;
    }
    
    .phsrc-badge img {
        height: 30px;
    }
    
    .phsrc-badge .phsrc-text {
        font-size: 8px;
        max-width: 50px;
    }
    
    /* Smallest font sizes */
    section.section-dark.text-light.no-top.no-bottom.position-relative.overflow-hidden.z-1000 .slider-title {
        font-size: 1.25rem !important; /* 20px */
        line-height: 1.25 !important;
        letter-spacing: 0.015em !important; /* Extra small letter spacing */
    }
    
    section.section-dark.text-light.no-top.no-bottom.position-relative.overflow-hidden.z-1000 .subtitle {
        font-size: 0.75rem !important; /* 12px */
    }
    
    section.section-dark.text-light.no-top.no-bottom.position-relative.overflow-hidden.z-1000 .slider-teaser {
        font-size: 0.8125rem !important; /* 13px */
        line-height: 1.35 !important;
    }
}
</style>