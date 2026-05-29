<style>
    .hero-slider-section {
        position: relative;
        height: 88vh;
    }

    .heroSwiper {
        height: 88vh;
        overflow: hidden;
    }

    .hero-slide {
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 88vh;
        position: relative;
    }

    @media (max-width: 991px) {
        .hero-slider-section,
        .heroSwiper,
        .hero-slide {
            height: 78vh;
        }
    }

    @media (max-width: 767px) {
        .hero-slider-section,
        .heroSwiper,
        .hero-slide {
            height: 82vh;
        }
    }

    @media (max-width: 480px) {
        .hero-slider-section,
        .heroSwiper,
        .hero-slide {
            height: 85vh;
        }
    }

    .hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(110deg, rgba(10, 30, 60, 0.78) 0%, rgba(10, 30, 60, 0.35) 60%, rgba(0, 0, 0, 0.1) 100%);
    }

    .hero-content {
        position: relative;
        z-index: 2;
        height: 100%;
        display: flex;
        align-items: center;
    }

    .hero-text {
        max-width: 680px;
        color: white;
        padding-top: 80px;
        padding-bottom: 50px;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: white;
        padding: 7px 20px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 500;
        letter-spacing: 1.5px;
        margin-bottom: 1.5rem;
        text-transform: uppercase;
    }

    .hero-badge i {
        color: #a8d4f0;
        font-size: 0.75rem;
    }

    .hero-title {
        font-size: clamp(2rem, 4.5vw, 3.6rem);
        font-weight: 800;
        line-height: 1.15;
        color: white;
        margin-bottom: 1.25rem;
        letter-spacing: -0.5px;
    }

    .hero-title span {
        color: #a8d4f0;
        font-size: 1em;
    }

    .hero-divider {
        width: 60px;
        height: 4px;
        background: #a8d4f0;
        border-radius: 2px;
        margin-bottom: 1.5rem;
    }

    .hero-subtitle {
        font-size: clamp(1rem, 1.8vw, 1.2rem);
        color: rgba(255, 255, 255, 0.85);
        margin-bottom: 2.5rem;
        line-height: 1.7;
        max-width: 560px;
    }

    .hero-actions {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        align-items: center;
    }

    .btn-hero-primary {
        background: #1C3F6E;
        color: white;
        padding: 14px 36px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.95rem;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: 2px solid #1C3F6E;
    }

    .btn-hero-primary:hover {
        background: transparent;
        color: white;
        border-color: white;
    }

    .btn-hero-secondary {
        background: transparent;
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.6);
        padding: 14px 36px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.95rem;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-hero-secondary:hover {
        background: white;
        color: #1C3F6E;
        border-color: white;
    }

    /* Scroll indicator */
    .hero-scroll-indicator {
        position: absolute;
        bottom: 55px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 15;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 6px;
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.75rem;
        letter-spacing: 1px;
        text-transform: uppercase;
        animation: bounceDown 2s infinite;
    }

    .hero-scroll-indicator i {
        font-size: 1.1rem;
    }

    @keyframes bounceDown {
        0%, 100% { transform: translateX(-50%) translateY(0); opacity: 0.6; }
        50% { transform: translateX(-50%) translateY(8px); opacity: 1; }
    }

    /* Pagination — placed outside swiper so z-index works above the wave */
    .hero-pagination-ext {
        position: absolute !important;
        bottom: 100px !important;
        left: 0 !important;
        right: 0 !important;
        width: 100% !important;
        z-index: 20;
        display: flex !important;
        justify-content: center;
        align-items: center;
        gap: 6px;
        pointer-events: none;
    }

    .hero-pagination-ext .swiper-pagination-bullet {
        width: 10px;
        height: 10px;
        background: rgba(255, 255, 255, 0.5);
        opacity: 1;
        border-radius: 50%;
        transition: all 0.4s ease;
        pointer-events: all;
        cursor: pointer;
        display: inline-block;
    }

    .hero-pagination-ext .swiper-pagination-bullet-active {
        width: 32px;
        border-radius: 5px;
        background: white;
    }

    /* Navigation arrows */
    .heroSwiper .swiper-button-prev,
    .heroSwiper .swiper-button-next {
        color: white !important;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(6px);
        border: 1px solid rgba(255, 255, 255, 0.25);
        width: 52px;
        height: 52px;
        border-radius: 50%;
        transition: all 0.3s ease;
        top: 50%;
        transform: translateY(-50%);
        margin-top: 0;
    }

    .heroSwiper .swiper-button-prev {
        left: 24px;
    }

    .heroSwiper .swiper-button-next {
        right: 24px;
    }

    .heroSwiper .swiper-button-prev:hover,
    .heroSwiper .swiper-button-next:hover {
        background: rgba(255, 255, 255, 0.3);
    }

    .heroSwiper .swiper-button-prev::after,
    .heroSwiper .swiper-button-next::after {
        font-size: 1.1rem !important;
        font-weight: 700;
    }

    /* Wave shape */
    .hero-wave {
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 100%;
        z-index: 5;
        line-height: 0;
        pointer-events: none;
    }

    .hero-wave svg {
        display: block;
        width: 100%;
        height: 90px;
    }

    /* Slide counter badge */
    .hero-slide-counter {
        position: absolute;
        top: 50%;
        right: 2rem;
        transform: translateY(-50%);
        z-index: 10;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
        display: none;
    }

    @media (min-width: 1200px) {
        .hero-slide-counter {
            display: flex;
        }
    }

    @media (max-width: 767px) {
        .hero-text {
            padding-top: 30px;
            padding-bottom: 0;
            text-align: center;
        }
        .hero-badge {
            margin-bottom: 0.75rem;
            font-size: 0.72rem;
            padding: 6px 14px;
        }
        .hero-title {
            margin-bottom: 0.75rem;
        }
        .hero-divider {
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 0.75rem;
        }
        .hero-subtitle {
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }
        .hero-actions {
            justify-content: center;
            margin-bottom: 0;
        }
        .btn-hero-primary,
        .btn-hero-secondary {
            padding: 10px 24px;
            font-size: 0.85rem;
        }
        .heroSwiper .swiper-button-prev,
        .heroSwiper .swiper-button-next {
            display: none;
        }
        /* On mobile, pagination sits inside the hero image above the wave */
        .hero-pagination-ext {
            bottom: 95px !important;
        }
        .hero-pagination-ext .swiper-pagination-bullet {
            background: rgba(255, 255, 255, 0.5);
        }
        .hero-pagination-ext .swiper-pagination-bullet-active {
            background: white;
        }
        .hero-title br {
            display: none;
        }
    }
