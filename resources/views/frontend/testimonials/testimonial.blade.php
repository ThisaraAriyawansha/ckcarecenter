

<section class="space-top space-bottom bg-smoke2">
    <div class="container">
        <div class="title-area text-center mb-50">
            <span class="sub-title style2 text-anim">What Families Say</span>
            <h2 class="sec-title">Client Testimonials</h2>
            <p class="fs-18">Read heartwarming stories from families who entrusted their loved ones to our care.</p>
        </div>
        
        @if($testimonials->count() > 0)
        <div class="row gy-4 flex-row-reverse">
            @foreach($testimonials as $testimonial)
            <div class="col-lg-6" data-cue="slideInUp">
                <div class="testi-card style3">
                    <div class="testi-1-quote">
                        <img src="assets/img/icon/quote_icon.svg" alt="icon">
                    </div>
                    <div class="testi-bg-mask" data-mask-src="assets/img/shape/testi_card_mask1_1.jpg"></div>
                    <div class="testi-card-profile">
                        <div class="testi-card-avater">
                            @if($testimonial->image_path)
                            <img src="{{ asset('testimonial_img/' . $testimonial->image_path) }}" 
                                 alt="{{ $testimonial->name }}" 
                                 width="80" 
                                 height="80">
                            @else
                            <img src="assets/img/testimonial/dummy.jpg" 
                                 alt="{{ $testimonial->name }}" 
                                 width="80" 
                                 height="80">
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
                    </div>
                    <p class="box-text">"{{ $testimonial->message }}"</p>
                </div>
            </div>
            @endforeach
        </div>
        
        @else
        <div class="text-center py-5">
            <div class="alert alert-info">
                <p>No testimonials available at the moment. Check back soon!</p>
            </div>
        </div>
        @endif
    </div>
</section>

