<style>
    /* Breadcrumb Section Styles */
    .breadcrumb-area {
        position: relative;
        width: 100%;
        height: 450px;                    /* Increased height */
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        box-sizing: border-box;
    }

    /* Hero Image for LCP optimization */
    .hero-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 0;
    }

    /* Dark overlay for text readability */
    .breadcrumb-area::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.55);  /* Slightly darker for better contrast */
        z-index: 1;
    }

    /* Content container */
    .breadcrumb-content {
        position: relative;
        z-index: 2;
        color: white;
        max-width: 900px;
        padding: 0 20px;
    }

    /* Main headline */
    .breadcrumb-content h1 {
        font-size: 3.8rem;                /* Slightly larger */
        font-weight: 700;
        margin-bottom: 16px;
        color: white;
        line-height: 1.1;
        text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.5);
    }

    /* Subtext / mission statement */
    .breadcrumb-content .subtext {
        font-size: 1.2rem;
        font-weight: 400;
        line-height: 1.5;
        margin-bottom: 28px;
        opacity: 0.95;
    }

    /* Button styling (assuming .btn-main exists in your CSS) */
    .btn-main {
        padding: 14px 32px;
        font-size: 1.1rem;
        font-weight: 600;
    }

    /* Responsive adjustments */
    @media (max-width: 992px) {
        .breadcrumb-area {
            height: 400px;
        }
        .breadcrumb-content h1 {
            font-size: 3.2rem;
        }
        .breadcrumb-content .subtext {
            font-size: 1.25rem;
        }
    }

    @media (max-width: 768px) {
        .breadcrumb-area {
            height: 340px;
            background-attachment: scroll;
        }
        .breadcrumb-content h1 {
            font-size: 2.8rem;
        }
        .breadcrumb-content .subtext {
            font-size: 1.15rem;
        }
    }

    @media (max-width: 480px) {
        .breadcrumb-area {
            height: 280px;
        }
        .breadcrumb-content h1 {
            font-size: 2.2rem;
        }
        .breadcrumb-content .subtext {
            font-size: 1rem;
        }
        .btn-main {
            padding: 12px 24px;
            font-size: 1rem;
        }
    }
</style>

<br/>

<!-- Breadcrumb Section -->
<section class="breadcrumb-area mt-6">
    <img src="{{ asset('assets/images/breadcrumb/About Us.webp') }}" 
         alt="About Care365" 
         class="hero-image" 
         fetchpriority="high" loading="lazy">

    <!-- Content -->
    <div class="breadcrumb-content">
        <h1 class="wow fadeInUp mb-3" data-wow-delay=".2s">Caring for Seniors Like Family</h1>
        
        <p class="subtext wow fadeInUp" data-wow-delay=".4s">
            Care365 was founded to provide safe, dignified and compassionate elder care in Sri Lanka.
        </p>

        <a class="btn-main bg-color-2  mb-3 wow fadeInUp" 
           data-wow-delay=".6s" 
           href="{{ route('lead-form') }}">
            Talk to Our Team
        </a>
    </div>
</section>