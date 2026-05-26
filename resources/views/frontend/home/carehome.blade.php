<section class="bg-white space overflow-hidden team-area-1 border-top" id="homes" style="padding: 100px 0;">
    <div class="container">
        <div class="row justify-content-between align-items-center" style="margin-bottom: 60px;">
            <div class="col-xxl-7 col-xl-7 col-md-8">

                <div class="relative z-1000">
                    <div class="subtitle wow fadeInUp" data-wow-delay=".0s">Our Homes</div>
                    <h2>Designed with Modern Comforts and Amenities</h2>
                    <p style="color: #334155;">Exciting times are ahead as Care365 prepares to open our brand-new, state-of-the-art facility in Sri Lanka.</p>
                </div>
            </div>
            
        </div>
        
        @if($carehomes->count() > 0)
        <div class="row gy-40">
            <!-- Left Navigation -->
            <div class="col-xl-4">
                <div class="team-nav-wrap" style="background: #F8FAFC; border-radius: 12px; padding: 20px;">
                    <ul class="nav nav-tabs wow fadeinup" id="myTab" role="tablist" style="
                        display: flex;
                        flex-direction: column;
                        gap: 12px;
                        border: none;
                    ">
                        @foreach($carehomes as $index => $carehome)
                        <li class="nav-item" role="presentation" data-cue="slideInUp" style="border: none;">
                            <button class="nav-link {{ $index === 0 ? 'active' : '' }}" 
                                    id="team_{{ $carehome->id }}-tab" 
                                    data-bs-toggle="tab" 
                                    data-bs-target="#team_{{ $carehome->id }}" 
                                    type="button" 
                                    role="tab" 
                                    aria-controls="team_{{ $carehome->id }}" 
                                    aria-selected="{{ $index === 0 ? 'true' : 'false' }}"
                                    style="
                                        display: flex;
                                        align-items: center;
                                        gap: 16px;
                                        padding: 16px;
                                        background: #ffffff;
                                        border: 2px solid transparent;
                                        border-radius: 10px;
                                        width: 100%;
                                        text-align: left;
                                        transition: all 0.3s ease;
                                        cursor: pointer;
                                    ">
                                <span class="team-thumb-sm" style="
                                    width: 60px;
                                    height: 60px;
                                    border-radius: 8px;
                                    overflow: hidden;
                                    flex-shrink: 0;
                                ">
                                    @if($carehome->image_path)
                                    <img src="{{ asset('care_homes_img/' . pathinfo($carehome->image_path, PATHINFO_FILENAME) . '.webp') }}" 
                                         alt="{{ $carehome->title }}"
                                         width="60" height="60"
                                         style="width: 100%; height: 100%; object-fit: cover;" loading="lazy">
                                    @else
                                    <img src="{{ asset('assets/img/care-home/home-placeholder.webp') }}" 
                                         alt="{{ $carehome->title }}"
                                         width="60" height="60"
                                         style="width: 100%; height: 100%; object-fit: cover;" loading="lazy">
                                    @endif
                                </span>
                                <span class="content-wrap" style="flex: 1;">
                                    <span class="box-title" style="
                                        display: block;
                                        font-size: 16px;
                                        font-weight: 600;
                                        color: #0F172A;
                                        margin-bottom: 4px;
                                    ">{{ $carehome->title }}</span>
                                    <span class="desi" style="
                                        display: block;
                                        font-size: 13px;
                                        color: #475569;
                                    ">{{ $carehome->subtitle }}</span>
                                </span>
                            </button>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            
            <!-- Right Content - One Row Layout -->
            <div class="col-xl-8">
                <div class="team-content-wrap">
                    <div class="tab-content" id="myTabContent">
                        @foreach($carehomes as $index => $carehome)
                        <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}" 
                             id="team_{{ $carehome->id }}" 
                             role="tabpanel" 
                             aria-labelledby="team_{{ $carehome->id }}-tab" 
                             data-cue="slideInUp">
                            <div class="team-tab-content" style="
                                background: #ffffff;
                                border-radius: 12px;
                                padding: 32px;
                                border: 1px solid #E2E8F0;
                            ">
                                <!-- One Row Layout -->
                                <div style="display: flex; gap: 32px; align-items: flex-start;">
                                    
                                    <!-- Image - Left Side (Smaller) -->
                                    <div style="flex-shrink: 0; width: 280px;">
                                        @if($carehome->image_path)
                                            <img 
                                                src="{{ asset('care_homes_img/' . pathinfo($carehome->image_path, PATHINFO_FILENAME) . '.webp') }}"
                                                loading="lazy" 
                                                alt="{{ $carehome->title }}"
                                                width="280" height="280"
                                                style="
                                                    border-radius: 10px;
                                                    width: 100%;
                                                    height: 280px;
                                                    object-fit: cover;
                                                "
                                            >
                                        @else
                                            <img 
                                                src="{{ asset('assets/img/care-home/home-placeholder.webp') }}"
                                                loading="lazy" 
                                                alt="{{ $carehome->title }}"
                                                width="280" height="280"
                                                style="
                                                    border-radius: 10px;
                                                    width: 100%;
                                                    height: 280px;
                                                    object-fit: cover;
                                                "
                                            >
                                        @endif
                                    </div>

                                    <!-- Content - Right Side -->
                                    <div class="team-content" style="flex: 1; min-width: 0;">
                                        
                                        <!-- Title & Badge -->
                                        <div style="margin-bottom: 16px;">
                                            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                                                <h3 style="
                                                    font-size: 24px;
                                                    font-weight: 700;
                                                    color: #0F172A;
                                                    margin: 0;
                                                    letter-spacing: -0.5px;
                                                ">{{ $carehome->title }}</h3>
                                                
                                                @if($carehome->badge_text)
                                                <span style="
                                                    background-color: #EFF6FF;
                                                    border: 1px solid #2563EB;
                                                    color: #1E40AF;
                                                    padding: 4px 12px;
                                                    border-radius: 16px;
                                                    font-size: 12px;
                                                    font-weight: 600;
                                                    white-space: nowrap;
                                                ">{{ $carehome->badge_text }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <!-- Description & Location -->
                                        <div style="margin-bottom: 20px;">
                                            <p style="
                                                font-size: 14px;
                                                color: #475569;
                                                line-height: 1.6;
                                                margin-bottom: 10px;
                                            ">{{ $carehome->description }}</p>
                                            
                                            @if($carehome->location)
                                            <p style="
                                                font-size: 14px;
                                                color: #475569;
                                                margin-bottom: 0;
                                                display: flex;
                                                align-items: center;
                                                gap: 6px;
                                            ">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#1E40AF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                                    <circle cx="12" cy="10" r="3"></circle>
                                                </svg>
                                                <span style="color: #0F172A; font-weight: 500;">{{ $carehome->location }}</span>
                                            </p>
                                            @endif
                                        </div>
                                        
                                        <!-- Actions Row -->
                                        <div style="
                                            display: flex;
                                            align-items: center;
                                            gap: 16px;
                                            flex-wrap: wrap;
                                            margin-bottom: 16px;
                                        ">
                                            <!-- Contact Button -->
                                            <a href="{{ route('contact') }}" style="
                                                display: inline-flex;
                                                align-items: center;
                                                gap: 6px;
                                                padding: 8px 16px;
                                                background-color: #ffffff;
                                                color: #1E40AF;
                                                text-decoration: none;
                                                border-radius: 6px;
                                                font-weight: 600;
                                                font-size: 13px;
                                                border: 2px solid #2563EB;
                                                transition: all 0.3s ease;
                                            ">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#1E40AF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                                </svg>
                                                @if($carehome->contact_no)
                                                    {{ $carehome->contact_no }}
                                                @else
                                                    Contact Us
                                                @endif
                                            </a>
                                            
                                            <!-- Gallery Link -->
                                            <a href="{{ route('gallery') }}" 
                                               class="gallery-link" 
                                               onclick="setGalleryFilter('{{ $carehome->title }}'); return true;"
                                               style="
                                                   display: inline-flex;
                                                   align-items: center;
                                                   gap: 6px;
                                                   color: #1E40AF;
                                                   text-decoration: none;
                                                   font-size: 14px;
                                                   font-weight: 500;
                                                   transition: all 0.3s ease;
                                               ">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" 
                                                     viewBox="0 0 16 16">
                                                    <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                                                    <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z"/>
                                                </svg>
                                                View Gallery
                                            </a>
                                        </div>
                                        
                                        <!-- Social Links -->
                                        @if($carehome->facebook_url || $carehome->instagram_url)
                                        <div style="
                                            display: flex;
                                            align-items: center;
                                            gap: 8px;
                                        ">
                                            <span style="
                                                font-size: 13px;
                                                color: #475569;
                                                margin-right: 4px;
                                            ">Follow us:</span>
                                            
                                            @if($carehome->facebook_url)
                                            <a href="{{ $carehome->facebook_url }}" target="_blank" style="
                                                display: flex;
                                                align-items: center;
                                                justify-content: center;
                                                width: 32px;
                                                height: 32px;
                                                background-color: #EFF6FF;
                                                color: #1E40AF;
                                                border-radius: 6px;
                                                text-decoration: none;
                                                transition: all 0.3s ease;
                                                font-size: 14px;
                                            ">
                                                <i class="fab fa-facebook-f"></i>
                                            </a>
                                            @endif
                                            
                                            @if($carehome->instagram_url)
                                            <a href="{{ $carehome->instagram_url }}" target="_blank" style="
                                                display: flex;
                                                align-items: center;
                                                justify-content: center;
                                                width: 32px;
                                                height: 32px;
                                                background-color: #EFF6FF;
                                                color: #1E40AF;
                                                border-radius: 6px;
                                                text-decoration: none;
                                                transition: all 0.3s ease;
                                                font-size: 14px;
                                            ">
                                                <i class="fab fa-instagram"></i>
                                            </a>
                                            @endif
                                        </div>
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="text-center" style="padding: 60px 0;">
            <div class="alert alert-info" style="
                background-color: #EFF6FF;
                border: 1px solid #BFDBFE;
                color: #1E40AF;
                padding: 20px 30px;
                border-radius: 12px;
                display: inline-block;
            ">
                <p style="margin: 0; font-size: 15px;">Care homes information will be available soon.</p>
            </div>
        </div>
        @endif
    </div>
