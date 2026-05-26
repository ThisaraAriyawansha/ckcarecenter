<section class="bg-smoke2 space overflow-hidden" id="blog-sec">
    <div class="container">
        <div class="title-area text-center">
            <span class="sub-title style2 text-anim" data-cue="slideInUp">Articles & Tips</span>
            <h2 class="sec-title text-anim" data-cue="slideInUp">Latest Articles & Blog</h2>
        </div>
        
        @if($blogs->count() > 0)
        <div class="row gy-40 justify-content-center">
            @foreach($blogs as $blog)
            <div class="col-xl-4 col-lg-6" data-cue="slideInUp">
                <div class="blog-card">
                    <div class="blog-img">
                        <a href="{{ blog_url($blog) }}">
                            <img src="{{ image_url($blog->image_path, 'blog') }}" alt="{{ $blog->title }}">
                        </a>
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span><i class="fas fa-user"></i>{{ $blog->name }}</span>
                            <span><i class="fas fa-calendar"></i>{{ format_date($blog->date) }}</span>
                        </div>
                        <h3 class="box-title">
                            <a href="{{ blog_url($blog) }}">
                                {{ $blog->title }}
                            </a>
                        </h3>
                        <p class="blog-excerpt mt-2 mb-3">
                            {{ excerpt($blog->description, 120) }}
                        </p>
                        <div class="btn-wrap">
                            <a href="{{ blog_url($blog) }}" class="link-btn th-btn-icon">
                                Read More
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-50">
            <a href="{{ route('blog') }}" class="th-btn style-border3">View All Blogs</a>
        </div>
        
        @else
        <div class="text-center py-5">
            <div class="alert alert-info">
                <p>No blog posts available at the moment.</p>
            </div>
        </div>
        @endif
    </div>
</section>