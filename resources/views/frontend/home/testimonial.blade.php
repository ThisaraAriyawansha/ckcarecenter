        <!-- Section Testimonials -->
        <div class="section mt-5 position-relative overflow-visible">
            <div class="px-xl-5 rounded-3" style="background-image: url({{ asset('assets/image/BG_testi.png') }});">
                <div class="row row-cols-xl-2 row-cols-1">
                    <div class="col mb-3 scrollanimation animated fadeInLeft">
                        <div class="d-flex flex-column gap-3 p-5 bg-accent-primary rounded-3 shadow floating-testi">
                            <div class="d-flex flex-column gap-3">
                                <div class="d-flex flex-row gap-2 align-items-center">
                                    <h6 class="accent-color m-0">Testimonials</h6>
                                </div>
                                <h3>Let's Hear What They Say About Us</h3>
                            </div>
                            <div class="overflow-hidden">
                                <div class="swiper swiperTestimonials">
                                    <div class="swiper-wrapper">
                                        @forelse($testimonials as $testimonial)
                                        <div class="swiper-slide">
                                            <div class="testimonial-container">
                                                <div class="d-flex flex-column gap-3">
                                                    <div class="flex-row">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            @if($i <= $testimonial->rating)
                                                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                            @else
                                                                <i class="fa-solid fa-star" style="color: var(--text-color-1);"></i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                    <span class="font-2 fst-italic">"{{ $testimonial->message }}"</span>
                                                </div>
                                                <div class="d-flex flex-xl-row flex-column gap-2 justify-content-between">
                                                    <div class="d-flex flex-row gap-3 align-items-center">
                                                        <div class="customer-item">
                                                            @php
                                                                $imgSrc = ($testimonial->image_path && \Illuminate\Support\Facades\Storage::disk('testimonial_public')->exists($testimonial->image_path))
                                                                    ? \Illuminate\Support\Facades\Storage::disk('testimonial_public')->url($testimonial->image_path)
                                                                    : asset('assets/image/testimonials/test_img.png');
                                                            @endphp
                                                            <img src="{{ $imgSrc }}"
                                                                class="img-fluid border-light" alt="{{ $testimonial->name }}">
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <h4 class="text-color fw-semibold">{{ $testimonial->name }}</h4>
                                                            <span class="font-2 text-color">{{ $testimonial->position }}</span>
                                                        </div>
                                                    </div>
                                                    <i class="rtmicon rtmicon-blockquote text-color" style="font-size: 82px;"></i>
                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                        <div class="swiper-slide">
                                            <div class="testimonial-container">
                                                <p class="font-2 fst-italic">No testimonials available yet.</p>
                                            </div>
                                        </div>
                                        @endforelse
                                    </div>
                                    <!-- If we need pagination -->
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col scrollanimation animated fadeInRight">
                        <div class="h-100 position-relative">
                            <div class="floating-top w-100">
                                <img src="{{ asset('assets/image/testimonials/portrait-of-a-happy-young-doctor-in-his-clinic-royalty-free-image-1661432441.avif') }}" alt="Healthcare professional" class="img-fluid w-100">
                            </div>
                            <div class="floating-bottom-1" style="z-index: 4;">
                                <div class="d-flex flex-column align-items-center justify-content-center gap-3 bg-accent-primary p-4 rounded-3">
                                    <div class="d-flex flex-row customer-container">
                                        <div class="customer-item">
                                            <img src="{{ asset('assets/image/team1.jpg') }}" class="img-fluid" alt="">
                                        </div>
                                        <div class="customer-item">
                                            <img src="{{ asset('assets/image/team2.jpg') }}" class="img-fluid" alt="">
                                        </div>
                                        <div class="customer-item">
                                            <img src="{{ asset('assets/image/team3.jpg') }}" class="img-fluid" alt="">
                                        </div>
                                        <div class="customer-item bg-white border-0">
                                            <span class="text-center fs-4">1k+</span>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column gap-2 align-items-center">
                                        <div class="flex-row">
                                            <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                            <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                            <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                            <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                            <i class="fa-solid fa-star" style="color: var(--text-color-1);"></i>
                                        </div>
                                        <h4>(1.5k+ Reviews)</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
