<section class="pb-5 pb-md-4">
    <div class="container">
        <div class="row g-4">

            @forelse ($blogs as $blog)
                <div class="col-lg-4 col-md-6">
                    <div class="relative">
                        <div class="post-image rounded-1 mb-2" style="height: 250px; overflow: hidden; position: relative;">
                            <div class="abs start-0 top-0 bg-color-2 text-dark p-3 pb-2 m-3 text-center fw-600 rounded-1">
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

            <!-- pagination begin -->
            <div class="col-lg-12 pt-4">
                {{ $blogs->links('vendor.pagination.custom') }}
            </div>
            <!-- pagination end -->

        </div>
    </div>
</section>