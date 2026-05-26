        <!-- Team -->
        <div class="section">
            <div class="r-container d-flex flex-column gap-3 align-items-center">
                <div class="d-flex flex-column gap-3 text-center mx-auto align-items-center scrollanimation animated zoomIn"
                    style="max-width: 600px;">
                    <div class="d-flex flex-row gap-2 align-items-center">
                        <h6 class="accent-color m-0">Our Team</h6>
                    </div>
                    <h3>The Dedicated People Behind Our Care</h3>
                    <p>Our team of qualified nurses, pharmacists, and care specialists work together to deliver
                        compassionate, personalised support to every resident in our care.</p>
                </div>

                @if($teamMembers->isNotEmpty())
                <!-- Class Cards -->
                <div class="swiper mySwiper w-100 scrollanimation animated fadeInUp">
                    <div class="swiper-wrapper">
                        @foreach($teamMembers as $member)
                        <div class="swiper-slide">
                            <div class="card class-card card-overlay gap-3">
                                <div class="card-image overflow-hidden rounded-4 position-relative">
                                    @if($member->image_path)
                                        <img src="{{ Storage::disk('team_img')->url($member->image_path) }}"
                                             alt="{{ $member->name }}" class="img-fluid">
                                    @else
                                        <img src="{{ asset('assets/image/team/portrait-of-a-happy-young-doctor-in-his-clinic-royalty-free-image-1661432441.avif') }}"
                                             alt="{{ $member->name }}" class="img-fluid">
                                    @endif

                                    <div class="card-footer border-0 bg-white position-absolute bottom-0 start-0 end-0 rounded-3"
                                        style="margin-bottom: 1rem; margin-left: 1rem; margin-right: 1rem;">
                                        <div class="d-flex flex-column justify-content-center align-items-center text-center">
                                            <h5>{{ $member->name }}</h5>
                                            @if($member->bio)
                                                <span class="font-2">{{ $member->bio }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-scrollbar custom-scrollbar"></div>
                </div>
                @endif
            </div>
        </div>
