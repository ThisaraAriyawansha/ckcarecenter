{{-- Residential Packages Section --}}
<div style="padding: 1rem 1rem;">
    <div class="r-container" style="max-width: 1100px; margin: 0 auto;">

        {{-- Section Header --}}
        <div style="text-align: center; margin-bottom: 2.5rem;">
            <div style="display: inline-flex; align-items: center; gap: 6px; font-size: 12px; font-weight: 500; letter-spacing: .08em; text-transform: uppercase; color: #1C3F6E; margin-bottom: .75rem;">
                <i class="fa-solid fa-heart-pulse" style="font-size: 13px;"></i>
                Our Packages
            </div>
            <h3 style="font-size: 1.6rem; font-weight: 600; color: #111827; margin: 0 0 .5rem;">Residential Care Packages</h3>
            <p style="font-size: 14px; color: #6b7280; max-width: 480px; margin: 0 auto; line-height: 1.6;">
                Choose the care package that best suits your loved one's needs. All packages include
                round-the-clock professional support in a warm, homely environment.
            </p>
        </div>

        {{-- Package Cards --}}
        @if($packages->isNotEmpty())
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1px; background: #e5e7eb; border: 1px solid #e5e7eb; border-radius: 14px; overflow: hidden;">

            @foreach($packages as $package)
            <div style="background: #fff; padding: 1.75rem 1.5rem; display: flex; flex-direction: column; gap: 1.25rem; transition: background .15s;"
                 onmouseover="this.style.background='#EEF2F8'"
                 onmouseout="this.style.background='#fff'">

                {{-- Top accent line --}}
                <div style="height: 2px; background: #1C3F6E; border-radius: 2px; margin: -1.75rem -1.5rem 0; margin-bottom: 0;"></div>

                {{-- Name & Room --}}
                <div>
                    @if($package->room_type)
                    <div style="font-size: 11px; font-weight: 500; letter-spacing: .06em; text-transform: uppercase; color: #9ca3af; margin-bottom: 4px;">
                        {{ ucfirst($package->room_type) }} Room
                    </div>
                    @endif
                    <p style="font-size: 16px; font-weight: 600; color: #111827; margin: 0;">{{ $package->title }}</p>
                </div>

                <div style="height: 1px; background: #f3f4f6;"></div>

                {{-- Price --}}
                <div>
                    <div style="font-size: 1.5rem; font-weight: 700; color: #1C3F6E; line-height: 1.1;">
                        {{ $package->formatted_price_lkr }}
                    </div>
                    <div style="font-size: 12px; color: #9ca3af; margin-top: 2px;">per month</div>
                    @if($package->price_usd && $package->price_usd > 0)
                    <div style="font-size: 12px; color: #9ca3af;">({{ $package->formatted_price_usd }})</div>
                    @endif
                </div>

                {{-- Meta --}}
                <div style="display: flex; flex-direction: column; gap: 6px;">
                    @if($package->sharing_capacity)
                    <div style="display: flex; align-items: center; gap: 8px; font-size: 13px; color: #6b7280;">
                        <i class="fa-solid fa-users" style="font-size: 13px; color: #1C3F6E; width: 16px;"></i>
                        Sharing: {{ $package->sharing_capacity }} {{ $package->sharing_capacity === 1 ? 'person' : 'persons' }}
                    </div>
                    @endif
                    @if($package->bathroom_type)
                    <div style="display: flex; align-items: center; gap: 8px; font-size: 13px; color: #6b7280;">
                        <i class="fa-solid fa-bath" style="font-size: 13px; color: #1C3F6E; width: 16px;"></i>
                        {{ $package->getBathroomTypes()[$package->bathroom_type] ?? ucfirst($package->bathroom_type) }}
                    </div>
                    @endif
                </div>

                <div style="height: 1px; background: #f3f4f6;"></div>

                {{-- Features --}}
                @if($package->features->isNotEmpty())
                <div style="display: flex; flex-direction: column; gap: 6px; flex: 1;">
                    @foreach($package->features as $feature)
                    <div style="display: flex; align-items: flex-start; gap: 8px; font-size: 13px; color: #6b7280; line-height: 1.5;">
                        <i class="fa-solid fa-circle-check" style="font-size: 13px; color: #1C3F6E; margin-top: 2px; flex-shrink: 0;"></i>
                        {{ $feature->feature }}
                    </div>
                    @endforeach
                </div>
                @endif

                {{-- CTA --}}
                <div style="margin-top: auto;">
                    <a href="{{ route('contact') }}?package={{ urlencode($package->title) }}"
                       style="display: flex; align-items: center; justify-content: center; gap: 6px; width: 100%; padding: 10px 16px; font-size: 13px; font-weight: 600; color: #1C3F6E; background: transparent; border: 1.5px solid #1C3F6E; border-radius: 8px; text-decoration: none; transition: all .15s; box-sizing: border-box;"
                       onmouseover="this.style.background='#1C3F6E'; this.style.color='#fff'"
                       onmouseout="this.style.background='transparent'; this.style.color='#1C3F6E'">
                        <i class="fa-solid fa-paper-plane" style="font-size: 12px;"></i>
                        Make an Inquiry
                    </a>
                </div>

            </div>
            @endforeach

        </div>
        @else
        <div style="text-align: center; padding: 4rem 1rem; color: #9ca3af;">
            <i class="fa-solid fa-box-open" style="font-size: 2rem; display: block; margin-bottom: .75rem; opacity: .5;"></i>
            <p style="margin: 0; font-size: 14px;">No packages available at the moment. Please check back soon.</p>
        </div>
        @endif

    </div>
</div>