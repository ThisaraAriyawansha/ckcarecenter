        <style>
            .why-slide-img {
                height: 700px;
            }
            @media (max-width: 768px) {
                .why-slide-img {
                    height: 350px;
                }
            }
        </style>

        <!-- Section Why Choose Us -->
        <div class="section bg-accent" style="padding-bottom: 10rem;">
            <div class="r-container">
                <div class="row row-cols-xl-2 row-cols-1">
                    <div class="col mb-3">
                        <div class="position-relative pe-xl-5">
                            <!-- Swiper content (should be at the bottom) -->
                            <div class="swiper swiperCard" style="z-index: 1;">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide p-0 rounded-5 overflow-hidden">
                                        <div class="why-slide-img">
                                            <img src="{{ asset('assets/image/home/photo-1576091160550-2173dba999ef.jpg') }}" class="rounded-5 w-100 h-100" style="object-fit: cover;" alt="Compassionate home nursing care">
                                        </div>
                                    </div>
                                    <div class="swiper-slide p-0 rounded-5 overflow-hidden">
                                        <div class="why-slide-img">
                                            <img src="{{ asset('assets/image/home/african-caregiver-helping-senior-friendly-men-getting-up-wheelchair-33292234.jpg') }}" class="rounded-5 w-100 h-100" style="object-fit: cover;" alt="Professional nurse assisting elderly patient">
                                        </div>
                                    </div>
                                    <div class="swiper-slide p-0 rounded-5 overflow-hidden">
                                        <div class="why-slide-img">
                                            <img src="{{ asset('assets/image/home/default-image-legacy.jpg') }}" class="rounded-5 w-100 h-100" style="object-fit: cover;" alt="Dedicated home care team">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Navigation arrows (on top of everything) -->
                            <div class="swiper-button-next" style="z-index: 3;"></div>
                        </div>
                    </div>
                    <div class="col mb-3">
                        <div class="d-flex flex-column gap-3 scrollanimation animated fadeInRight">
                            <div class="d-flex flex-row gap-2 align-items-center">
                                <h6 class="accent-color m-0">Why Choose Us</h6>
                            </div>
                            <h3>Trusted Home Nursing & Care You Can Count On</h3>
                            <p>
                                At C & K Home Nursing and Care Center, we believe every individual deserves to be cared for with warmth, dignity, and expertise. Our dedicated team of registered nurses and professional caregivers deliver compassionate, round-the-clock home nursing care — tailored to each person's unique needs, in the comfort of their own home.
                            </p>
                            <div class="d-flex flex-column gap-4">
                                <div class="r-progress w-100" style="--value:95;">
                                    <h5>Skilled & Certified Nursing Staff</h5>
                                    <div class="progress-container mt-2">
                                        <div class="r-progress-bar percentage-label">
                                            <div class="progress-value"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="r-progress w-100" style="--value:98;">
                                    <h5>Patient & Family Satisfaction</h5>
                                    <div class="progress-container mt-2">
                                        <div class="r-progress-bar percentage-label">
                                            <div class="progress-value"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="r-progress w-100" style="--value:92;">
                                    <h5>Personalised Care Plans</h5>
                                    <div class="progress-container mt-2">
                                        <div class="r-progress-bar percentage-label">
                                            <div class="progress-value"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-cols-xl-2 row-cols-1">
                                <div class="col mb-3">
                                    <div
                                        class="d-flex flex-column gap-1 p-4 bg-accent-color-3 rounded-4 position-relative">
                                        <h5>Book a Home Visit</h5>
                                        <p>Schedule a professional nursing consultation at your home!</p>
                                        <a href="{{ route('lead-form') }}" class="link fw-semibold appointment-link">
                                            Make Appointment
                                        </a>
                                        <i class="rtmicon rtmicon-nutritionist position-absolute bottom-0 end-0"
                                            style="font-size: 78px;"></i>
                                    </div>
                                </div>
                                <div class="col mb-3">
                                    <div
                                        class="d-flex flex-column gap-1 p-4 bg-accent-color-3 rounded-4 position-relative">
                                        <h5>Need Urgent Care?</h5>
                                        <p>Our care team is available 24/7. Call immediately </p>
                                        <a href="tel:0773768767" class="link fw-semibold phone-link">077 376 8767</a>
                                        <i class="rtmicon rtmicon-classic-phone position-absolute bottom-0 end-0"
                                            style="font-size: 78px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <style>
            .phone-link{
                color: #1C3F6E;
            }

            .phone-link:hover{
                color: #E6007E;
            }

            .appointment-link{
                color: #1C3F6E;
            }

            .appointment-link:hover{
                color: #E6007E;
            }
        </style>