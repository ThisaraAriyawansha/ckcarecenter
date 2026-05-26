        <!-- Section About Us -->
        <style>
            .about-glow-pink {
                position: absolute;
                top: -40px;
                right: -40px;
                width: 180px;
                height: 180px;
                background: radial-gradient(circle, rgba(230, 0, 126, 0.35) 0%, transparent 70%);
                border-radius: 50%;
                z-index: 1;
                pointer-events: none;
                animation: aboutGlowFloat 5s ease-in-out infinite;
            }

            .about-glow-teal {
                position: absolute;
                bottom: 40px;
                left: -30px;
                width: 140px;
                height: 140px;
                background: radial-gradient(circle, rgba(1, 137, 142, 0.45) 0%, transparent 70%);
                border-radius: 50%;
                z-index: 1;
                pointer-events: none;
                animation: aboutGlowFloat 6s ease-in-out infinite reverse;
            }

            .about-glow-pink-sm {
                position: absolute;
                bottom: 80px;
                right: 30px;
                width: 80px;
                height: 80px;
                background: radial-gradient(circle, rgba(230, 0, 126, 0.25) 0%, transparent 70%);
                border-radius: 50%;
                z-index: 1;
                pointer-events: none;
                animation: aboutGlowFloat 4s ease-in-out infinite 1s;
            }

            @keyframes aboutGlowFloat {
                0%, 100% { transform: translateY(0) scale(1); opacity: 0.75; }
                50% { transform: translateY(-18px) scale(1.12); opacity: 1; }
            }

            .about-vision-card {
                box-shadow: 0 8px 32px rgba(230, 0, 126, 0.18), 0 2px 12px rgba(0, 69, 81, 0.25);
            }

            .about-stats-overlay {
                width: max-content;
            }

            @media (max-width: 1199px) {
                .about-stats-overlay {
                    width: 100% !important;
                    max-width: 100%;
                    border-top-right-radius: 0 !important;
                    border-top-left-radius: 16px;
                    border-top-right-radius: 16px !important;
                    flex-direction: row;
                    flex-wrap: wrap;
                    justify-content: space-between;
                    gap: 0.75rem;
                }
            }

            .about-vision-card .icon-box {
                animation: iconPulseGlow 2.5s ease-in-out infinite;
            }

            .btn-about-learn {
                background: white;
                color: var(--accent-color);
                border: 2px solid var(--accent-color);
                font-weight: 600;
                transition: all 0.3s ease;
            }

            .btn-about-learn:hover {
                background: var(--accent-color);
                color: white;
                border-color: var(--accent-color);
            }

            @keyframes iconPulseGlow {
                0%, 100% { box-shadow: 0 0 8px rgba(230, 0, 126, 0.5); }
                50% { box-shadow: 0 0 22px rgba(230, 0, 126, 0.9), 0 0 40px rgba(230, 0, 126, 0.3); }
            }
        </style>
        <div class="section pt-0 " style="margin-top: 5rem;">
            <div class="r-container d-flex flex-column gap-4">
                <div class="d-flex flex-column gap-3 align-items-center justify-content-center mx-auto text-center scrollanimation animated zoomIn"
                    style="max-width: 620px;">
                    <div class="d-flex flex-row gap-2 align-items-center">
                        <img src="{{ asset('assets/image/cuida_medicine-outline.png') }}" class="img-fluid" alt="">
                        <h6 class="accent-color m-0">Who We Are</h6>
                    </div>
                    <h3>Compassionate Home Nursing &amp; Care for Your Loved Ones</h3>
                    <p>
                        At C &amp; K Home Nursing and Care Center, we are dedicated to providing professional,
                        compassionate, and personalized nursing care - delivered right to the comfort of your home.
                    </p>
                </div>
                <div class="row row-cols-xl-2 row-cols-1">
                    <div class="col col-xl-5 mb-3 scrollanimation animated fadeInLeft">
                        <div class="position-relative bg-attach-cover py-5 px-4 rounded-4 overflow-hidden about-vision-card"
                            style="background-image: url('{{ asset('assets/image/home/56365356.webp') }}');">
                            <div class="bg-overlay"></div>
                            <div class="about-glow-pink"></div>
                            <div class="about-glow-teal"></div>
                            <div class="about-glow-pink-sm"></div>
                            <div class="d-flex flex-column position-relative" style="z-index: 2;">
                                <div
                                    class="d-flex flex-xl-row flex-column align-items-xl-start align-items-center gap-3">
                                    <div class="icon-box">
                                        <i class="rtmicon rtmicon-chemistry fs-1"></i>
                                    </div>
                                    <div
                                        class="d-flex flex-column align-items-xl-start text-white align-items-center gap-2">
                                        <h4 class="m-0">Our Vision</h4>
                                        <p class="text-white">To be the most trusted home nursing and care provider,
                                            ensuring dignity, comfort, and quality of life for every individual we serve.</p>
                                    </div>
                                </div>
                                <div
                                    class="d-flex flex-xl-row flex-column align-items-xl-start align-items-center gap-3">
                                    <div class="icon-box">
                                        <i class="rtmicon rtmicon-pharmacy fs-1"></i>
                                    </div>
                                    <div class="d-flex flex-column align-items-xl-start align-items-center gap-2">
                                        <h4 class="m-0 text-white">Our Mission</h4>
                                        <p class="text-white">To deliver exceptional, personalized home nursing care
                                            that enhances well-being and gives complete peace of mind to families.</p>
                                    </div>
                                </div>
                                <hr class="accent-color-primary">
                                <div class="d-flex flex-xl-row flex-column gap-3 mt-3 text-white">
                                    <div class="d-flex flex-row gap-2 align-items-center">
                                        <i class="rtmicon rtmicon-location"></i>
                                        <span class="font-3">Colombo, Sri lanka</span>
                                    </div>
                                    <div class="d-flex flex-row gap-2 align-items-center">
                                        <i class="rtmicon rtmicon-classic-phone"></i>
                                        <span class="font-3">0761-8523-398</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col col-xl-7 mb-3 scrollanimation animated fadeInRight">
                        <div class="bg-attach-cover rounded-4 overflow-hidden"
                            style="background-image: url('{{ asset('assets/image/home/premium_photo-1663054397533-2a3fb0cab5de.jpg') }}'); min-height: 400px;">
                            <div class="d-flex flex-column position-relative h-100" style="z-index: 2;">
                                <div class="d-flex flex-row gap-3 align-items-center bg-accent p-3 position-absolute bottom-0 start-0 about-stats-overlay"
                                    style="border-top-right-radius: 20px;">
                                    <div class="d-flex flex-row customer-container">
                                        <div class="customer-item">
                                            <img src="{{ asset('assets/image/home/photo-1580869318757-a6c605b061ed.avif') }}" class="img-fluid" alt="Happy Patient">
                                        </div>
                                        <div class="customer-item">
                                            <img src="{{ asset('assets/image/home/photo-1584515933487-779824d29309.avif') }}" class="img-fluid" alt="Satisfied Family">
                                        </div>
                                        <div class="customer-item">
                                            <img src="{{ asset('assets/image/home/photo-1559234938-b60fff04894d.avif') }}" class="img-fluid" alt="Care Recipient">
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column gap-2">
                                        <div class="flex-row">
                                            <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                            <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                            <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                            <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                            <i class="fa-solid fa-star" style="color: var(--primary);"></i>
                                        </div>
                                        <h6>(1.5k+ Happy Families)</h6>
                                    </div>
                                    {{-- Learn More button inside overlay on mobile only --}}
                                    <a href="{{ route('contact') }}"
                                        class="btn btn-about-learn rounded-pill px-4 py-2 ms-auto d-xl-none">
                                        Learn More
                                    </a>
                                </div>
                                {{-- Learn More button as absolute on xl+ only --}}
                                <div class="position-absolute end-0 bottom-0 d-none d-xl-block"
                                    style="margin-bottom: 2rem; margin-right: 2rem;">
                                    <div class="w-max-content align-self-end scrollanimation animated fadeInLeft">
                                        <a href="{{ route('contact') }}"
                                            class="btn btn-about-learn rounded-pill d-flex flex-row gap-2 px-5 py-3">
                                            <span>Learn More</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
