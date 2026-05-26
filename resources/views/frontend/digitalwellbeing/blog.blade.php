<section id="News-Center">
    <div class="container">
        <div class="row g-4">

            <div class="col-lg-6 offset-lg-3 text-center">
                <div class="subtitle wow fadeInUp mb-3">Articles & Tips</div>
                <h2 class="mb-4 wow fadeInUp" data-wow-delay=".2s">Latest Articles & Blog</h2>
            </div>

            @forelse ($blogs as $blog)
                <div class="col-lg-4 col-md-6">
                    <div class="relative">
                        <div class="post-image rounded-1 mb-2" style="height: 250px; overflow: hidden; position: relative;">
                            <div class="abs start-0 top-0 bg-color-2 p-3 pb-2 m-3 text-center fw-600 rounded-1 text-white">
                                <div class="fs-36 mb-0">{{ $blog->date->format('d') }}</div>
                                <span>{{ $blog->date->format('M') }}</span>
                            </div>
                            <img 
                                alt="{{ $blog->title }}"
                                loading="lazy"
                                src="{{ image_url($blog->image_path, 'blog') }}" 
                                class="lazy w-100 h-100"
                                style="object-fit: cover;"
                            >
                        </div>
                        <div class="pt-2 h-100">
                            <h4>
                                <a class="text-dark" href="{{ url('/' . $blog->title_slug) }}">
                                    {{ $blog->title }}
                                </a>
                            </h4>
                            <p class="mb-3">
                                {{ Str::limit(strip_tags($blog->description), 110) }}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p>No public blog posts available right now.</p>
                </div>
            @endforelse

            <!-- View All Button  -->
            <div class="col-12 text-center mt-5">
                <a href="{{ route('blog') }}" 
                class="blg-btn px-4 py-2 fw-600" 
                style="background-color: #FFFFFF; 
                        color: #48b1fb; 
                        border: 2px solid #48b1fb; 
                        border-radius: 50px; 
                        transition: all 0.3s ease;">
                    View All Articles
                </a>
            </div>

        </div>
    </div>
</section>

<style>
    .blg-btn:hover {
    background-color: #0A3F87 !important;
    color: #FFFFFF !important;
    transform: translateY(-2px);
}
</style>


