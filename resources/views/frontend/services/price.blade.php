<!--
<section class="bg-smoke2 overflow-hidden space" id="Packages">
    <div class="container">
        <div class="title-area text-center mb-5">
            <span class="sub-title style2 text-anim" data-cue="slideInUp">Pricing Plan</span>
            <h2 class="sec-title text-anim" data-cue="slideInUp">Our Packages</h2>
            <p class="fs-18 text-anim2" data-cue="slideInUp">Comprehensive care packages designed to meet the unique needs of our residents.</p>
        </div>
        
        @if($packages->isEmpty())
            <div class="text-center py-5">
                <div class="alert alert-info d-inline-block">
                    <i class="fa-solid fa-info-circle me-2"></i>
                    No packages available at the moment. Please check back soon.
                </div>
            </div>
        @else
            <div class="row justify-content-center g-4">
                @foreach($packages as $index => $package)
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="pricing-card-grid shadow-sm" data-cue="slideInUp" data-cue-delay="{{ $index * 200 }}" style="border-radius: 12px; overflow: hidden; ">
                            <div class="pricing-1-bg_mask"></div>
                            
                            <div class="pricing-header text-center p-4 border-bottom">
                                <h3 class="box-title mb-3" style="font-size: 24px; font-weight: 600; color: #2c3e50;">
                                    {{ $package->title }}
                                </h3>
                                
                                <div class="pricing-amount mb-2">
                                    <h2 class="price mb-0" style="font-size: 42px; font-weight: 700; color: #2c3e50; line-height: 1;">
                                        {{ $package->formatted_price_lkr }}
                                    </h2>
                                    <p class="text-muted mb-0" style="font-size: 14px;">
                                        ({{ $package->formatted_price_usd }})
                                    </p>
                                </div>
                                <span class="bg-transparent" style="color: #555; font-size: 13px; line-height: 1.6;">
                                    Upwards Monthly
                                </span>
                            </div>
                            
                            <div class="pricing-body p-4">
                                @if($package->features->isNotEmpty())
                                    <ul class="features-list mb-0" style="list-style: none; padding: 0;">
                                        @foreach($package->features as $feature)
                                            <li class="feature-item d-flex align-items-start mb-3">
                                                <i class="fa-solid fa-circle-check flex-shrink-0 me-3 mt-1" style="color: #4CAF50; font-size: 18px;"></i>
                                                <span style="color: #555; font-size: 15px; line-height: 1.6;">
                                                    {{ $feature->feature }}
                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <div class="text-center py-4">
                                        <i class="fa-solid fa-box-open text-muted mb-3" style="font-size: 40px; opacity: 0.3;"></i>
                                        <p class="text-muted mb-0" style="font-size: 14px;">
                                            Features will be added soon
                                        </p>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="pricing-footer pb-5 pt-3">
                                <div class="d-flex justify-content-end">  
                                    <a href="{{ route('contact') }}" class="enquire-link d-inline-flex align-items-center gap-2 fw-medium text-decoration-none"
                                    style="color: #2c3e50; font-size: 16px;">
                                        Enquire Now
                                        <i class="fa-solid fa-arrow-right ms-2" style="font-size: 14px;"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<style>
    /* Reduce text size on mobile */
@media (max-width: 767.98px) {
    .pricing-card-grid .box-title {
        font-size: 21px !important;      /* was 24px */
    }
    
    .pricing-card-grid .price {
        font-size: 36px !important;      /* was 42px */
    }
    
    .pricing-card-grid .feature-item span {
        font-size: 14px !important;      /* was 15px */
    }
    
    .pricing-card-grid .pricing-amount p {
        font-size: 13px !important;
    }
    
    /* Optional: slightly less padding on mobile if cards feel too tall */
    .pricing-body {
        padding: 1.5rem !important;     /* reduced from p-4 (2rem) */
    }
}

.enquire-link {
    transition: all 0.3s ease;
}

.enquire-link:hover {
    color: #4CAF50 !important;
}

.enquire-link:hover i {
    transform: translateX(6px);
}
</style>
-->



<section class="price-sec-2 overflow-hidden space" data-bg-src="assets/img/bg/pricing-2-bg.png" id="Packages">
    <div class="container th-container2">
        <div class="title-area text-center mb-5">
            <span class="sub-title style2 text-anim" data-cue="slideInUp">Pricing Plan</span>
            <h2 class="sec-title text-anim" data-cue="slideInUp">Our Packages</h2>
            <p class="fs-18 text-anim2" data-cue="slideInUp">Comprehensive care packages designed to meet the unique needs of our residents.</p>
        </div>
        
        <!-- Single Package Section -->
        <div class="wrapper-pack">
            <div class="row gy-4 justify-content-center">
                @forelse($packages as $index => $package)
                    @php
                        // Determine if this is the "Best Value" package
                        $isBestValue = $package->is_best_value ?? ($index == 1);
                    @endphp
                    
                    <div class="col-xl-4 col-md-6" data-cue="slideInUp">
                        <div class="price-card {{ $isBestValue ? 'active-plan' : '' }} h-100 d-flex flex-column">
                            @if($isBestValue)
                                <p class="premium">Best Value For You</p>
                            @else
                                <p class="premium">&nbsp;</p>
                            @endif
                            
                            <div class="price-card-inner flex-grow-1 d-flex flex-column">
                                <h3 class="box-title">{{ $package->title }}</h3>
                                <p class="box-text">
                                    {{ $package->room_type }} room • 
                                    {{ $package->sharing_capacity }} {{ $package->sharing_capacity > 1 ? 'sharing' : 'single' }} • 
                                    @switch($package->bathroom_type)
                                        @case('ensuite')
                                            En-suite Bathroom
                                            @break
                                        @case('shared')
                                            Shared Bathroom
                                            @break
                                        @case('mixed')
                                            Mixed Bathroom Types
                                            @break
                                        @default
                                            {{ $package->bathroom_type }}
                                    @endswitch
                                </p>
                                
                                <div class="price_card-wrap">
                                    <a href="{{ route('contact') }}" class="th-btn">Enquire Now</a>
                                    <h4 class="price-card_price">
                                        <span class="currency-sing">Rs.</span>
                                        {{ number_format($package->price_lkr, 0) }}
                                        <span class="duration"></span>
                                        @if($package->price_usd)
                                            <br>
                                            <small class="d-block text-muted mt-1" style="font-size: 14px;">
                                                (${{ number_format($package->price_usd, 0) }})
                                            </small>
                                        @endif
                                        <span class="bg-transparent" style="color: #555; font-size: 13px; line-height: 1.6;">
                                            Upwards Monthly
                                        </span>
                                    </h4>
                                </div>

                                <div class="checklist flex-grow-1">
                                    <ul class="features-list-scroll">
                                        @forelse($package->features as $feature)
                                            <li class="{{ !$feature->is_active ? 'unavailable' : '' }}">
                                                <i class="fa-solid fa-check"></i> {{ $feature->feature }}
                                            </li>
                                        @empty
                                            <li class="text-muted">No features listed yet</li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <div class="alert alert-info">
                            <p>No packages available at the moment. Please check back later.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>

<style>


/* Features list with scroll */
.features-list-scroll {
    max-height: 50vh;
    overflow-y: auto;
    padding-right: 0.6rem;
}



/* Custom scrollbar styling */
.features-list-scroll::-webkit-scrollbar {
    width: 6px;
}

.features-list-scroll::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.features-list-scroll::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 10px;
}

.features-list-scroll::-webkit-scrollbar-thumb:hover {
    background: #555;
}
</style>
