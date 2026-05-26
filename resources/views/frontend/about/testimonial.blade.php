<section class="testi-area-1 space overflow-hidden bg-white" id="testi-sec">
    <div class="container">
        <div class="title-area text-center">
            <span class="sub-title style2 text-anim" data-cue="slideInUp">Testimonials</span>
            <h2 class="sec-title text-anim" data-cue="slideInUp">What Families Say About Us</h2>
            <p class="fs-18 text-anim2" data-cue="slideInUp">Read the heartwarming stories from families who entrusted their loved ones to our care.</p>
        </div>
        
        @if($testimonials->count() > 0)
        <div class="row gy-50 flex-row-reverse">
            <div class="slider-area testi-slider1" data-cue="slideInUp">
                <div class="swiper th-slider has-shadow" id="testiSlide1" data-slider-options='{"autoHeight": false,"breakpoints":{"0":{"slidesPerView":1},"768":{"slidesPerView":"1"},"992":{"slidesPerView":"1"},"1200":{"slidesPerView":"2"},"1600":{"slidesPerView":"2"}}}'>
                    <div class="swiper-wrapper">
                        @foreach($testimonials as $testimonial)
                        <div class="swiper-slide">
                            <div class="testi-card">
                                <div class="testi-1-quote">
                                    <img src="assets/img/icon/quote_icon.svg" alt="icon">
                                </div>
                                <div class="testi-bg-mask" data-mask-src="assets/img/shape/testi_card_mask1_1.jpg"></div>
                                <div class="testi-card-profile">
                                    <div class="testi-card-avater">
                                        @if($testimonial->image_path)
                                        <img src="{{ asset('testimonial_img/' . $testimonial->image_path) }}" alt="{{ $testimonial->name }}" width="80" height="80" loading="lazy">
                                        @else
                                        <img src="assets/img/testimonial/dummy.jpg" alt="{{ $testimonial->name }}" width="80" height="80" loading="lazy">
                                        @endif
                                    </div>
                                    <div class="testi-card-profile-detaile">
                                        <h3 class="box-title">{{ $testimonial->name }}</h3>
                                        <p class="box-desig">{{ $testimonial->position }}</p>
                                    </div>
                                </div>

                                <div class="testi-card_review">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $testimonial->rating)
                                        <i class="fa-sharp fa-solid fa-star"></i>
                                        @else
                                        <i class="fa-sharp fa-regular fa-star"></i>
                                        @endif
                                    @endfor
                                    <span class="rating-number ms-2">({{ $testimonial->rating }}/5)</span>
                                </div>
                                
                                <p class="box-text">"{{ $testimonial->message }}"</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="slider-pagination-wrap mt-30">
                        <button data-slider-prev="#testiSlide1" class="slider-arrow default"><i class="far fa-arrow-left"></i></button>
                        <div class="slider-pagination"></div>
                        <button data-slider-next="#testiSlide1" class="slider-arrow default"><i class="far fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="text-center py-5">
            <div class="alert alert-info">
                <p>No testimonials available at the moment.</p>
            </div>
        </div>
        @endif
    </div>
</section>