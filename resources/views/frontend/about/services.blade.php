<style>
    .ab-hs-card {
        display: block;
        position: relative;
        border-radius: 16px;
        overflow: hidden;
        cursor: pointer;
        text-decoration: none;
    }
    .ab-hs-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.45s ease;
        display: block;
    }
    .ab-hs-card:hover img { transform: scale(1.07); }
    .ab-hs-card .ab-hs-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0,30,40,.78) 0%, rgba(0,30,40,.15) 55%, transparent 100%);
        transition: background .35s ease;
    }
    .ab-hs-card:hover .ab-hs-overlay {
        background: linear-gradient(to top, rgba(0,30,40,.88) 0%, rgba(0,30,40,.45) 70%, rgba(0,30,40,.15) 100%);
    }
    .ab-hs-card .ab-hs-title {
        position: absolute;
        bottom: 0; left: 0; right: 0;
        padding: 20px 20px 18px;
        color: #fff;
        font-size: 1rem;
        font-weight: 600;
        z-index: 2;
        transition: transform .35s ease;
    }
    .ab-hs-card:hover .ab-hs-title { transform: translateY(-6px); }
    .ab-hs-card .ab-hs-readmore {
        position: absolute;
        top: 50%; left: 50%;
        transform: translate(-50%, calc(-50% + 10px));
        opacity: 0;
        transition: opacity .3s ease, transform .35s ease;
        z-index: 3;
        white-space: nowrap;
    }
    .ab-hs-card:hover .ab-hs-readmore { opacity: 1; transform: translate(-50%, -50%); }
    .ab-hs-img-wrap { aspect-ratio: 4 / 3; }
</style>

{{-- Our Services Section --}}
<div class="section">
    <div class="r-container d-flex flex-column gap-4">

        <div class="d-flex flex-column gap-3 text-center mx-auto align-items-center scrollanimation animated zoomIn"
            style="max-width: 620px;">
            <div class="d-flex flex-row gap-2 align-items-center">
                <h6 class="accent-color m-0">Our Services</h6>
            </div>
            <h3>Compassionate Care, Tailored for Every Need</h3>
            <p>From personal nursing to specialised home care, we provide a full range of services designed
                to support your loved ones with dignity and warmth.</p>
        </div>

        @if($services->count() > 0)
            <div class="row row-cols-1 row-cols-md-3 g-3">
                @foreach($services->take(6) as $service)
                    @php
                        $imgSrc = !$service->image_path || str_starts_with($service->image_path, 'assets/')
                            ? asset($service->image_path ?? 'assets/image/services/service_card_1_2.jpg')
                            : Storage::disk('services_public')->url($service->image_path);
                    @endphp
                    <div class="col">
                        <a href="{{ url('/' . $service->title_slug) }}" class="ab-hs-card">
                            <div class="ab-hs-img-wrap">
                                <img src="{{ $imgSrc }}" alt="{{ $service->title }}" loading="lazy"
                                     onerror="this.onerror=null;this.src='{{ asset('assets/image/services/service_card_1_2.jpg') }}'">
                            </div>
                            <div class="ab-hs-overlay"></div>
                            <div class="ab-hs-title">{{ $service->title }}</div>
                            <div class="ab-hs-readmore">
                                <span class="btn btn-accent rounded-pill px-4 py-2" style="font-size:.875rem;">Read More</span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <i class="rtmicon rtmicon-medical-checkup accent-color" style="font-size:72px;"></i>
                <p class="font-2 mt-3">Our services will be available shortly. Please check back soon.</p>
            </div>
        @endif

        <div class="w-max-content mx-auto scrollanimation animated fadeInUp">
            <a href="{{ route('services') }}"
               class="btn rounded-pill d-flex flex-row gap-2 px-4 py-2"
               style="background:transparent; color:#1C3F6E; border:2px solid #1C3F6E; font-size:.85rem;">
                <span>View All Services</span>
            </a>
        </div>

    </div>
</div>
