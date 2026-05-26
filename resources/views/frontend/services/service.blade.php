<section class="relative overflow-hidden border-top">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-6 offset-lg-3 text-center">
                <div class="subtitle wow fadeInUp mb-3">Our Services</div>
                <h2 class="mb-4 wow fadeInUp" data-wow-delay=".2s">Safe And Secure Elderly Care</h2>
            </div>
        </div>
        <div class="row g-4">
            @forelse ($services as $service)
                <div class="col-lg-4 col-sm-6 d-flex">
                    <div class="relative mb-3 p-3 w-100 rounded-1 shadow-soft d-flex flex-column">
                        <a href="{{ url('/' . $service->title_slug) }}" 
                           class="d-block hover mb-3">
                            <div class="relative overflow-hidden rounded-1 shadow-soft">
                                <!-- "Read More" overlay -->
                                <div class="absolute z-2 start-0 w-100 abs-middle fs-36 text-white text-center">
                                    <span class="btn-main hover-op-1">Read More</span>
                                </div>

                                <!-- Dynamic service image with fixed aspect ratio -->
                                <div class="ratio ratio-16x9">
                                    <img src="{{ asset('services_img/' . pathinfo($service->image_path, PATHINFO_FILENAME) . '.webp') }}" 
                                         class="img-fluid hover-scale-1-2" 
                                         style="object-fit: cover; width: 100%; height: 100%;"
                                         width="640" height="360"
                                         alt="{{ $service->title }}" loading="lazy">
                                </div>
                            </div>
                        </a>

                        <h4 class="mb-2 service-title" style="
                            display: -webkit-box;
                            -webkit-line-clamp: 2;
                            -webkit-box-orient: vertical;
                            overflow: hidden;
                            text-overflow: ellipsis;
                            line-height: 1.4;">
                            {{ Str::limit($service->title, 35) }} <!-- Adjust character limit -->
                        </h4>
                        <p class="mb-0" 
                           style="display: -webkit-box; 
                                  -webkit-line-clamp: 3; 
                                  -webkit-box-orient: vertical; 
                                  overflow: hidden; 
                                  text-overflow: ellipsis; 
                                  line-height: 1.6; 
                                  white-space: normal;">
                            {{ $service->description }}
                        </p>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="lead">No services available at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>