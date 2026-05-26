<section>
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-6 offset-lg-3 text-center">
                <div class="subtitle wow fadeInUp mb-3">Testimonials</div>
                <h2 class="mb-4 wow fadeInUp" data-wow-delay=".2s">Our Happy Customers</h2>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            @if($testimonials->count() > 0)
                <div class="owl-carousel owl-theme wow fadeInUp" id="testimonial-carousel">
                    @foreach($testimonials as $testimonial)
                        <div class="item">
                            <div class="relative p-2">
                                <div class="relative">
                                    @if($testimonial->image_path)
                                        <img class="relative z-2 w-80px mb-3 rounded-1" alt="{{ $testimonial->name }}" src="{{ asset('testimonial_img/' . $testimonial->image_path) }}">
                                    @else
                                        <div class="relative z-2 w-80px h-80px mb-3 rounded-1 bg-light d-flex align-items-center justify-content-center">
                                            <i class="fa fa-user text-muted fa-2x"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="mt-4 text-dark fw-600">
                                    {{ $testimonial->name }}
                                    @if($testimonial->position)
                                        <span>{{ $testimonial->position }}</span>
                                    @else
                                        <span>Customer</span>
                                    @endif
                                </div>
                                <div class="de-rating-ext mb-3">
                                    <span class="d-stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $testimonial->rating)
                                                <i class="fa fa-star text-warning"></i>
                                            @else
                                                <i class="fa fa-star text-light"></i>
                                            @endif
                                        @endfor
                                    </span>
                                </div>
                                <p class="mb-0">"{{ $testimonial->message }}"</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- No testimonials message -->
                <div class="col-12 text-center py-5">
                    <div class="d-inline-block p-4 rounded-3 bg-light">
                        <i class="fa fa-comments fa-3x text-muted mb-3"></i>
                        <h4 class="mb-3">No Testimonials Yet</h4>
                        <p class="mb-0 text-muted">Check back soon to see what our customers are saying!</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

<!-- Keep these CDNs (important: jQuery first, then Owl) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script>
$(document).ready(function(){
    var owl = $('#testimonial-carousel');

    // Safety: destroy any previous broken instance first
    if (owl.hasClass('owl-loaded')) {
        owl.trigger('destroy.owl.carousel');
        owl.removeClass('owl-loaded owl-drag owl-grab');
        owl.find('.owl-stage-outer').children().unwrap();
        owl.find('.owl-stage').children().unwrap();
        owl.find('.owl-item').children().unwrap();
        owl.find('.owl-dots, .owl-nav').remove();
    }

    owl.owlCarousel({
        loop: true,                     // important for continuous autoplay
        margin: 20,
        nav: false,                      // keep your left/right arrows
        dots: true,                     // ← this enables the bottom dots (pagination)
        dotsEach: true,                 // shows one dot per item (clean look)
        autoplay: true,                 // enable auto slide
        autoplayTimeout: 5000,          // 5 seconds between slides (change if you want longer/shorter)
        autoplayHoverPause: true,       // pause when mouse over (good UX)
        autoplaySpeed: 800,             // transition speed (smooth but not too slow)
        smartSpeed: 1000,               // main animation smoothness
        slideTransition: 'ease',        // 'ease' or 'linear' — 'ease' feels more natural/professional
        navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
        responsive: {
            0:    { items: 1 },
            768:  { items: 2 },
            1024: { items: 4 }
        }
    });

    // Force autoplay start after short delay (fixes 90% of "autoplay not starting" cases)
    setTimeout(function() {
        if (owl.find('.owl-item').length > 1) {  // only if there are multiple slides
            owl.trigger('play.owl.autoplay', [5000]);  // match your timeout
        }
    }, 300);  // 300ms delay helps when images/content load slowly
});
</script>