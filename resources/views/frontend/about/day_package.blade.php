{{-- Day Packages Section --}}
<div style="padding: 4rem 1rem;">
    <div class="r-container" style="max-width: 1100px; margin: 0 auto; display: flex; flex-direction: column; gap: 2.5rem;">

        {{-- Section Header --}}
        <div style="text-align: center;">
            <div style="display: inline-flex; align-items: center; gap: 6px; font-size: 12px; font-weight: 500; letter-spacing: .08em; text-transform: uppercase; color: #1C3F6E; margin-bottom: .75rem;">
                <i class="fa-solid fa-sun" style="font-size: 13px;"></i>
                Day Care
            </div>
            <h3 style="font-size: 1.6rem; font-weight: 600; color: #111827; margin: 0 0 .5rem;">Day Packages</h3>
            <p style="font-size: 14px; color: #6b7280; max-width: 480px; margin: 0 auto; line-height: 1.6;">
                Flexible day care options for those who need support during the day while remaining
                at home in the evenings. Ideal for working families.
            </p>
        </div>

        {{-- Day Package Cards --}}
        @if($dayPackages->isNotEmpty())
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1px; background: #e5e7eb; border: 1px solid #e5e7eb; border-radius: 14px; overflow: hidden;">

            @foreach($dayPackages as $dayPackage)
            <div style="background: #fff; padding: 2rem 1.5rem; display: flex; flex-direction: column; align-items: center; text-align: center; gap: 1.25rem; transition: background .15s;"
                 onmouseover="this.style.background='#EEF2F8'"
                 onmouseout="this.style.background='#fff'">

                {{-- Icon --}}
                <div style="width: 52px; height: 52px; border-radius: 50%; background: #1C3F6E; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <i class="fa-solid fa-sun" style="font-size: 1.1rem; color: #fff;"></i>
                </div>

                {{-- Name --}}
                <p style="font-size: 15px; font-weight: 600; color: #111827; margin: 0;">{{ $dayPackage->name }}</p>

                <div style="height: 1px; background: #f3f4f6; width: 100%;"></div>

                {{-- Price --}}
                <div>
                    <div style="font-size: 1.5rem; font-weight: 700; color: #1C3F6E; line-height: 1.1;">
                        Rs. {{ number_format($dayPackage->price, 0) }}
                    </div>
                    <div style="font-size: 12px; color: #9ca3af; margin-top: 2px;">per day</div>
                </div>

                {{-- CTA --}}
                <div style="width: 100%; margin-top: auto;">
                    <a href="{{ route('contact') }}?package={{ urlencode($dayPackage->name) }}"
                       style="display: flex; align-items: center; justify-content: center; gap: 6px; width: 100%; padding: 10px 16px; font-size: 13px; font-weight: 600; color: #1C3F6E; background: transparent; border: 1.5px solid #1C3F6E; border-radius: 8px; text-decoration: none; box-sizing: border-box; transition: all .15s;"
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
            <i class="fa-solid fa-calendar-day" style="font-size: 2rem; display: block; margin-bottom: .75rem; opacity: .5;"></i>
            <p style="margin: 0; font-size: 14px;">No day packages available at the moment. Please check back soon.</p>
        </div>
        @endif

        {{-- Bottom CTA --}}
        <div style="text-align: center; padding-top: .5rem;">
            <p style="font-size: 14px; color: #6b7280; margin: 0 0 1rem;">Not sure which package is right for you?</p>
            <a href="{{ route('contact') }}"
               style="display: inline-flex; align-items: center; gap: 8px; padding: 11px 24px; font-size: 14px; font-weight: 600; color: #fff; background: #1C3F6E; border: 1.5px solid #1C3F6E; border-radius: 8px; text-decoration: none; transition: all .15s;"
               onmouseover="this.style.background='transparent'; this.style.color='#1C3F6E'"
               onmouseout="this.style.background='#1C3F6E'; this.style.color='#fff'">
                <i class="fa-solid fa-phone" style="font-size: 13px;"></i>
                Talk to Our Team
            </a>
        </div>

    </div>
</div>