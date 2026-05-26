

<section class="border-top" id="Care-Team">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-6 offset-lg-3 text-center">
                <div class="section-header">
                    <div class="subtitle">Meet Our Team</div>
                    <h2>Management & Team</h2>
                    <p class="section-description">
                        Our dedicated professionals committed to exceptional care 
                    </p>
                </div>
            </div>
        </div>
        
        <div class="row g-4 justify-content-center">
            @forelse ($teamMembers as $member)
                <div class="col-lg-3 col-md-6">
                    <div style="background: #ffffff; border-radius: 12px; overflow: hidden; transition: all 0.4s ease; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); height: 100%; display: flex; flex-direction: column; cursor: pointer;"
                         onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)';"
                         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)';">
                        
                        <div style="position: relative; width: 100%; height: 320px; overflow: hidden; background: #f8fafc;">
                            @if ($member->image_path)
                                <img src="{{ asset('team_img/' . $member->image_path) }}"
                                     style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease;"
                                     onmouseover="this.style.transform='scale(1.08)';"
                                     onmouseout="this.style.transform='scale(1)';"
                                     alt="{{ $member->name }}"
                                     loading="lazy">
                            @else
                                <img src="{{ asset('assets/images/team/placeholder.jpg') }}"
                                     style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease;"
                                     onmouseover="this.style.transform='scale(1.08)';"
                                     onmouseout="this.style.transform='scale(1)';"
                                     alt="Team Member"
                                     loading="lazy">
                            @endif
                            <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 60px; background: linear-gradient(to top, rgba(0,0,0,0.3), transparent); pointer-events: none;"></div>
                        </div>

                        <div style="padding: 24px 20px; text-align: center; flex: 1; display: flex; flex-direction: column; justify-content: center; min-height: 140px;">
                            <h4 style="font-size: 18px; font-weight: 600; color: #0F172A; margin: 0 0 6px 0; line-height: 1.4;">
                                {{ $member->name }}
                            </h4>
                            <p style="font-size: 13px; font-weight: 500; color: #3B82F6; margin: 0 0 10px 0; text-transform: uppercase; letter-spacing: 0.5px;">
                                {{ $member->position ?? 'Team Member' }}
                            </p>
                            <p style="font-size: 14px; color: #64748B; margin: 0; line-height: 1.6;">
                                {{ Str::limit($member->bio, 80) }}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p style="color: #94a3b8; font-size: 16px;">Our team members will appear here soon!</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- CTA Section -->
                    <!-- CTA Section -->
            <div style="text-align: center; background: #ffffff; padding: 5px 3px; margin-top: 50px;">
                <h3 style="font-size: 26px; font-weight: 600; color: #0F172A; margin: 0 0 12px 0;">Ready to Meet Our Team?</h3>
                <p style="font-size: 15px; color: #64748B; margin: 0 0 25px 0; max-width: 480px; margin-left: auto; margin-right: auto; line-height: 1.6;">
                    Visit us and experience the exceptional care our team provides
                </p>
                    <a class="btn-main bg-color-2  mb-3 wow fadeInUp" 
                       data-wow-delay=".6s" 
                       href="{{ route('lead-form') }}">
                        Book a Visit 
                    </a>
            </div>
</section>