<section class="relative overflow-hidden border-top">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-6 offset-lg-3 text-center">
                <div class="subtitle wow fadeInUp mb-3">Our Services</div>
                <h2 class="wow fadeInUp" data-wow-delay=".2s" 
                    style="font-size: clamp(1.8rem, 5.5vw, 2.8rem); 
                           line-height: 1.2; 
                           margin-bottom: 1rem;">
                    Safe And Secure Elderly Care
                </h2>
                <p class="lead mb-0 wow fadeInUp">
                    Discover our comprehensive services, providing personalized 
                    support and engaging activities to enhance the well-being and quality of life for seniors.
                </p>
                <div class="spacer-single"></div>
                <div class="spacer-half"></div>
            </div>
        </div>
        
        @if(count($services) > 0)
            <div class="row g-4">
                @foreach($services as $service)
                <div class="col-lg-4 col-sm-6">
                    <div class="relative h-100">
                        <a href="{{ service_url($service) }}" class="d-block hover h-100">
                            <div class="relative overflow-hidden rounded-1 shadow-soft d-flex flex-column h-100">
                                <!-- Decorative flower (optional) -->

                                
                                <!-- Read More overlay – centered vertically -->
                                <div class="absolute z-2 start-0 w-100 abs-middle fs-36 text-white text-center">
                                    <span class="btn-main hover-op-1">Read More</span>
                                </div>
                                
                                <!-- Image with fixed aspect ratio -->
                                <div class="ratio ratio-4x3 overflow-hidden">
                                    <img src="{{ image_url($service->image_path, 'service') }}"
                                         class="img-fluid object-fit-cover hover-scale-1-2"
                                         alt="{{ $service->title }}" loading="lazy">
                                </div>
                                
                                <!-- Title overlay at bottom -->
                                <div class="hover-op-0 abs p-3 px-4 bottom-0 start-0 end-0 text-center text-light overlay-black-1 bg-blur mt-auto">
                                    <h4 class="mb-0">{{ $service->title }}</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- Button to View All Services-->
            <div class="row mt-5">
                <div class="col-12 text-center">
                    <a href="{{ route('services') }}"
                    style="display: inline-block;
                            padding: 0.5rem 1.5rem;
                            font-size: 0.92rem;
                            font-weight: 500;
                            line-height: 1.4;
                            color: #2563eb;
                            background-color: #ffffff;
                            border: 2px solid #2563eb;
                            border-radius: 50px;
                            text-decoration: none;
                            transition: all 0.3s ease;
                            box-shadow: 0 2px 6px rgba(37, 99, 235, 0.1);"
                    onmouseover="this.style.backgroundColor='#2563eb'; this.style.color='#ffffff'; this.style.boxShadow='0 4px 12px rgba(37, 99, 235, 0.25)';"
                    onmouseout="this.style.backgroundColor='#ffffff'; this.style.color='#2563eb'; this.style.boxShadow='0 2px 6px rgba(37, 99, 235, 0.1)';">
                        View All Services
                    </a>
                </div>
            </div>
        @else
            <!-- No Services Message -->
            <div class="row">
                <div class="col-12">
                    <div class="text-center py-5 my-5">
                        <div class="mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-heart-pulse text-muted" viewBox="0 0 16 16">
                                <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053.918 3.995.78 5.323 1.508 7H.43c-2.128-5.697 4.165-8.83 7.394-5.857.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17c3.23-2.974 9.522.159 7.394 5.856h-1.078c.728-1.677.59-3.005.108-3.947C13.486.878 10.4.28 8.717 2.01L8 2.748ZM2.212 10h1.315C4.593 11.183 6.05 12.458 8 13.795c1.949-1.337 3.407-2.612 4.473-3.795h1.315c-1.265 1.566-3.14 3.25-5.788 5-2.648-1.75-4.523-3.434-5.788-5Z"/>
                                <path d="M10.464 3.314a.5.5 0 0 0-.945.049L7.921 8.956 6.464 5.314a.5.5 0 0 0-.88-.091L3.732 8H.5a.5.5 0 0 0 0 1H4a.5.5 0 0 0 .416-.223l1.473-2.209 1.647 4.118a.5.5 0 0 0 .945-.049l1.598-5.593 1.457 3.642A.5.5 0 0 0 12 9h3.5a.5.5 0 0 0 0-1h-3.162l-1.874-4.686Z"/>
                            </svg>
                        </div>
                        <h3 class="h4 mb-3">Services Coming Soon</h3>
                        <p class="text-muted mb-4 max-w-lg mx-auto">
                            We're currently updating our service offerings to provide you with the best elderly care solutions.
                            Please check back soon or contact us directly to learn about our available care options.
                        </p>
                        <a href="{{ route('contact') }}" class="btn btn-primary">
                            <i class="bi bi-telephone me-2"></i>Contact Us for More Info
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

<style>
.service-card-wrapper,
.relative.h-100,
.hover.h-100,
.shadow-soft.d-flex {
    height: 100%;
}

.ratio.ratio-4x3 img {
    object-fit: cover;
    width: 100%;
    height: 100%;
}

/* Optional: make sure title doesn't wrap too much */
.overlay-black-1 h4 {
    font-size: 1.25rem;
    line-height: 1.4;
    min-height: 2.8em;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Style for no services message */
.max-w-lg {
    max-width: 500px;
}
</style>