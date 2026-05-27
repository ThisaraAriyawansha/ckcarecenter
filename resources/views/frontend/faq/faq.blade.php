<div class="section">
            <div class="r-container d-flex flex-column gap-4 align-items-center">
                <div class="d-flex flex-column gap-3 text-center mx-auto align-items-center scrollanimation animated zoomIn"
                    style="max-width: 650px;">
                    <div class="d-flex flex-row gap-2 align-items-center">
                        <h6 class="accent-color m-0">FAQs</h6>
                    </div>
                    <h3>Frequently Asked Questions</h3>
                    <p>This FAQ section addresses common questions regarding private nursing and home care services, it
                        covers essential topics</p>
                </div>

                @if($faqs->isNotEmpty())
                @php
                    $leftFaqs  = $faqs->slice(0, ceil($faqs->count() / 2));
                    $rightFaqs = $faqs->slice(ceil($faqs->count() / 2));
                @endphp
                <div class="row row-cols-xl-2 row-cols-1 w-100">
                    <div class="col mb-3">
                        <div class="d-flex flex-column gap-4 w-100 scrollanimation animated fadeInUp">
                            <div class="accordion mt-3 d-flex flex-column gap-4" id="faqAccordionLeft">
                                @foreach($leftFaqs as $faq)
                                @php $faqId = 'faq-left-' . $loop->index; @endphp
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#{{ $faqId }}"
                                            aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                            aria-controls="{{ $faqId }}">
                                            {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}. {{ $faq->question }}
                                        </button>
                                    </h2>
                                    <div id="{{ $faqId }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                        data-bs-parent="#faqAccordionLeft">
                                        <div class="accordion-body">
                                            {{ $faq->answer }}
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    @if($rightFaqs->isNotEmpty())
                    <div class="col mb-3">
                        <div class="d-flex flex-column gap-4 w-100 scrollanimation animated fadeInUp">
                            <div class="accordion mt-3 d-flex flex-column gap-4" id="faqAccordionRight">
                                @foreach($rightFaqs as $faq)
                                @php $faqId = 'faq-right-' . $loop->index; $offset = $leftFaqs->count(); @endphp
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#{{ $faqId }}"
                                            aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                            aria-controls="{{ $faqId }}">
                                            {{ str_pad($offset + $loop->iteration, 2, '0', STR_PAD_LEFT) }}. {{ $faq->question }}
                                        </button>
                                    </h2>
                                    <div id="{{ $faqId }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                        data-bs-parent="#faqAccordionRight">
                                        <div class="accordion-body">
                                            {{ $faq->answer }}
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                @else
                <p class="text-muted text-center">No FAQs available at the moment.</p>
                @endif
            </div>
        </div>
