
<style>
    .tm-card {
        background: #fff;
        border: 1px solid #eaeaea;
        border-radius: 14px;
        padding: 28px 28px 24px;
        display: flex;
        flex-direction: column;
        gap: 16px;
        transition: box-shadow 0.25s;
    }
    .tm-card:hover {
        box-shadow: 0 6px 24px rgba(0,0,0,0.08);
    }
    .tm-avatar {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        object-fit: cover;
        flex-shrink: 0;
        border: 2px solid #f0f0f0;
    }
    .tm-stars {
        color: #f5a623;
        font-size: 14px;
        letter-spacing: 1px;
    }
    .tm-quote {
        font-size: 13px;
        color: var(--text-color-2);
        line-height: 1.75;
        margin: 0;
    }
    .tm-name {
        font-size: 15px;
        font-weight: 700;
        color: var(--text-color);
        margin: 0;
        font-family: 'Raleway', sans-serif;
    }
    .tm-position {
        font-size: 12px;
        color: var(--accent-color);
        font-weight: 600;
        margin: 0;
    }
    .tm-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
    @media (max-width: 767px) {
        .tm-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="section">
    <div class="r-container d-flex flex-column gap-4">

        {{-- Section Header --}}
        <div class="d-flex flex-column gap-3 text-center mx-auto align-items-center scrollanimation animated zoomIn"
             style="max-width:620px;">
            <div class="d-flex flex-row gap-2 align-items-center">
                <h6 class="accent-color m-0">What Families Say</h6>
            </div>
            <h3>Stories of Care, Comfort &amp; Trust</h3>
            <p>Read what our residents and their loved ones share about their experience with our compassionate care services across Sri Lanka.</p>
        </div>

        @if($testimonials->isEmpty())
            <p class="text-center" style="color:var(--text-color-2);font-size:14px;">No testimonials available yet.</p>
        @else
            <div class="tm-grid">
                @foreach($testimonials as $testimonial)
                    @php
                        $defaultImg = asset('assets/image/testimonials/test_img.png');
                        if ($testimonial->image_path) {
                            $imgSrc = str_starts_with($testimonial->image_path, 'assets/')
                                ? asset($testimonial->image_path)
                                : Storage::disk('testimonial_public')->url($testimonial->image_path);
                        } else {
                            $imgSrc = $defaultImg;
                        }
                        $rating = max(1, min(5, (int) $testimonial->rating));
                    @endphp

                    <div class="tm-card">

                        {{-- Quote icon --}}
                        <i class="fa fa-quote-left" style="font-size:22px;color:var(--accent-color);opacity:0.35;"></i>

                        {{-- Message --}}
                        @if($testimonial->message)
                            <p class="tm-quote">{{ $testimonial->message }}</p>
                        @endif

                        {{-- Stars --}}
                        <div class="tm-stars">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fa{{ $i <= $rating ? 's' : 'r' }} fa-star"></i>
                            @endfor
                        </div>

                        {{-- Divider --}}
                        <div style="height:1px;background:#f0f0f0;"></div>

                        {{-- Author --}}
                        <div style="display:flex;align-items:center;gap:14px;">
                            <img class="tm-avatar"
                                 src="{{ $imgSrc }}"
                                 alt="{{ $testimonial->name }}"
                                 loading="lazy"
                                 onerror="this.onerror=null;this.src='{{ $defaultImg }}'">
                            <div>
                                <p class="tm-name">{{ $testimonial->name }}</p>
                                @if($testimonial->position)
                                    <p class="tm-position">{{ $testimonial->position }}</p>
                                @endif
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif

    </div>
</div>
