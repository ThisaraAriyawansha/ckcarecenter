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
                

                
            </div>
        </div>
    </div>
    <div style="text-align: center; background: #ffffff;   margin-top: 100px;">
        <h3 style="font-size: 26px; font-weight: 600; color: #0F172A; margin: 0 0 12px 0;">
            Still Have Questions?
        </h3>
        <p style="font-size: 15px; color: #64748B; margin: 0 0 25px 0;  margin-left: auto; margin-right: auto; line-height: 1.6;">
            We’re here to help. Reach out to us for more details about admissions, care services, 
            and how we can support your loved one.
        </p>
        <a class="btn-main bg-color-2  mb-3 wow fadeInUp"
        data-wow-delay=".6s"
        href="https://wa.me/94779191818"
        target="_blank">
            Request Admission Information
        </a>
    </div>

</section>