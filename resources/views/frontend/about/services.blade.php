<section class="bg-smoke2 space overflow-hidden" id="service-sec">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-xxl-5 col-xl-7 col-md-8">
                <div class="title-area">
                    <span class="sub-title style2 text-anim" data-cue="slideInUp"> Our Services</span>
                    <h2 class="sec-title text-anim2" data-cue="slideInUp">Our Comprehensive Care Services</h2>
                </div>
            </div>
            <div class="col-auto">
                <div class="sec-btn">
                    <a class="th-btn style-border3" href="{{ route('services') }}">Browse All Services</a>
                </div>
            </div>
        </div>
        
        @if($services->count() > 0)
        <div class="slider-area service-slider1">
            <div class="swiper th-slider" id="serviceSlider1" data-slider-options='{"autoHeight":true,"breakpoints":{"0":{"slidesPerView":1},"767":{"slidesPerView":"2"},"1200":{"slidesPerView":"3"},"1400":{"slidesPerView":"4"}}}'>
                <div class="swiper-wrapper">
                    @foreach($services as $service)
                    <div class="swiper-slide" data-cue="slideInUp">
                        <div class="service-card">
                            <a class="icon-btn style3" href="{{ service_url($service) }}">
                                <img data-mask-src="assets/img/icon/arrow-right.svg" src="assets/img/icon/arrow-right.svg" alt="img">
                            </a>
                            <div class="box-img" data-mask-src="assets/img/shape/service_card_mask1_1.jpg">
                                <img src="{{ image_url($service->image_path, 'service') }}" alt="{{ $service->title }}">
                            </div>
                            <div class="box-content">
                                <h3 class="box-title">
                                    <a href="{{ service_url($service) }}">
                                        {{ $service->title }}
                                    </a>
                                </h3>
                                <p class="box-text">
                                    {{ excerpt($service->description, 120) }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="pagination-wrap">
                    <button data-slider-prev="#serviceSlider1" class="slider-arrow default style-border2 slider-prev">
                        <img data-mask-src="assets/img/icon/arrow-left.svg" src="assets/img/icon/arrow-left.svg" alt="img">
                    </button>
                    <div class="slider-pagination"></div>
                    <button data-slider-next="#serviceSlider1" class="slider-arrow default style-border2 slider-next">
                        <img data-mask-src="assets/img/icon/arrow-right.svg" src="assets/img/icon/arrow-right.svg" alt="img">
                    </button>
                </div>
            </div>
        </div>
        @else
        <div class="text-center py-5">
            <p>No services available at the moment.</p>
        </div>
        @endif
    </div>
</section>