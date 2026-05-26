<section class="bg-white overflow-hidden py-5" id="Packages">
    <div class="container">
        <!-- Title Area -->
        <div class="title-area text-center mb-5 pb-3">
            <div class="subtitle text-uppercase mb-2" style="color: #3498db; font-size: 13px; letter-spacing: 2px; font-weight: 600;">
                Pricing Plan
            </div>
            <h2 class="mb-3" style="font-size: 36px; font-weight: 700; color: #2c3e50;">Our Packages</h2>
            <p class="lead mb-0 text-muted mx-auto" style="max-width: 600px; font-size: 16px; line-height: 1.6;">
                Comprehensive care packages designed to meet the unique needs of our residents.
            </p>
        </div>
        
        @if($packages->isEmpty())
            <div class="text-center py-5">
                <div class="alert alert-light border d-inline-block px-4 py-3">
                    <i class="fa-solid fa-info-circle me-2" style="color: #3498db;"></i>
                    No packages available at the moment. Please check back soon.
                </div>
            </div>
        @else
            <div class="row justify-content-center g-4">
                @foreach($packages as $index => $package)
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="pricing-card bg-white position-relative d-flex flex-column" 
                             style="border-radius: 16px; 
                                    overflow: hidden; 
                                    border: 1px solid #e8ecef;
                                    transition: all 0.3s ease;
                                    height: 100%;
                                    min-height: 550px;">
                            
                            <!-- Accent Border Top -->
                            <div class="accent-border" style="height: 4px; background: #3498db;"></div>
                            
                            <!-- Pricing Header -->
                            <div class="pricing-header text-center px-4 pt-5 pb-4">
                                <h3 class="package-title mb-4" style="font-size: 22px; font-weight: 600; color: #2c3e50;">
                                    {{ $package->title }}
                                </h3>
                                
                                <div class="pricing-amount mb-2">
                                    <h2 class="price mb-1" style="font-size: 44px; font-weight: 700; color: #2c3e50; line-height: 1;">
                                        {{ $package->formatted_price_lkr }}
                                    </h2>
                                    <p class="text-muted mb-2" style="font-size: 13px; font-weight: 500;">
                                        ({{ $package->formatted_price_usd }})
                                    </p>
                                </div>
                                <span class="d-inline-block px-3 py-1" 
                                      style="background-color: #f8f9fa; 
                                             color: #6c757d; 
                                             font-size: 12px; 
                                             border-radius: 20px;
                                             font-weight: 500;">
                                    Upwards Monthly
                                </span>
                            </div>
                            
                            <!-- Divider -->
                            <div class="mx-4" style="height: 1px; background-color: #e8ecef;"></div>
                            
                            <!-- Pricing Body -->
                            <div class="pricing-body px-4 py-4 flex-grow-1" 
                                 style="max-height: 280px; 
                                        overflow-y: auto;
                                        overflow-x: hidden;">
                                @if($package->features->isNotEmpty())
                                    <ul class="features-list mb-0" style="list-style: none; padding: 0;">
                                        @foreach($package->features as $feature)
                                            <li class="feature-item d-flex align-items-start mb-3">
                                                <i class="fa-solid fa-check flex-shrink-0 me-3 mt-1" 
                                                   style="color: #3498db; font-size: 16px;"></i>
                                                <span class="feature-text" style="color: #5a6c7d; 
                                                             font-size: 14px; 
                                                             line-height: 1.6;">
                                                    {{ $feature->feature }}
                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <div class="text-center py-5">
                                        <i class="fa-solid fa-box-open mb-3" style="font-size: 32px; color: #dee2e6;"></i>
                                        <p class="text-muted mb-0" style="font-size: 13px;">
                                            Features will be added soon
                                        </p>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Pricing Footer -->
                            <div class="pricing-footer px-4 pb-4 pt-2">
                                <a href="{{ route('lead-form') }}" 
                                   class="enquire-btn d-block text-center py-2 text-decoration-none"
                                   style="background-color: white;
                                          color: #3498db;
                                          border: 2px solid #3498db;
                                          border-radius: 8px;
                                          font-size: 13px;
                                          font-weight: 600;
                                          letter-spacing: 0.5px;
                                          transition: all 0.3s ease;">
                                    Enquire Now
                                    <i class="fa-solid fa-arrow-right ms-2" style="font-size: 11px;"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<style>
