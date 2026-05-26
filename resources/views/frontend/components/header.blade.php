<header class="sticky-top bg-accent-primary">
        <div class="r-container">
            <nav class="navbar navbar-expand-xl">
                <div class="container-fluid ps-3">
                    <div class="logo-container">
                        <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('assets/image/logo/logo3.webp') }}" alt="" class="img-fluid" ></a>
                    </div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa-solid fa-bars-staggered accent-color-2"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav mx-auto mb-2 mb-xl-0 gap-xl-4 gap-1">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    About
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('about') }}">About Us</a></li>
                                    <li><a class="dropdown-item" href="#">Team</a></li>
                                </ul>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{ route('services') }}">Services</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    More
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('faq') }}">FAQs</a></li>
                                    <li><a class="dropdown-item" href="member.html">Membership</a></li>
                                    <li><a class="dropdown-item" href="testimonial.html">Testimonials</a></li>
                                    <li><a class="dropdown-item" href="404.html">404 Error</a></li>
                                    <li><a class="dropdown-item" href="location.html">Detail Location</a></li>
                                    <li><a class="dropdown-item" href="blog.html">Last Article</a></li>
                                    <li><a class="dropdown-item" href="single_blog.html">Single Post</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="contact.html">Contact Us</a>
                            </li>
                        </ul>
                        <div class="mb-xl-0 mb-3">
                            <a href="contact.html"
                                class="btn btn-accent-outline d-flex flex-row rounded-pill gap-2 px-4 py-2">
                                <span>Get Started</span>
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>