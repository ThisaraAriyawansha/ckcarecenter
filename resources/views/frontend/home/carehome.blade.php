@if(isset($carehomes) && $carehomes->count() > 0)

<style>
    .ch-card {
        background: #fff;
        border: 1px solid #eaeaea;
        border-radius: 14px;
        overflow: hidden;
        display: flex;
        flex-direction: row;
        transition: box-shadow 0.25s;
    }
    .ch-card:hover {
        box-shadow: 0 6px 24px rgba(0,0,0,0.08);
    }
    .ch-card-img-wrap {
        position: relative;
        overflow: hidden;
        width: 200px;
        min-width: 200px;
        flex-shrink: 0;
    }
    .ch-card-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.35s;
    }
    .ch-card:hover .ch-card-img-wrap img {
        transform: scale(1.04);
    }

    @media (max-width: 767px) {
        .ch-card {
            flex-direction: column;
        }
        .ch-card-img-wrap {
            width: 100%;
            min-width: 100%;
            height: 180px;
        }
    }
</style>

<div class="section">
    <div class="r-container d-flex flex-column gap-4">

        {{-- Section Header --}}
        <div class="d-flex flex-column gap-3 text-center mx-auto align-items-center scrollanimation animated zoomIn"
             style="max-width:620px;">
            <div class="d-flex flex-row gap-2 align-items-center">
                <h6 class="accent-color m-0">Our Care Homes</h6>
            </div>
            <h3>A Place Your Loved Ones Can Call Home</h3>
            <p>Discover our warm and welcoming care homes across Sri Lanka, each designed to provide comfort, safety, and joy for every resident.</p>
        </div>

        {{-- Cards --}}
        <div style="display:flex;flex-direction:column;gap:16px;">
            @foreach($carehomes as $careHome)
                @php
                    $chDefault = asset('assets/image/care home/CK3_5089-2000x1000.jpg');
                    $imgSrc = !$careHome->image_path || str_starts_with($careHome->image_path, 'assets/')
                        ? ($careHome->image_path ? asset($careHome->image_path) : $chDefault)
                        : Storage::disk('care_homes_public')->url($careHome->image_path);
                @endphp

                <div class="ch-card">

                    {{-- Image --}}
                    <div class="ch-card-img-wrap">
                        <img src="{{ $imgSrc }}"
                             alt="{{ $careHome->title }}"
                             loading="lazy"
                             onerror="this.onerror=null;this.src='{{ asset('assets/image/care home/CK3_5089-2000x1000.jpg') }}'">

                        @if($careHome->badge_text)
                            <span style="position:absolute;top:12px;left:12px;font-size:11px;font-weight:700;letter-spacing:0.6px;text-transform:uppercase;background:var(--accent-color);color:#fff;padding:4px 10px;border-radius:40px;">
                                {{ $careHome->badge_text }}
                            </span>
                        @endif
                    </div>

                    {{-- Body --}}
                    <div style="padding:18px 22px;display:flex;flex-direction:column;justify-content:center;flex:1;min-width:0;">

                        {{-- Location --}}
                        @if($careHome->location)
                            <div style="display:flex;align-items:center;gap:5px;margin-bottom:6px;">
                                <i class="fa fa-map-marker-alt" style="font-size:11px;color:var(--accent-color);"></i>
                                <span style="font-size:12px;color:var(--text-color-2);">{{ $careHome->location }}</span>
                            </div>
                        @endif

                        {{-- Title --}}
                        <h5 style="font-size:16px;font-weight:700;color:var(--text-color);margin:0 0 3px;font-family:'Raleway',sans-serif;line-height:1.3;">
                            {{ $careHome->title }}
                        </h5>

                        {{-- Subtitle --}}
                        @if($careHome->subtitle)
                            <p style="font-size:13px;color:var(--accent-color);font-weight:600;margin:0 0 10px;">
                                {{ $careHome->subtitle }}
                            </p>
                        @endif

                        {{-- Divider --}}
                        <div style="height:1px;background:#f0f0f0;margin-bottom:10px;"></div>

                        {{-- Description --}}
                        @if($careHome->description)
                            <p style="font-size:13px;color:var(--text-color-2);line-height:1.7;margin:0 0 14px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">
                                {{ $careHome->description }}
                            </p>
                        @endif

                        {{-- Footer --}}
                        <div style="display:flex;align-items:center;justify-content:space-between;gap:10px;flex-wrap:wrap;">

                            @if($careHome->contact_no)
                                <a href="tel:{{ $careHome->contact_no }}"
                                   style="display:flex;align-items:center;gap:6px;text-decoration:none;">
                                    <i class="fa fa-phone" style="font-size:12px;color:var(--accent-color);"></i>
                                    <span style="font-size:13px;font-weight:600;color:var(--text-color);">{{ $careHome->contact_no }}</span>
                                </a>
                            @endif

                            <a href="{{ url('/contact') }}"
                               style="font-size:12px;font-weight:700;padding:7px 16px;border-radius:40px;background:var(--accent-color);color:#fff;text-decoration:none;white-space:nowrap;">
                                Contact Us &rarr;
                            </a>

                        </div>

                    </div>

                </div>
            @endforeach
        </div>

    </div>
</div>

@endif