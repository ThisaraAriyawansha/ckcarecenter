        <style>
            .hs-card {
                display: block;
                position: relative;
                border-radius: 16px;
                overflow: hidden;
                cursor: pointer;
                text-decoration: none;
            }

            .hs-card img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.45s ease;
                display: block;
            }

            .hs-card:hover img {
                transform: scale(1.07);
            }

            .hs-card .hs-overlay {
                position: absolute;
                inset: 0;
                background: linear-gradient(to top, rgba(0, 30, 40, 0.78) 0%, rgba(0, 30, 40, 0.15) 55%, transparent 100%);
                transition: background 0.35s ease;
            }

            .hs-card:hover .hs-overlay {
                background: linear-gradient(to top, rgba(0, 30, 40, 0.88) 0%, rgba(0, 30, 40, 0.45) 70%, rgba(0, 30, 40, 0.15) 100%);
            }

            .hs-card .hs-title {
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                padding: 20px 20px 18px;
                color: #fff;
                font-size: 1rem;
                font-weight: 600;
                z-index: 2;
                transition: transform 0.35s ease;
            }

            .hs-card:hover .hs-title {
                transform: translateY(-6px);
            }

            .hs-card .hs-readmore {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, calc(-50% + 10px));
                opacity: 0;
                transition: opacity 0.3s ease, transform 0.35s ease;
                z-index: 3;
                white-space: nowrap;
            }

            .hs-card:hover .hs-readmore {
                opacity: 1;
                transform: translate(-50%, -50%);
            }

            .hs-img-wrap {
                aspect-ratio: 4 / 3;
            }
        </style>

        <!-- Section Services -->
        <div class="section">
            <div class="r-container d-flex flex-column gap-4">

                <!-- Section Header -->
                <div class="d-flex flex-column gap-3 text-center mx-auto align-items-center scrollanimation animated zoomIn"
                    style="max-width: 620px;">
                    <div class="d-flex flex-row gap-2 align-items-center">
                        <img src="{{ asset('assets/image/cuida_medicine-outline.png') }}" class="img-fluid" alt="">
                        <h6 class="accent-color m-0">Our Services</h6>
                    </div>
                    <h3>Compassionate Care, Tailored for Every Need</h3>
                    <p>From personal nursing to specialised home care, we provide a full range of services designed to
                        support your loved ones with dignity and warmth.</p>
                </div>

                @if($services->count() > 0)
                    <div class="row row-cols-1 row-cols-md-3 g-3 ">
                        @foreach($services->take(6) as $service)
                            @php
                                $imgSrc = !$service->image_path || str_starts_with($service->image_path, 'assets/')
                                    ? asset($service->image_path ?? 'assets/image/services/service_card_1_2.jpg')
                                    : Storage::disk('services_public')->url($service->image_path);
                            @endphp
                            <div class="col">
                                <a href="{{ url('/' . $service->title_slug) }}" class="hs-card">
                                    <div class="hs-img-wrap">
                                        <img src="{{ $imgSrc }}"
                                             alt="{{ $service->title }}"
                                             loading="lazy"
                                             onerror="this.onerror=null;this.src='{{ asset('assets/image/services/service_card_1_2.jpg') }}'">
                                    </div>
                                    <div class="hs-overlay"></div>
                                    <div class="hs-title">{{ $service->title }}</div>
                                    <div class="hs-readmore">
                                        <span class="btn btn-accent rounded-pill px-4 py-2" style="font-size: 0.875rem;">Read More</span>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="rtmicon rtmicon-medical-checkup accent-color" style="font-size: 72px;"></i>
                        <p class="font-2 mt-3">Our services will be available shortly. Please check back soon.</p>
                    </div>
                @endif

                {{-- View All button --}}
                <div class="w-max-content mx-auto scrollanimation animated fadeInUp">
                    <a href="{{ route('services') }}"
                        class="btn rounded-pill d-flex flex-row gap-2 px-3 py-2"
                        style="background-color: transparent; color: #1C3F6E; border: 2px solid #1C3F6E; font-size: 0.85rem;">
                        <span>View All Services</span>
                    </a>
                </div>

            </div>
        </div>
