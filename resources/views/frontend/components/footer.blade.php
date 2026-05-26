<footer class="section-dark">
            <div class="container">
                <div class="row gx-5">
                    <div class="col-lg-4 col-sm-6">
                        <img class="logo-main" src="assets/img/logo/care365_light.svg" alt="" loading="lazy"
                            style="max-height: 15vh; width: auto; height: auto; ">
                        <div class="spacer-20"></div>
                        <!--
                        <h5 class="text-white mb-3">Newsletter</h5>
                        <p style="color: rgba(255,255,255,0.5); font-size: 0.95rem; line-height: 1.4; margin: 0 0 15px 0;">
                            Care tips, updates & availability — straight to your inbox
                        </p>
                        
                        <form action="#" method="post" style="margin: 0;">
                            <div style="max-width: 320px;">
                                <div style="display: flex; border: 1px solid #6c757d; border-radius: 999px; overflow: hidden; background: transparent;">
                                    <input type="email" placeholder="Your email"
                                        style="flex: 1; padding: 8px 14px; font-size: 0.875rem; background: transparent; border: none; color: white; outline: none; min-width: 0;"
                                        required>
                                    <button type="submit"
                                            style="padding: 8px 18px; font-size: 0.875rem; font-weight: 500; color: white; background: transparent; border: none; cursor: pointer; white-space: nowrap;">
                                        Subscribe
                                    </button>
                                </div>
                            </div>
                        </form>
                            -->
                         <p>
                            At Care 365, we provide compassionate, personalized senior care in a warm and welcoming environment. Our dedicated team ensures comfort, safety, and dignity, treating every resident like family.
                        </p>
                        <div class="social-icons mb-sm-30 mt-4">
                            <a href="https://www.facebook.com/Care36t5/" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a>
                            <a href="https://www.instagram.com/carethreesixtyfive?utm_source=qr&igsh=MTRkNHhuNWx2ZDd6cw%3D%3D" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                            <a href="https://wa.me/94776604040" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp">
                                <i class="fa-brands fa-whatsapp"></i>
                            </a>

                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12 order-lg-1 order-sm-2">
                        <div class="row"> 
                            <div class="col-lg-4 col-sm-6">
                                <div class="widget">
                                    <h3 style="color: #ffffff;">Quick Links</h3>
                                    <ul>
                                        <li><a href="{{ route('home') }}">Home</a></li>
                                        <li><a href="{{ route('services') }}">Our Services</a></li>
                                        <li><a href="{{ route('gallery') }}">Gallery</a></li>
                                        <li><a href="{{ route('about') }}">About Us</a></li>
                                        <li><a href="{{ route('blog') }}">Blog</a></li>
                                        <li><a href="{{ route('howitworks') }}">How It Works</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-8 col-sm-6">
                                <div class="widget">
                                    <h3 style="color: #ffffff;">Our Services</h3>
                                    <ul>
                                        @foreach($footer_services as $service)
                                        <li><a href="{{ service_url($service) }}">{{ $service->title }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 order-lg-2 order-sm-1">
                        <div class="widget">
                            <h3 style="color: #ffffff;">Contact Info</h3>


                            <div class="fw-bold text-white"><i class="icofont-ui-call me-2 id-color-2"></i>Call / WhatsApp</div>
                            <a href="tel:+94776604040" class="text-white footer-contact-link">+94 77 660 40 40</a><br>
                            <a href="https://wa.me/94779191818" class="text-white footer-contact-link">+94 779 191 818 (WhatsApp)</a>

                            <div class="spacer-20"></div>

                            <div class="fw-bold text-white"><i class="icofont-envelope me-2 id-color-2"></i>Email</div>
                            <a href="mailto:info@care36t5.com" class="text-white footer-contact-link">info@care36t5.com</a>
                            <div class="spacer-20"></div>

                            <div class="fw-bold text-white"><i class="icofont-location-pin me-2 id-color-2"></i>Office Location</div>
                            407 C1, Nomis Weragala Mw, Hokandara South,<br>
                            Thalawathugoda, Sri Lanka.
                        </div>
                    </div>
                </div>
            </div>
            <div class="subfooter">
                <div class="container">
                    <div class="row g-4">
                        <div class="col-md-12">
                            <div class="de-flex">
                                <div class="col-lg-5 col-12">
                                    <p class="copyright mb-1">Copyright &copy; <?= date('Y') ?> Care365. All rights reserved.</p>
                                    <p style="color: #999; font-size: 13px; ">
                                        Design &amp; Developed by 
                                        <a href="https://creatxsoftware.com/" target="_blank" rel="noopener noreferrer" 
                                        style="color: #999; text-decoration: none; font-weight: 500; transition: color 0.3s ease;">
                                            CreatX Software
                                        </a>
                                    </p>
                                </div>
                                <ul class="menu-simple">
                                    <li><a href="{{ route('termsconditions') }}">Terms &amp; Conditions</a></li>
                                    <li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="whatsapp-chat-widget">
                    <!-- WhatsApp Button -->
                    <div class="whatsapp-btn" id="whatsappBtn">
                        <div class="whatsapp-icon">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <span class="whatsapp-text">Chat with us</span>
                    </div>
                    
                    <!-- Chat Box -->
                    <div class="whatsapp-chat-box" id="whatsappChatBox">
                        <div class="chat-header">
                            <div class="header-left">
                                <div class="chat-avatar">
                                    <img src="assets/img/logo2.png" alt="Care 365 Logo" onerror="this.src='https://via.placeholder.com/40/25D366/FFFFFF?text=C365'">
                                </div>
                                <div class="chat-info">
                                    <h4>Care 365 Support</h4>
                                    <p class="status">Welcome to CARE365!</p>
                                </div>
                            </div>
                            <button class="close-chat" id="closeChat">×</button>
                        </div>
                        
                        <div class="chat-body">
                            <div class="message received">
                                <div class="message-content" style="color:#555;">
                                    <strong>Caring for Golden Years - Care365</strong><br><br>
                                    Welcome to CARE365!<br><br>
                                    Hello! Thank you for reaching out to us on WhatsApp. How can we assist you today?
                                </div>
                                <div class="message-time">Just now</div>
                            </div>
                            
                            <div class="message received">
                                <div class="message-content" style="color:#555;">
                                    Our staff is available 24/7 to provide support and assistance whenever you need it. Our qualified and compassionate team ensures your loved ones are in capable hands.
                                </div>
                                <div class="message-time">Just now</div>
                            </div>
                        </div>
                        
                        <div class="chat-footer">
                            <div class="chat-cta">
                                <a href="https://wa.me/94779191818?text=Hello!%20I'm%20interested%20in%20learning%20more%20about%20Care365%20services." 
                                target="_blank" class="whatsapp-cta-btn">
                                    <i class="fab fa-whatsapp"></i> Start Conversation
                                </a>
                                <p class="cta-note">Click to open WhatsApp and chat directly with our team</p>
                            </div>
                        </div>
                    </div>
                </div>

            
        </footer>


        @include('frontend.components.whatsapp')


<style>
    /* Improve link contrast in footer */
    .footer-contact-link {
        color: #ffffff !important; /* Ensure white color */
        text-decoration-thickness: 1px !important;
        text-underline-offset: 3px !important;
        font-weight: 500 !important;
    }

    /* Optional: Add hover effect */
    .footer-contact-link:hover {
        opacity: 0.9;
        text-decoration-thickness: 2px !important;
    }

    /* If the background is too dark, consider making links slightly off-white */
    .footer-contact-link {
        color: #f0f0f0 !important; /* Slightly off-white for better contrast */
    }
</style>

