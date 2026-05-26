<section id="FAQ">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-6 offset-lg-3 text-center">                            
                <div class="subtitle wow fadeInUp mb-3">Questions</div>
                <h2 class="wow fadeInUp" data-wow-delay=".2s">Frequently Asked Questions</h2>
            </div>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-lg-8">
                <div class="accordion s2 wow fadeInUp">

                    @if($faqs->isEmpty())
                        <div class="text-center py-5">
                            <p>No frequently asked questions available at the moment.</p>
                        </div>
                    @else
                        @foreach($faqs as $index => $faq)
                            <div class="accordion-section">
                                <!-- Title / Question -->
                                <div class="accordion-section-title" 
                                     data-tab="#accordion-{{ $index + 1 }}">
                                    {{ $faq->question }}
                                </div>

                                <!-- Content / Answer -->
                                <div class="accordion-section-content" 
                                     id="accordion-{{ $index + 1 }}">
                                    <p class="mb-0">{!! nl2br(e($faq->answer)) !!}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
                
                <!-- View All Button -->
                <div class="text-center mt-4 wow fadeInUp" data-wow-delay=".4s">
                    <a href="{{ route('faq') }}" >
                        View All FAQs
                    </a>
                </div>
                
            </div>
        </div>
    </div>
</section>