        <!-- FAQs -->
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
                <div class="d-flex flex-column gap-4 w-100 ">
                    <div class="accordion mt-3 d-flex flex-column gap-4" id="faqAccordion1">
                        @forelse($faqs as $index => $faq)
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}" type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#faq{{ $faq->id }}"
                                    aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                    aria-controls="faq{{ $faq->id }}">
                                    {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }} {{ $faq->question }}
                                </button>
                            </h2>
                            <div id="faq{{ $faq->id }}"
                                class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                data-bs-parent="#faqAccordion1">
                                <div class="accordion-body">
                                    {{ $faq->answer }}
                                </div>
                            </div>
                        </div>
                        @empty
                        <p class="text-center text-muted">No FAQs available at the moment.</p>
                        @endforelse
                    </div>
                </div>
                <div class="w-max-content">
                    <a href="{{ route('faq') }}" class="btn btn-accent rounded-pill d-flex flex-row gap-2 px-5 py-3">
                        <span>View All</span>
                    </a>
                </div>
            </div>
        </div>
