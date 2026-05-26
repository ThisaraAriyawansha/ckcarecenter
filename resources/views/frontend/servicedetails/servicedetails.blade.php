{{-- Minimal responsive style block — only breakpoint rules, all component styles remain inline --}}
<style>
    .sd-layout          { display:flex; gap:40px; align-items:flex-start; }
    .sd-main            { flex:3; min-width:0; }
    .sd-sidebar         { flex:1; min-width:0; }
    .sd-sticky          { position:sticky; top:100px; }
    .sd-why-grid        { display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:32px; }
    .sd-hero-img        { height:280px; }

    @media (max-width: 991px) {
        .sd-layout       { flex-direction:column; gap:32px; }
        .sd-sidebar      { width:100%; }
        .sd-sticky       { position:static; }
        .sd-why-grid     { grid-template-columns:1fr 1fr; }
        .sd-hero-img     { height:220px; }
    }

    @media (max-width: 575px) {
        .sd-why-grid     { grid-template-columns:1fr; }
        .sd-hero-img     { height:180px; }
        .sd-cta-strip    { flex-direction:column; align-items:flex-start !important; }
        .sd-layout       { padding-left:16px; padding-right:16px; }
    }
</style>

<section style="padding:40px 0;">
    <div class="r-container">
        <div class="sd-layout">

            {{-- ── LEFT: Service Detail (75%) ── --}}
            <div class="sd-main">

                {{-- Featured Image --}}
                @php
                    $imgSrc = !$service->image_path || str_starts_with($service->image_path, 'assets/')
                        ? asset($service->image_path ?? 'assets/image/services/service_card_1_2.jpg')
                        : \Illuminate\Support\Facades\Storage::disk('services_public')->url($service->image_path);
                @endphp

                <div style="border-radius:12px;overflow:hidden;margin-bottom:28px;">
                    <img src="{{ $imgSrc }}"
                         alt="{{ $service->title }}"
                         class="sd-hero-img"
                         style="width:100%;object-fit:cover;display:block;"
                         onerror="this.onerror=null;this.src='{{ asset('assets/image/services/service_card_1_2.jpg') }}'">
                </div>

                {{-- Category Pill --}}
                <span style="font-size:11px;font-weight:600;letter-spacing:0.8px;text-transform:uppercase;color:var(--text-color-2);background:#f5f5f5;border:1px solid #e5e5e5;padding:4px 12px;border-radius:40px;">
                    Our Services
                </span>

                {{-- Title --}}
                <h1 style="font-size:clamp(20px,3vw,28px);font-weight:700;color:var(--text-color);margin:14px 0 6px;font-family:'Raleway',sans-serif;line-height:1.25;">
                    {{ $service->title }}
                </h1>

                <div style="width:36px;height:2px;background-color:var(--accent-color);border-radius:2px;margin-bottom:24px;"></div>

                {{-- Description --}}
                <div style="font-size:15px;color:var(--text-color-2);line-height:1.85;">
                    {!! $service->description !!}
                </div>

                {{-- Divider --}}
                <div style="height:1px;background:#e8e8e8;margin:32px 0;"></div>

                {{-- Why Choose Label --}}
                <p style="font-size:11px;font-weight:700;letter-spacing:0.8px;text-transform:uppercase;color:#aaa;margin:0 0 18px;">
                    Why choose this service
                </p>

                {{-- Why Choose Grid --}}
                <div class="sd-why-grid">

                    <div style="display:flex;align-items:flex-start;gap:12px;padding:16px;border:1px solid #eaeaea;border-radius:12px;background:#fff;">
                        <i class="fa fa-user-md" style="font-size:18px;color:var(--accent-color);margin-top:2px;flex-shrink:0;"></i>
                        <div>
                            <p style="font-size:14px;font-weight:700;color:var(--text-color);margin:0 0 4px;">Expert Professionals</p>
                            <p style="font-size:13px;color:var(--text-color-2);margin:0;line-height:1.6;">Qualified specialists dedicated to your wellbeing.</p>
                        </div>
                    </div>

                    <div style="display:flex;align-items:flex-start;gap:12px;padding:16px;border:1px solid #eaeaea;border-radius:12px;background:#fff;">
                        <i class="fa fa-heart" style="font-size:18px;color:var(--accent-color);margin-top:2px;flex-shrink:0;"></i>
                        <div>
                            <p style="font-size:14px;font-weight:700;color:var(--text-color);margin:0 0 4px;">Patient-Centred Care</p>
                            <p style="font-size:13px;color:var(--text-color-2);margin:0;line-height:1.6;">Treatment plans built around your unique needs.</p>
                        </div>
                    </div>

                    <div style="display:flex;align-items:flex-start;gap:12px;padding:16px;border:1px solid #eaeaea;border-radius:12px;background:#fff;">
                        <i class="fa fa-shield-alt" style="font-size:18px;color:var(--accent-color);margin-top:2px;flex-shrink:0;"></i>
                        <div>
                            <p style="font-size:14px;font-weight:700;color:var(--text-color);margin:0 0 4px;">Safe &amp; Comfortable</p>
                            <p style="font-size:13px;color:var(--text-color-2);margin:0;line-height:1.6;">A warm environment where every patient feels at home.</p>
                        </div>
                    </div>

                    <div style="display:flex;align-items:flex-start;gap:12px;padding:16px;border:1px solid #eaeaea;border-radius:12px;background:#fff;">
                        <i class="fa fa-clock" style="font-size:18px;color:var(--accent-color);margin-top:2px;flex-shrink:0;"></i>
                        <div>
                            <p style="font-size:14px;font-weight:700;color:var(--text-color);margin:0 0 4px;">Flexible Scheduling</p>
                            <p style="font-size:13px;color:var(--text-color-2);margin:0;line-height:1.6;">Convenient appointment times to fit your lifestyle.</p>
                        </div>
                    </div>

                </div>

                {{-- CTA Strip --}}
                <div class="sd-cta-strip"
                     style="display:flex;align-items:center;justify-content:space-between;padding:20px 24px;border:1px solid #e5e5e5;border-radius:12px;background:#fafafa;gap:16px;flex-wrap:wrap;">
                    <div>
                        <p style="font-size:14px;font-weight:700;color:var(--text-color);margin:0 0 3px;">Ready to get started?</p>
                        <p style="font-size:13px;color:var(--text-color-2);margin:0;">Book an appointment with our team today.</p>
                    </div>
                    <a href="{{ route('contact') }}"
                       style="font-size:13px;font-weight:700;padding:10px 22px;border-radius:40px;background-color:var(--accent-color);color:#fff;text-decoration:none;white-space:nowrap;flex-shrink:0;">
                        Book Appointment &rarr;
                    </a>
                </div>

            </div>

            {{-- ── RIGHT: Sidebar (25%) ── --}}
            <div class="sd-sidebar">
                <div class="sd-sticky">

                    {{-- Related Services --}}
                    @if($relatedServices && $relatedServices->count() > 0)

                    <p style="font-size:11px;font-weight:700;letter-spacing:0.8px;text-transform:uppercase;color:#aaa;margin:0 0 16px;">
                        Related Services
                    </p>

                    <div style="display:flex;flex-direction:column;gap:2px;">
                        @foreach($relatedServices as $related)
                            @php
                                $relImgSrc = !$related->image_path || str_starts_with($related->image_path, 'assets/')
                                    ? asset($related->image_path ?? 'assets/image/services/service_card_1_2.jpg')
                                    : \Illuminate\Support\Facades\Storage::disk('services_public')->url($related->image_path);
                            @endphp
                            <a href="{{ url('/' . $related->title_slug) }}"
                               style="display:flex;align-items:center;gap:12px;padding:10px;border-radius:8px;text-decoration:none;transition:background 0.2s;"
                               onmouseover="this.style.background='#f5f5f5'"
                               onmouseout="this.style.background='transparent'">
                                <div style="width:52px;height:52px;min-width:52px;border-radius:8px;overflow:hidden;flex-shrink:0;">
                                    <img src="{{ $relImgSrc }}"
                                         alt="{{ $related->title }}"
                                         loading="lazy"
                                         style="width:100%;height:100%;object-fit:cover;display:block;"
                                         onerror="this.onerror=null;this.src='{{ asset('assets/image/services/service_card_1_2.jpg') }}'">
                                </div>
                                <div style="min-width:0;">
                                    <p style="font-size:13px;font-weight:600;color:var(--text-color);margin:0 0 2px;line-height:1.3;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                                        {{ $related->title }}
                                    </p>
                                    <p style="font-size:12px;color:var(--accent-color);margin:0;">Learn more &rarr;</p>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <div style="height:1px;background:#e8e8e8;margin:20px 0;"></div>
                    @endif

                    {{-- View All --}}
                    <a href="{{ route('services') }}"
                       style="display:flex;align-items:center;justify-content:space-between;padding:10px 12px;border:1px solid #eaeaea;border-radius:8px;text-decoration:none;background:#fff;transition:background 0.2s;"
                       onmouseover="this.style.background='#f5f5f5'"
                       onmouseout="this.style.background='#fff'">
                        <span style="font-size:13px;font-weight:600;color:var(--text-color);">
                            <i class="fa fa-th-large" style="color:var(--accent-color);margin-right:8px;"></i>View All Services
                        </span>
                        <i class="fa fa-chevron-right" style="font-size:11px;color:var(--accent-color);"></i>
                    </a>

                    <div style="height:1px;background:#e8e8e8;margin:20px 0;"></div>

                    {{-- Contact Block --}}
                    <div style="padding:18px;border:1px solid #eaeaea;border-radius:12px;background:#fafafa;">
                        <div style="display:flex;align-items:center;gap:10px;margin-bottom:8px;">
                            <i class="fa fa-phone" style="font-size:16px;color:var(--accent-color);"></i>
                            <p style="font-size:13px;font-weight:700;color:var(--text-color);margin:0;">Have a Question?</p>
                        </div>
                        <p style="font-size:12px;color:var(--text-color-2);margin:0 0 14px;line-height:1.6;">
                            Our friendly team is here to help you every step of the way.
                        </p>
                        <a href="{{ route('contact') }}"
                           style="display:block;text-align:center;font-size:13px;font-weight:700;padding:9px 0;border-radius:40px;background-color:var(--accent-color);color:#fff;text-decoration:none;">
                            Contact Us
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>