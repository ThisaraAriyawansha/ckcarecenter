
<style>
    /* ── Blog Detail Layout ── */
    .bd-section {
        padding: 72px 16px;
        background: #fafafa;
    }
    .bd-container {
        max-width: 1140px;
        margin: 0 auto;
    }
    .bd-featured-img {
        width: 100%;
        max-height: 480px;
        object-fit: cover;
        border-radius: 12px;
        display: block;
        margin-bottom: 48px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.08);
    }

    /* ── Two-column grid ── */
    .bd-grid {
        display: grid;
        grid-template-columns: 1fr 300px;
        gap: 56px;
        align-items: start;
    }
    @media (max-width: 900px) {
        .bd-grid { grid-template-columns: 1fr; gap: 40px; }
        .bd-section { padding: 48px 16px; }
    }

    /* ── Main article ── */
    .bd-title {
        font-size: clamp(1.5rem, 3vw, 2.1rem);
        font-weight: 700;
        color: #111;
        line-height: 1.3;
        letter-spacing: -0.4px;
        margin: 0 0 28px;
    }
    .bd-body {
        font-size: 1rem;
        line-height: 1.85;
        color: #3a3a3a;
    }
    .bd-body p { margin: 0 0 20px; }
    .bd-body img { max-width: 100%; border-radius: 8px; }
    .bd-body h2, .bd-body h3 { color: #111; margin-top: 36px; }
    .bd-body a { color: #2a6dd9; }
    .bd-divider {
        border: none;
        border-top: 1px solid #e8e8e8;
        margin: 48px 0;
    }

    /* ── Sidebar ── */
    .bd-widget {
        background: #fff;
        border-radius: 12px;
        padding: 28px 24px;
        border: 1px solid #ebebeb;
        margin-bottom: 24px;
    }
    .bd-widget:last-child { margin-bottom: 0; }
    .bd-widget-title {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        color: #999;
        margin: 0 0 20px;
    }

    /* ── Recent posts ── */
    .bd-post-list { list-style: none; margin: 0; padding: 0; }
    .bd-post-item {
        display: grid;
        grid-template-columns: 64px 1fr;
        gap: 12px;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #f0f0f0;
    }
    .bd-post-item:first-child { padding-top: 0; }
    .bd-post-item:last-child { border-bottom: none; padding-bottom: 0; }
    .bd-post-thumb {
        width: 64px;
        height: 64px;
        object-fit: cover;
        border-radius: 8px;
        display: block;
    }
    .bd-post-link {
        font-size: 0.875rem;
        font-weight: 600;
        color: #111;
        text-decoration: none;
        line-height: 1.4;
        display: block;
        margin-bottom: 4px;
        transition: color 0.2s;
    }
    .bd-post-link:hover { color: #2a6dd9; }
    .bd-post-date {
        font-size: 0.75rem;
        color: #aaa;
    }

    /* ── Tags ── */
    .bd-tags { display: flex; flex-wrap: wrap; gap: 8px; list-style: none; margin: 0; padding: 0; }
    .bd-tags li a {
        display: inline-block;
        padding: 5px 14px;
        border-radius: 999px;
        background: #f3f3f3;
        color: #555;
        font-size: 0.8rem;
        font-weight: 500;
        text-decoration: none;
        transition: background 0.2s, color 0.2s;
    }
    .bd-tags li a:hover { background: #111; color: #fff; }
    .bd-tags .no-tags { font-size: 0.85rem; color: #bbb; }
</style>

<section class="bd-section">
    <div class="bd-container">

        {{-- Featured image --}}
        @php $defaultImg = asset('assets/image/blog/blog_20260120084845_cZMzvwCu.jpg'); @endphp
        <img src="{{ image_url($blog->image_path, 'blog') }}"
             class="bd-featured-img"
             alt="{{ $blog->title }}"
             loading="lazy"
             onerror="this.onerror=null;this.src='{{ $defaultImg }}'">

        <div class="bd-grid">

            {{-- Main content --}}
            <article>
                <h2 class="bd-title">{{ $blog->title }}</h2>
                <div class="bd-body">
                    {!! $blog->description !!}
                </div>
                <hr class="bd-divider">
            </article>

            {{-- Sidebar --}}
            <aside>

                {{-- Recent posts --}}
                @if($relatedBlogs->count() > 0)
                <div class="bd-widget">
                    <p class="bd-widget-title">Recent Posts</p>
                    <ul class="bd-post-list">
                        @foreach($relatedBlogs as $relatedBlog)
                        <li class="bd-post-item">
                            <img src="{{ image_url($relatedBlog->image_path, 'blog') }}"
                                 class="bd-post-thumb"
                                 alt="{{ $relatedBlog->title }}"
                                 loading="lazy"
                                 onerror="this.onerror=null;this.src='{{ $defaultImg }}'">
                            <div>
                                <a href="{{ url('/' . $relatedBlog->title_slug) }}" class="bd-post-link">
                                    {{ Str::limit($relatedBlog->title, 55) }}
                                </a>
                                <span class="bd-post-date">{{ $relatedBlog->date->format('M j, Y') }}</span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- Tags --}}
                <div class="bd-widget">
                    <p class="bd-widget-title">Tags</p>
                    <ul class="bd-tags">
                        @if($blog->tags->count() > 0)
                            @foreach($blog->tags as $tag)
                            <li><a href="#">{{ $tag->name }}</a></li>
                            @endforeach
                        @else
                            <li class="no-tags">No tags yet.</li>
                        @endif
                    </ul>
                </div>

            </aside>

        </div>
    </div>
</section>