</style>

<section class="hero-slider-section">
    <div class="swiper heroSwiper">
        <div class="swiper-wrapper">

            {{-- Slide 1 --}}
            <div class="swiper-slide hero-slide"
                style="background-image: url('{{ asset('assets/image/home/Elderly-Care.webp') }}')">
                <div class="hero-overlay"></div>
                <div class="hero-content r-container">
                    <div class="hero-text">
                        <span class="hero-badge">
                            <i class="fa-solid fa-heart-pulse"></i>
                            Professional Care
                        </span>
                        <h1 class="hero-title">
                            C & K <span>Home Nursing</span> <br>and Care Center
                        </h1>
                        <div class="hero-divider"></div>
                        <p class="hero-subtitle">
                            Compassionate and dedicated care for your loved ones — delivered with dignity in the warmth of home.
                        </p>
                        <div class="hero-actions">
                            <a href="{{ route('services') }}" class="btn-hero-primary">
                                <i class="fa-solid fa-stethoscope"></i> Our Services
                            </a>
                            <a href="{{ route('contact') }}" class="btn-hero-secondary">
                                <i class="fa-solid fa-phone"></i> Contact Us
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Slide 2 --}}
            <div class="swiper-slide hero-slide"
                style="background-image: url('{{ asset('assets/image/home/r64367346743.webp') }}')">
                <div class="hero-overlay"></div>
                <div class="hero-content r-container">
                    <div class="hero-text">
                        <span class="hero-badge">
                            <i class="fa-solid fa-clock"></i>
                            24 / 7 Support
                        </span>
                        <h1 class="hero-title">
                            Professional <span>Nursing</span> <br>Services, Around the Clock
                        </h1>
                        <div class="hero-divider"></div>
                        <p class="hero-subtitle">
                            Our trained nursing staff provides round-the-clock medical support, ensuring your loved one is always safe and cared for.
                        </p>
                        <div class="hero-actions">
                            <a href="{{ route('services') }}" class="btn-hero-primary">
                                <i class="fa-solid fa-stethoscope"></i> Our Services
                            </a>
                            <a href="{{ route('contact') }}" class="btn-hero-secondary">
                                <i class="fa-solid fa-phone"></i> Contact Us
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Slide 3 --}}
            <div class="swiper-slide hero-slide"
                style="background-image: url('{{ asset('assets/image/home/5643373476.webp') }}')">
                <div class="hero-overlay"></div>
                <div class="hero-content r-container">
                    <div class="hero-text">
                        <span class="hero-badge">
                            <i class="fa-solid fa-user-nurse"></i>
                            Personalised Care
                        </span>
                        <h1 class="hero-title">
                            Tailored Care Plans <br>for <span>Every Individual</span>
                        </h1>
                        <div class="hero-divider"></div>
                        <p class="hero-subtitle">
                            We design personalised care plans that respect each person's unique needs, preferences, and lifestyle.
                        </p>
                        <div class="hero-actions">
                            <a href="{{ route('services') }}" class="btn-hero-primary">
                                <i class="fa-solid fa-stethoscope"></i> Our Services
                            </a>
                            <a href="{{ route('contact') }}" class="btn-hero-secondary">
                                <i class="fa-solid fa-phone"></i> Contact Us
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Slide 4 --}}
            <div class="swiper-slide hero-slide"
                style="background-image: url('{{ asset('assets/image/home/56365356.webp') }}')">
                <div class="hero-overlay"></div>
                <div class="hero-content r-container">
                    <div class="hero-text">
                        <span class="hero-badge">
                            <i class="fa-solid fa-shield-heart"></i>
                            Trusted by Families
                        </span>
                        <h1 class="hero-title">
                            Experienced <span>Caregivers</span> <br>You Can Trust
                        </h1>
                        <div class="hero-divider"></div>
                        <p class="hero-subtitle">
                            Our experienced and empathetic caregivers are committed to enhancing the quality of life for every person in our care.
                        </p>
                        <div class="hero-actions">
                            <a href="{{ route('services') }}" class="btn-hero-primary">
                                <i class="fa-solid fa-stethoscope"></i> Our Services
                            </a>
                            <a href="{{ route('contact') }}" class="btn-hero-secondary">
                                <i class="fa-solid fa-phone"></i> Contact Us
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Navigation --}}
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>

    {{-- Wave shape at bottom --}}
    <div class="hero-wave">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 90" preserveAspectRatio="none">
            <path fill="#F4F4F4"
                d="M0,30 C240,90 480,0 720,45 C960,90 1200,10 1440,45 L1440,90 L0,90 Z" />
        </svg>
    </div>

    {{-- Pagination outside swiper so it renders above the wave --}}
    <div class="hero-pagination-ext"></div>

</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Swiper('.heroSwiper', {
            autoplay: {
                delay: 5500,
                disableOnInteraction: false,
            },
            speed: 1400,
            effect: 'fade',
            fadeEffect: { crossFade: true },
            loop: true,
            pagination: {
                el: '.hero-pagination-ext',
                clickable: true,
            },
            navigation: {
                nextEl: '.heroSwiper .swiper-button-next',
                prevEl: '.heroSwiper .swiper-button-prev',
            },
        });
    });
</script>
