<header class="header-light">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="de-flex sm-pt10">
                            <div class="de-flex-col">
                                <!-- logo begin -->
                                <div id="logo">
                                    <a href="{{ route('home') }}" aria-label="Care365 Home">
                                        <img class="logo-main" src="assets/img/logo.webp" alt="Care365 Logo" 
                                            style="max-height: 60px; width: auto; height: auto;" width="82" height="60" loading="lazy">
                                        <img class="logo-scroll" src="assets/img/logo.webp" alt="Care365 Logo" 
                                            style="max-height: 60px; width: auto; height: auto;" width="82" height="60" loading="lazy">
                                        <img class="logo-mobile" src="assets/img/logo.webp" alt="Care365 Logo" 
                                            style="max-height: 60px; width: auto; height: auto;" width="82" height="60" loading="lazy">
                                    </a>
                                </div>
                                <!-- logo close -->
                            </div>
                            <div class="de-flex-col header-col-mid">
                                <ul id="mainmenu">
                                    <li><a class="menu-item {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>
                                    <li><a class="menu-item {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About Care365</a>
                                        <ul>
                                            <li><a class="menu-item" href="{{ route('about') }}#who-we-are" class="scroll-link">Vision|Mission</a></li>
                                            <li><a class="menu-item" href="{{ route('about') }}#Why-Choose-Care365" class="scroll-link">Why Choose Care365 </a></li>
                                            <li><a class="menu-item" href="{{ route('about') }}#Care-Team " class="scroll-link">Management & Care Team  </a></li>

                                        </ul>
                                    </li>
                                    <li><a class="menu-item {{ request()->routeIs('services') ? 'active' : '' }}" href="{{ route('services') }}">Care Services</a>
                                        <ul>
                                            <li><a class="menu-item" href="{{ route('services') }}" class="scroll-link">Our Services</a></li>
                                            <li><a class="menu-item" href="{{ route('services') }}#Meal-Plan" class="scroll-link">Meals & Nutrition</a></li>
                                        </ul>
                                    </li>  
                                    <li><a class="menu-item {{ request()->routeIs('wecare') ? 'active' : '' }}" href="{{ route('wecare') }}">Care Options</a>
                                        <ul>
                                            <li><a class="menu-item" href="{{ route('wecare') }}#Packages" class="scroll-link">Packages & Pricing</a></li>
                                            <li><a class="menu-item" href="{{ route('wecare') }}#Admissions-Process" class="scroll-link">Admissions Process</a></li>
                                            <li><a class="menu-item" href="{{ route('wecare') }}#homes" class="scroll-link">Our Homes (Locations)</a></li>
                                        </ul>
                                    </li>    
                                    <li><a class="menu-item {{ request()->routeIs('digitalwellbeing') ? 'active' : '' }}" href="{{ route('digitalwellbeing') }}">Explore</a>
                                        <ul>
                                            <li><a class="menu-item" href="{{ route('gallery') }}" class="scroll-link">Gallery</a></li>
                                            <li><a class="menu-item" href="{{ route('digitalwellbeing') }}#News-Center" class="scroll-link">News & Updates</a></li>
                                            <li><a class="menu-item" href="{{ route('faq') }}" class="scroll-link">FAQ</a></li>
                                            <li><a class="menu-item" href="{{ route('digitalwellbeing') }}#Calander" class="scroll-link">Calander</a></li>
                                        </ul>
                                    </li>                                                                    

                                    <li><a class="menu-item {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a></li>

                                </ul>
                            </div>
                            <div class="de-flex-col">
                                <div class="menu_side_area">
                                    <div class="h-phone xs-hide">
                                        <span>Need Help?</span>
                                        <h5>(+94)77 660 40 40</h5>
                                    </div>    
                                    <a href="https://wa.me/94779191818" target="_blank" class="btn-main">Book Service Now</a>
                                    <span id="menu-btn"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const menuItems = document.querySelectorAll('#mainmenu a');
    const menuBtn = document.getElementById('menu-btn');
    
    menuItems.forEach(function(item) {
        item.addEventListener('click', function(e) {
            if (window.innerWidth <= 991) {
                // Small delay for smooth scrolling to work
                setTimeout(function() {
                    menuBtn.click(); // Trigger menu close
                }, 100);
            }
        });
    });
});
</script>