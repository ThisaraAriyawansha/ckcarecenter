        <div class="section">
            <div class="r-container d-flex flex-column gap-4">
                <div class="d-flex flex-column gap-3 align-items-center justify-content-center text-center mx-auto scrollanimation animated zoomIn"
                    style="max-width: 650px;">
                    <div class="d-flex flex-row gap-2 align-items-center">
                        <h6 class="accent-color m-0">Latest Article</h6>
                    </div>
                    <h3>Care Tips, News & Expert Insights</h3>
                    <p>
                        Stay informed with the latest articles on elderly care, senior living, and health &amp; wellness
                        to help you make the best decisions for your loved ones.
                    </p>
                </div>
                <div class="row row-cols-xl-2 row-cols-1">
                    @foreach($blogs as $index => $blog)
                    <div class="col mb-3 scrollanimation animated {{ $index % 2 === 0 ? 'fadeInLeft' : 'fadeInRight' }}">
                        <div class="card d-flex flex-column gap-3 h-100">
                            <div class="position-relative overflow-hidden rounded-3 h-100">
                                <img src="{{ image_url($blog->image_path, 'blog') }}" alt="{{ $blog->title }}" class="img-fluid h-100" onerror="this.onerror=null;this.src='{{ asset('assets/image/blog/blog_20260120084845_cZMzvwCu.jpg') }}'">
                                <div class="blog-overlay"></div>
                                <div class="position-absolute bottom-0 left-0 text-white p-5">
                                    <div class="d-flex flex-row gap-2 justify-content-between align-items-end">
                                        <div class="d-flex flex-column gap-3">
                                            <div class="px-4 py-2 border border-light rounded-pill w-max-content">
                                                <span class="text-white">
                                                    {{ $blog->category ? $blog->category->name : 'News' }}
                                                </span>
                                            </div>
                                            <h5>{{ $blog->title }}</h5>
                                        </div>
                                        <a href="{{ url('/' . $blog->title_slug) }}" class="icon-box link">
                                            <i class="rtmicon rtmicon-arrow-right" style="font-size: 30px;"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