/* Card Hover Effect */
.pricing-card {
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
}

.pricing-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 32px rgba(52, 152, 219, 0.15);
    border-color: #3498db !important;
}

/* Custom Scrollbar for Pricing Body */
.pricing-body::-webkit-scrollbar {
    width: 6px;
}

.pricing-body::-webkit-scrollbar-track {
    background: #f1f3f5;
    border-radius: 10px;
}

.pricing-body::-webkit-scrollbar-thumb {
    background: #3498db;
    border-radius: 10px;
}

.pricing-body::-webkit-scrollbar-thumb:hover {
    background: #2980b9;
}

/* Firefox Scrollbar */
.pricing-body {
    scrollbar-width: thin;
    scrollbar-color: #3498db #f1f3f5;
}

/* Button Hover Effect */
.enquire-btn:hover {
    background-color: #3498db !important;
    color: white !important;
    transform: scale(1.02);
}

.enquire-btn:hover i {
    transform: translateX(4px);
}

/* Check Icon Animation */
.feature-item i {
    transition: transform 0.3s ease;
}

.pricing-card:hover .feature-item i {
    transform: scale(1.1);
}

/* FIXED: Feature Text Wrapping - Improved Solution */
.feature-item {
    width: 100%;
    display: flex;
    align-items: flex-start;
}

.feature-text {
    /* Force text wrapping */
    word-wrap: break-word;
    word-break: break-word;
    overflow-wrap: break-word;
    hyphens: auto;
    max-width: 100%;
    width: 100%;
    display: block;
    
    /* Prevent long words from breaking layout */
    overflow: hidden;
    text-overflow: ellipsis;
    
    /* Ensure proper line breaking */
    white-space: normal;
    line-break: anywhere;
}

/* For extremely long unbroken text */
.feature-text {
    word-break: break-all; /* Break any word if needed */
    overflow-wrap: anywhere; /* Modern property for better breaking */
}

/* Responsive Typography */
@media (max-width: 991.98px) {
    .title-area h2 {
        font-size: 32px !important;
    }
    
    .title-area .lead {
        font-size: 15px !important;
    }
}

@media (max-width: 767.98px) {
    .title-area h2 {
        font-size: 28px !important;
    }
    
    .package-title {
        font-size: 20px !important;
    }
    
    .price {
        font-size: 38px !important;
    }
    
    .pricing-amount p {
        font-size: 12px !important;
    }
    
    .feature-text {
        font-size: 13px !important;
        line-height: 1.5 !important;
    }
    
    .pricing-body {
        padding: 1.5rem 1.25rem !important;
        max-height: 250px !important;
    }
    
    .pricing-header {
        padding: 2rem 1.25rem 1.5rem !important;
    }
    
    .pricing-card {
        min-height: 500px !important;
    }
}

@media (max-width: 575.98px) {
    .container {
        padding-left: 1rem;
        padding-right: 1rem;
    }
    
    .feature-item {
        margin-bottom: 0.75rem !important;
    }
    
    .feature-text {
        font-size: 12px !important;
    }
}

/* For very small screens */
@media (max-width: 375px) {
    .feature-text {
        font-size: 11px !important;
        line-height: 1.4 !important;
    }
    
    .feature-item i {
        font-size: 14px !important;
        margin-right: 0.5rem !important;
    }
}

/* Smooth Transitions 
* {
    transition: all 0.3s ease;
}*/

/* Focus States for Accessibility */
.enquire-btn:focus {
    outline-offset: 2px;
}

/* Ensure feature list items don't overflow */
.features-list {
    width: 100%;
    padding-right: 4px; /* Space for scrollbar */
}

/* Additional fix for long feature names */
.pricing-card .feature-item {
    min-height: 24px; /* Ensure consistent height */
    align-items: flex-start;
}
</style>