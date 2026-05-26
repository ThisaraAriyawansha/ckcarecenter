        <style>
            .service-card {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                cursor: default;
            }

            .service-card:hover {
                transform: translateY(-6px);
                box-shadow: 0 16px 40px rgba(230, 0, 126, 0.12), 0 4px 16px rgba(0, 0, 0, 0.08);
            }

            .service-img-wrap {
                height: 180px;
                overflow: hidden;
                border-radius: 12px;
            }

            .service-img-wrap img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.4s ease;
            }

            .service-card:hover .service-img-wrap img {
                transform: scale(1.06);
            }

            .service-icon-wrap {
                height: 180px;
                border-radius: 12px;
                background: var(--bg-accent-3, rgba(230, 0, 126, 0.06));
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .service-featured-panel {
                min-height: 480px;
            }

            @media (max-width: 1199px) {
                .service-featured-panel {
                    min-height: 300px;
                }
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
                    <div class="row row-cols-xl-2 row-cols-1">

                        {{-- Left: Featured Panel with first service image or static care image --}}
                        <div class="col col-xl-5 mb-3 scrollanimation animated fadeInLeft">
                            @php $featured = $services->first(); @endphp
                            <div class="position-relative bg-attach-cover service-featured-panel rounded-4 overflow-hidden h-100"
                                style="background-image: url('{{ $featured->image_path ? Storage::url($featured->image_path) : asset('assets/image/home/56365356.webp') }}');">
                                <div class="bg-overlay" style="background: linear-gradient(to top, rgba(0,45,55,0.92) 0%, rgba(0,45,55,0.4) 60%, transparent 100%);"></div>
                                <div class="position-absolute bottom-0 start-0 p-4 p-xl-5 text-white" style="z-index: 2;">
                                    <div class="d-flex flex-column gap-3">
                                        <div class="px-3 py-1 rounded-pill w-max-content"
                                            style="background: rgba(230,0,126,0.85); font-size: 0.8rem; font-weight: 600; letter-spacing: 0.5px;">
                                            Featured Service
                                        </div>
                                        <h4 class="text-white m-0">{{ $featured->title }}</h4>
                                        @if($featured->description)
                                            <p class="text-white m-0" style="opacity: 0.85; font-size: 0.95rem;">
                                                {{ Str::limit($featured->description, 130) }}
                                            </p>
                                        @endif
                                        <div class="d-flex flex-column gap-2 mt-2">
                                            <div class="d-flex flex-row align-items-center gap-3">
                                                <i class="rtmicon rtmicon-location" style="font-size: 36px;"></i>
                                                <div class="d-flex flex-column">
                                                    <span class="fw-semibold" style="font-size: 0.85rem;">Location</span>
                                                    <span style="font-size: 0.82rem; opacity: 0.85;">Colombo, Sri Lanka</span>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-row align-items-center gap-3">
                                                <i class="rtmicon rtmicon-classic-phone" style="font-size: 36px;"></i>
                                                <div class="d-flex flex-column">
                                                    <span class="fw-semibold" style="font-size: 0.85rem;">Phone</span>
                                                    <span style="font-size: 0.82rem; opacity: 0.85;">+94 76 185 2339</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Right: Scrollable service cards list --}}
                        <div class="col col-xl-7 mb-3 scrollanimation animated fadeInRight">
                            <div class="service-scroll d-flex flex-column gap-3">

                                {{-- First row: two side-by-side cards (services 2 & 3) --}}
                                @if($services->count() >= 2)
                                    <div class="row row-cols-2 g-3">
                                        @foreach($services->skip(1)->take(2) as $service)
                                            <div class="col">
                                                <div class="service-card d-flex flex-column gap-3 p-4 bg-accent rounded-4 h-100">
                                                    @if($service->image_path)
                                                        <div class="service-img-wrap">
                                                            <img src="{{ Storage::url($service->image_path) }}"
                                                                alt="{{ $service->title }}">
                                                        </div>
                                                    @else
                                                        <div class="service-icon-wrap">
                                                            <i class="rtmicon rtmicon-medical-checkup accent-color"
                                                                style="font-size: 64px;"></i>
                                                        </div>
                                                    @endif
                                                    <div class="d-flex flex-column gap-2 flex-grow-1">
                                                        <h5 class="m-0">{{ $service->title }}</h5>
                                                        @if($service->description)
                                                            <p class="font-2 flex-grow-1 m-0">
                                                                {{ Str::limit($service->description, 80) }}
                                                            </p>
                                                        @endif
                                                        <a href="{{ route('services') }}"
                                                            class="font-1 fs-6 fw-semibold read-more mt-auto">
                                                            Learn More <i class="fa-solid fa-chevron-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                {{-- Remaining cards (4, 5, 6) as full-width rows --}}
                                @foreach($services->skip(3) as $service)
                                    <div class="service-card d-flex flex-row gap-4 p-4 bg-accent rounded-4 align-items-start">
                                        @if($service->image_path)
                                            <div class="flex-shrink-0"
                                                style="width: 80px; height: 80px; border-radius: 12px; overflow: hidden;">
                                                <img src="{{ Storage::url($service->image_path) }}"
                                                    alt="{{ $service->title }}"
                                                    style="width: 100%; height: 100%; object-fit: cover;">
                                            </div>
                                        @else
                                            <div class="icon-box flex-shrink-0">
                                                <i class="rtmicon rtmicon-pharmacy fs-1"></i>
                                            </div>
                                        @endif
                                        <div class="d-flex flex-column gap-2 flex-grow-1">
                                            <h5 class="m-0">{{ $service->title }}</h5>
                                            @if($service->description)
                                                <p class="font-2 m-0">{{ Str::limit($service->description, 120) }}</p>
                                            @endif
                                            <a href="{{ route('services') }}"
                                                class="font-1 fs-6 fw-semibold read-more">
                                                Learn More <i class="fa-solid fa-chevron-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>

                    </div>
                @else
                    {{-- Empty state --}}
                    <div class="text-center py-5">
                        <i class="rtmicon rtmicon-medical-checkup accent-color" style="font-size: 72px;"></i>
                        <p class="font-2 mt-3">Our services will be available shortly. Please check back soon.</p>
                    </div>
                @endif

                {{-- View All button --}}
                <div class="w-max-content mx-auto scrollanimation animated fadeInUp">
                    <a href="{{ route('services') }}"
                        class="btn btn-accent rounded-pill d-flex flex-row gap-2 px-5 py-3">
                        <span>View All Services</span>
                    </a>
                </div>

            </div>
        </div>
