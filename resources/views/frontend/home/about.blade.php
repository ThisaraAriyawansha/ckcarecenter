<section class="pt-0">
    <div class="container relative">
        <div class="row g-4 gx-5 align-items-center">
            <div class="col-lg-6 relative">
                <div class="relative z-1000">
                    <div class="subtitle wow fadeInUp" data-wow-delay=".0s">About Care 365</div>
                    <h2>Compassionate Care for Golden Years</h2>
                    <p>At Care 365, we provide compassionate and personalized care for seniors in a warm, 
                        homelike environment. Our dedicated team is committed to enhancing the quality of 
                        life for our residents, ensuring their comfort, safety, and well-being. We treat every 
                        resident like family, providing the support and care they need to live life
                        to the fullest.</p>
                    <a class="btn-main bg-color-2  mb-3 wow fadeInUp" 
                    data-wow-delay=".6s" 
                    href="{{ route('services') }}">
                        See Our Care Services 
                    </a>                            
                </div>
            </div>

            <div class="col-lg-6">
                <img src="{{ asset('assets/images/about/Landing.webp') }}" 
                    class="img-fluid rounded-10 wow scaleIn object-fit-cover"
                    style="width: 100%; max-height: 700px;" 
                    width="600" height="400" 
                    alt="Care 365 Senior Care Facility" loading="lazy">
            </div>
        </div>
    </div>
</section>

<section class="pt-0">
    <div class="container">
        <div class="row g-3">
            <div class="col-lg-4 col-md-6">
                <div class="service-card">
                    <img src="assets/images/icons/white/5456456.png" 
                        class="service-icon bg-color-2 w-60px p-10 rounded-10 wow scaleIn" 
                        alt="Medical care icon" loading="lazy">
                    <div class="service-content wow fadeInUp">
                        <h5 class="service-title">Medical & Nursing Care</h5>
                        <p class="service-text">Professional healthcare services and nursing support.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="service-card">
                    <img src="assets/images/icons/white/45764.png" 
                        class="service-icon bg-color-2 w-60px p-10 rounded-10 wow scaleIn" 
                        alt="Medication icon" loading="lazy">
                    <div class="service-content wow fadeInUp">
                        <h5 class="service-title">Medication Management</h5>
                        <p class="service-text">Proper administration and tracking of medications.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="service-card">
                    <img src="assets/images/icons/white/564646367.png" 
                        class="service-icon bg-color-2 w-60px p-10 rounded-10 wow scaleIn" 
                        alt="Personal assistance icon" loading="lazy">
                    <div class="service-content wow fadeInUp">
                        <h5 class="service-title">Personal Assistance</h5>
                        <p class="service-text">Help with daily activities and personal care.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mt-3">
                <div class="service-card">
                    <img src="assets/images/icons/white/5634743.png" 
                        class="service-icon bg-color-2 w-60px p-10 rounded-10 wow scaleIn" 
                        alt="Nutrition icon" loading="lazy">
                    <div class="service-content wow fadeInUp">
                        <h5 class="service-title">Nutritious Meals</h5>
                        <p class="service-text">Healthy, balanced meals tailored to dietary needs.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mt-3">
                <div class="service-card">
                    <img src="assets/images/icons/white/65456467.png" 
                        class="service-icon bg-color-2 w-60px p-10 rounded-10 wow scaleIn" 
                        alt="Activities icon" loading="lazy">
                    <div class="service-content wow fadeInUp">
                        <h5 class="service-title">Recreational Activities</h5>
                        <p class="service-text">Engaging social and leisure activities.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mt-3">
                <div class="service-card">
                    <img src="assets/images/icons/white/56435634.png" 
                        class="service-icon bg-color-2 w-60px p-10 rounded-10 wow scaleIn" 
                        alt="Support icon" loading="lazy">
                    <div class="service-content wow fadeInUp">
                        <h5 class="service-title">24/7 Support</h5>
                        <p class="service-text">Round-the-clock care and assistance.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- CTA Section -->
    <div style="text-align: center; background: #ffffff; padding: 5px 3px; margin-top: 50px;">
        <h3 style="font-size: 26px; font-weight: 600; color: #0F172A; margin: 0 0 12px 0;">
            Explore Our Care Services
        </h3>
        <p style="font-size: 15px; color: #475569; margin: 0 0 25px 0; margin-left: auto; margin-right: auto; line-height: 1.6;">
            Discover personalized care solutions designed to support comfort, dignity, and well-being at every stage.
        </p>
        <a class="btn-main bg-color-2  mb-3 wow fadeInUp"
        data-wow-delay=".6s"
        href="{{ route('services') }}">
            Learn More About Our Services
        </a>
    </div>
</section>

<style>
/* Service Card Container */
.service-card {
    position: relative;
    display: flex;
    align-items: flex-start;
    gap: 15px;
    width: 100%;
    max-width: 100%;
}

/* Service Icon */
.service-icon {
    flex-shrink: 0;
    object-fit: contain;
    aspect-ratio: 1 / 1;
}

/* Service Content Wrapper */
.service-content {
    flex: 1;
    min-width: 0;
    width: 100%;
    max-width: calc(100% - 75px);
}

/* Service Title */
.service-title {
    font-size: 16px;
    margin-bottom: 4px;
    word-wrap: break-word;
    overflow-wrap: break-word;
    hyphens: auto;
    color: #0F172A; /* Ensure dark color for headings */
}

/* Service Text - UPDATED FOR ACCESSIBILITY */
.service-text {
    font-size: 13px;
    margin-bottom: 0;
    word-wrap: break-word;
    overflow-wrap: break-word;
    hyphens: auto;
    line-height: 1.5;
    color: #475569; /* Changed from #64748B - Now passes WCAG AA (5.8:1 contrast) */
}

/* Subtitle - UPDATED FOR ACCESSIBILITY */
.subtitle {
    color: #1E293B; /* Darker color for better contrast (11.4:1 contrast ratio) */
}

/* Main paragraph text */
p {
    color: #334155; /* Ensure good contrast for all paragraphs */
}

/* Mobile Responsive - Below 768px */
@media (max-width: 767px) {
    .service-card {
        gap: 10px;
    }
    
    .service-icon {
        width: 50px !important;
        height: 50px !important;
        padding: 8px !important;
    }
    
    .service-content {
        max-width: calc(100% - 60px);
    }
    
    .service-title {
        font-size: 14px !important;
    }
    
    .service-text {
        font-size: 12px !important;
        line-height: 1.4;
    }
}

/* Extra Small Mobile - Below 576px */
@media (max-width: 575px) {
    .container {
        padding-left: 15px;
        padding-right: 15px;
    }
    
    .service-card {
        gap: 8px;
    }
    
    .service-icon {
        width: 45px !important;
        height: 45px !important;
    }
    
    .service-content {
        max-width: calc(100% - 55px);
    }
    
    .service-title {
        font-size: 13px !important;
        line-height: 1.3;
    }
    
    .service-text {
        font-size: 11px !important;
    }
}
</style>