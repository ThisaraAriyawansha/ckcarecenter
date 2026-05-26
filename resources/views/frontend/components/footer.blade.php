    <footer>
        <div class="section py-5">
            <div class="d-flex flex-column gap-3 p-5 bg-text-color rounded-4 text-white">
                <div class="row row-cols-xl-2 row-cols-1 align-items-center">
                    <div class="col col-xl-8 mb-3">
                        <div class="d-flex flex-column gap-5">
                            <img src="{{ asset('assets/image/logo/logo3.webp') }}" alt="" class="img-fluid" width="350" style="filter: brightness(0) invert(1);">
                            <p class="text-white" style="max-width: 550px;">
                                C & K Home Nursing and Care Center is dedicated to delivering compassionate, professional
                                home nursing and elderly care services across Sri Lanka - bringing quality healthcare
                                right to your doorstep.
                            </p>
                        </div>
                    </div>
                    <div class="col col-xl-4 mb-3">
                        <div class="row row-cols-xl-2 row-cols-1">
                            <div class="co mb-3">
                                <div class="d-flex flex-column gap-3">
                                    <h4>Address</h4>
                                    <div class="d-flex flex-row font-2 gap-3" style="max-width: 250px;">
                                        <i class="rtmicon rtmicon-location fs-4"></i>
                                        <span>No. 45, Peradeniya Road, Kandy 20000, Sri Lanka</span>
                                    </div>
                                    <div class="social-container team mb-xl-0 mb-3 gap-2">
                                        <a href="https://www.facebook.com" class="social-item-3">
                                            <i class="fa-brands fa-xs fa-facebook-f"></i>
                                        </a>
                                        <a href="https://wa.me/94771234567" class="social-item-3">
                                            <i class="fa-brands fa-xs fa-whatsapp"></i>
                                        </a>
                                        <a href="https://www.instagram.com" class="social-item-3">
                                            <i class="fa-brands fa-xs fa-instagram"></i>
                                        </a>
                                        <a href="https://www.youtube.com" class="social-item-3">
                                            <i class="fa-brands fa-xs fa-youtube"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-3">
                                <div class="d-flex flex-column gap-3">
                                    <h4>Contact Us</h4>
                                    <div class="d-flex flex-column gap-3">
                                        <div class="d-flex flex-row align-items-center font-2 gap-3">
                                            <i class="rtmicon rtmicon-classic-phone  fs-4"></i>
                                            <span>+94 77 123 4567</span>
                                        </div>
                                        <div class="d-flex flex-row align-items-center font-2 gap-3">
                                            <i class="rtmicon rtmicon-classic-phone  fs-4"></i>
                                            <span>+94 81 234 5678</span>
                                        </div>
                                        <div class="d-flex flex-row align-items-center font-2 gap-3">
                                            <i class="rtmicon rtmicon-envelope fs-4"></i>
                                            <span>info@ckhomenursing.lk</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="border-1 border-light" style="opacity: 1;">
                <div class="d-flex flex-xl-row flex-column gap-3 align-items-xl-center align-items-start justify-content-between">
                    <div class="d-flex flex-xl-row flex-wrap gap-3 gap-xl-5">
                        <div>
                            <a href="{{ route('home') }}" class="link d-flex flex-row gap-3 align-items-center">
                                Home
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('about') }}" class="link d-flex flex-row gap-3 align-items-center">
                                About Us
                            </a>
                        </div>
                        <div>
                            <a href="" class="link d-flex flex-row gap-3 align-items-center">
                                Services
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('contact') }}" class="link d-flex flex-row gap-3 align-items-center">
                                Contact Us
                            </a>
                        </div>
                    </div>
                    <span class="text-white fs-6 font-2 text-xl-end text-start">
                        Copyright &copy; {{ date('Y') }} C & K Home Nursing and Care Center. All Rights Reserved.
                        <span style="font-size: 12px; text-transform: none; display: block; margin-top: 4px;">
                            Design &amp; Developed by
                            <a href="https://creatxsoftware.com/" target="_blank" rel="noopener noreferrer" style="text-decoration: none; font-size: 12px; color: #ffffff;">
                                CreatX Software
                            </a>
                        </span>
                    </span>
                </div>
            </div>
        </div>
    </footer>