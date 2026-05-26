<div class="bg-smoke space overflow-hidden">
    <div class="container">
        <div class="row gy-40 gx-60">
            <div class="col-xxl-7 col-xl-7">
                <div class="title-area">
                    <span class="sub-title style2 text-anim" data-cue="slideInUp">quick answers</span>
                    <h2 class="sec-title text-anim2" data-cue="slideInLeft">Frequently Ask Questions</h2>
                </div>

                @if($faqs->count() > 0)
                <div class="faq-wrap1 pe-xl-4">
                    <div class="accordion" id="faqAccordion">
                        @foreach($faqs as $index => $faq)
                        <div class="accordion-card" data-cue="slideInUp">
                            <div class="accordion-header" id="collapse-item-{{ $index + 1 }}">
                                <button class="accordion-button {{ $index == 0 ? '' : 'collapsed' }}" 
                                        type="button" 
                                        data-bs-toggle="collapse" 
                                        data-bs-target="#collapse-{{ $index + 1 }}" 
                                        aria-expanded="{{ $index == 0 ? 'true' : 'false' }}" 
                                        aria-controls="collapse-{{ $index + 1 }}">
                                    <span class="count">{{ $index + 1 }}.</span> {{ $faq->question }}
                                </button>
                            </div>
                            <div id="collapse-{{ $index + 1 }}" 
                                 class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}" 
                                 aria-labelledby="collapse-item-{{ $index + 1 }}" 
                                 data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    <p class="faq-text">{{ $faq->answer }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @else
                <div class="alert alert-info">
                    <p>No frequently asked questions available at the moment.</p>
                </div>
                @endif

            </div>
            <div class="col-xxl-5 col-xl-5 align-self-center" data-cue="slideInUp">
                <div class="faq-img-box1 global-img" data-cue="slideInUp">
                    <img src="assets/img/faq/faq-img-1-1.jpg" alt="faq_img">
                </div>
            </div>
        </div>
    </div>
</div>