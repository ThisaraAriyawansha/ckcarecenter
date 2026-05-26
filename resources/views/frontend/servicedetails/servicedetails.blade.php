<section class="relative overflow-hidden" style="padding: 60px 0;">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-6">
                <!-- Service Image -->
                <div style="margin-bottom: 2rem; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                    <img src="{{ asset('services_img/' . pathinfo($service->image_path, PATHINFO_FILENAME) . '.webp') }}" 
                         alt="{{ $service->title }}" 
                         style="width: 100%; height: 400px; object-fit: cover; display: block;"
                         width="800" height="400">
                </div>

                <h2 style="margin-bottom: 1.5rem; color: #1e3a8a; font-weight: 700; font-size: 2rem;">{{ $service->title }}</h2>

                <div style="margin: 2rem 0;"></div>

                <h3 style="margin-bottom: 1.5rem; color: #1e3a8a; font-weight: 600; font-size: 1.5rem; border-left: 4px solid #fbbf24; padding-left: 1rem;">Service Overview</h3>
                <p style="color: #4b5563; line-height: 1.8; font-size: 1rem; text-align: justify;">
                    {{ $service->description }}
                </p>
                 <a class="btn-main bg-color-2  mb-3 wow fadeInUp" 
                       data-wow-delay=".6s" 
                       href="tel:+94776604040">
                        Start the Admission Process 
                    </a>
            </div>

            <div class="col-lg-6">
                <!-- Quick Contact Card -->
                <div style="background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 8px 25px rgba(0,0,0,0.1); border: 2px solid #e5e7eb; margin-bottom: 2rem;">
                    
                    <!-- Logo Section -->
                    <div style="background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%); padding: 2rem; text-align: center;">
                        <img src="{{ asset('assets/img/logo3.png') }}" 
                             alt="Company Logo" 
                             style="max-width: 160px; width: 100%; height: auto; filter: brightness(0) invert(1);"
                             width="160" height="117">
                    </div>

                    <!-- Content Section -->
                    <div style="padding: 2.5rem;">
                        
                        <!-- Call to Action -->
                        <div style="text-align: center; margin-bottom: 2rem;">
                            <h3 style="color: #1e3a8a; font-size: 1.5rem; font-weight: 700; margin-bottom: 0.5rem;">Ready to Get Started?</h3>
                            <p style="color: #6b7280; font-size: 1rem; margin: 0;">Contact us now for a free consultation</p>
                        </div>


                        <div style="background: #f0f9ff; padding: 1.5rem; border-radius: 8px; text-align: center; margin-bottom: 1.5rem; border-left: 4px solid #3b82f6;">
                            <p style="color: #6b7280; font-size: 0.875rem; margin-bottom: 0.5rem;">Call Us Anytime</p>
                            <a href="tel:+94776604040" style="color: #1e3a8a; text-decoration: none; font-size: 1.5rem; font-weight: 700; display: block;">
                                <i class="fa fa-phone" style="margin-right: 0.5rem; color: #3b82f6; font-size: 1.25rem;"></i>+9477 660 40 40
                            </a>
                        </div>

                        <!-- Features List -->
                        <div style="display: flex; flex-direction: column; gap: 1rem;">
                            <div style="display: flex; align-items: center; gap: 1rem; padding: 1rem; background: #f9fafb; border-radius: 8px;">
                                <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%); border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fa fa-check" style="color: #fff; font-size: 1.25rem;"></i>
                                </div>
                                <div>
                                    <p style="margin: 0; color: #1e3a8a; font-weight: 600; font-size: 0.95rem;">Professional Team</p>
                                    <p style="margin: 0; color: #6b7280; font-size: 0.85rem;">Experienced & Certified</p>
                                </div>
                            </div>

                            <div style="display: flex; align-items: center; gap: 1rem; padding: 1rem; background: #f9fafb; border-radius: 8px;">
                                <div style="width: 40px; height: 40px; background:#48b1fb; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fa fa-clock-o" style="color: white; font-size: 1.25rem;"></i>
                                </div>
                                <div>
                                    <p style="margin: 0; color: #1e3a8a; font-weight: 600; font-size: 0.95rem;">Quick Response</p>
                                    <p style="margin: 0; color: #6b7280; font-size: 0.85rem;">Same Day Service Available</p>
                                </div>
                            </div>

                            <div style="display: flex; align-items: center; gap: 1rem; padding: 1rem; background: #f9fafb; border-radius: 8px;">
                                <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%); border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fa fa-shield" style="color: #fff; font-size: 1.25rem;"></i>
                                </div>
                                <div>
                                    <p style="margin: 0; color: #1e3a8a; font-weight: 600; font-size: 0.95rem;">100% Satisfaction</p>
                                    <p style="margin: 0; color: #6b7280; font-size: 0.85rem;">Quality Guaranteed</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Related Services Section -->
        <div class="row" style="margin-top: 5rem;">
            <div class="col-12" style="text-align: center; margin-bottom: 3rem;">
                <h3 style="font-size: 2rem; font-weight: 700; color: #1e3a8a; position: relative; display: inline-block; padding-bottom: 1rem;">
                    Related Services
                    <span style="position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); width: 80px; height: 4px; background: linear-gradient(90deg, #3b82f6 0%, #fbbf24 100%); border-radius: 2px;"></span>
                </h3>
            </div>
        </div>
        <div class="row g-4">
            @foreach($relatedServices as $relatedService)
            <div class="col-lg-4 col-md-6">
                <div style="height: 100%; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.08); border-radius: 12px; overflow: hidden; background-color: #fff; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                    <div style="position: relative; overflow: hidden;">
                        <img src="{{ asset('services_img/' . pathinfo($relatedService->image_path, PATHINFO_FILENAME) . '.webp') }}" 
                             alt="{{ $relatedService->title }}"
                             style="width: 100%; height: 220px; object-fit: cover; display: block; transition: transform 0.3s ease;"
                             width="400" height="220">
                        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(to bottom, transparent 0%, rgba(30, 58, 138, 0.7) 100%);"></div>
                    </div>
                    <div style="padding: 2rem 1.5rem;">
                        <h5 style="margin-bottom: 1rem; font-size: 1.25rem; font-weight: 600; color: #1e3a8a; line-height: 1.4;">{{ $relatedService->title }}</h5>
                        <p style="margin-bottom: 1.5rem; color: #6b7280; line-height: 1.6; font-size: 0.95rem;">{{ Str::limit($relatedService->description, 100) }}</p>
                            <a href="{{ url('/' . $relatedService->title_slug) }}" 
                            style="display: inline-block; padding: 0.75rem 1.75rem; background: #48b1fb; color: #fff; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 0.95rem; box-shadow: 0 3px 10px rgba(72, 177, 251, 0.3); transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;"
                            onmouseover="this.style.background='#0A3F87'; this.style.boxShadow='0 5px 15px rgba(10, 63, 135, 0.4)'; this.style.transform='translateY(-2px)';"
                            onmouseout="this.style.background='#48b1fb'; this.style.boxShadow='0 3px 10px rgba(72, 177, 251, 0.3)'; this.style.transform='translateY(0)';">Learn More →</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>