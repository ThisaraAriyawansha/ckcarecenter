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
                                <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" aria-current="page" href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" aria-current="page" href="{{ route('about') }}">About</a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}" aria-current="page" href="{{ route('services') }}">Services</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact us</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle {{ request()->routeIs('faq', 'blog', 'gallery', 'testimonial') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    More
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item {{ request()->routeIs('faq') ? 'active' : '' }}" href="{{ route('faq') }}">FAQs</a></li>
                                    <li><a class="dropdown-item {{ request()->routeIs('blog') ? 'active' : '' }}" href="{{ route('blog') }}">Last Article</a></li>
                                    <li><a class="dropdown-item {{ request()->routeIs('gallery') ? 'active' : '' }}" href="{{ route('gallery') }}">Gallery</a></li>
                                    <li><a class="dropdown-item {{ request()->routeIs('testimonial') ? 'active' : '' }}" href="{{ route('testimonial') }}">Testimonials</a></li>
                                </ul>
                            </li>
                        </ul>
                        <div class="mb-xl-0 mb-3">
                            <a href="{{ route('contact') }}"
                                class="btn btn-accent-outline d-flex flex-row rounded-pill gap-2 px-4 py-2">
                                <span>Get Started</span>
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>