</section>

<style>
/* Subtitle - ensure proper contrast */
.subtitle {
    color: #1E293B;
}

/* Active Tab Styling */
.nav-link.active {
    border-color: #2563EB !important;
    background-color: #EFF6FF !important;
}

/* Hover Effects */
.nav-link:not(.active):hover {
    background-color: #F8FAFC !important;
    border-color: #CBD5E1 !important;
}



a.gallery-link:hover {
    color: #1E40AF !important;
    text-decoration: underline !important;
}



/* Responsive Design */
@media (max-width: 1199px) {
    .col-xl-4, .col-xl-8 {
        width: 100%;
    }
    
    .team-nav-wrap {
        margin-bottom: 30px;
    }
}

@media (max-width: 768px) {
    .sec-title {
        font-size: 32px !important;
    }
    
    .team-tab-content {
        padding: 20px !important;
    }
    
    /* Stack layout on mobile */
    div[style*="display: flex; gap: 32px"] {
        flex-direction: column !important;
        gap: 20px !important;
    }
    
    div[style*="width: 280px"] {
        width: 100% !important;
    }
    
    div[style*="height: 280px"] {
        height: 200px !important;
    }
    
    .nav-link {
        padding: 12px !important;
    }
    
    .team-thumb-sm {
        width: 50px !important;
        height: 50px !important;
    }
}
</style>

<script>
// Function to set gallery filter using title
function setGalleryFilter(title) {
    console.log('Setting gallery filter for title:', title);
    
    // Store the title in localStorage
    localStorage.setItem('galleryFilterLocation', title);
    localStorage.setItem('galleryFilterTime', Date.now());
}

// Auto-attach to all gallery links
document.addEventListener('DOMContentLoaded', function() {
    const galleryLinks = document.querySelectorAll('a.gallery-link');
    
    galleryLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const onclickAttr = this.getAttribute('onclick');
            if (onclickAttr) {
                const match = onclickAttr.match(/setGalleryFilter\('([^']+)'\)/);
                if (match && match[1]) {
                    const title = match[1];
                    
                    // Store the title in localStorage
                    localStorage.setItem('galleryFilterLocation', title);
                    localStorage.setItem('galleryFilterTime', Date.now());
                    
                    // Navigate to gallery page
                    window.location.href = this.getAttribute('href');
                }
            }
        });
    });
});
</script>