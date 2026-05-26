<!-- Header Section -->
<section class="bg-color text-light">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-6 offset-lg-3 text-center">
                <div class="subtitle wow fadeInUp mb-3">Day Packages</div>
                <h2 class="wow fadeInUp" data-wow-delay=".2s">Elder Day Care Plans</h2>
                <p class="lead mb-0 wow fadeInUp">
                    Comfortable, safe, and caring day services designed to support seniors and give families peace of mind.
                </p>
                <div class="spacer-single"></div>
            </div>
        </div>
    </div>
</section>

<!-- Dynamic Cards Section -->
<section class="pt-0 pb-0">
    <div class="container">
        <div class="row g-4 mt-min-100 justify-content-center">
            @forelse ($dayPackages as $package)
                <div class="col-lg-4 col-sm-6">
                    <div class="relative bg-light p-4 rounded-10">
                        <div class="text-center">
                            <h5 class="mb-0">{{ $package->name }}</h5>
                            <div class="spacer-30"></div>
                            <div class="ms-5 fw-500">
                                <span class="fs-64 fw-bold text-dark">
                                    {{ number_format($package->price, 0) }}
                                </span>
                                <span>LKR</span>
                                <span>/Day</span>
                            </div>
                            <div class="spacer-20"></div>
                        </div>

                        <div class="text-center">
                            <a class="btn-main bg-color-2 " href="{{ route('lead-form') }}">Book Now</a>
                        </div>
                        <div class="spacer-20"></div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted lead">No day packages available at the moment. Check back soon!</p>
                </div>
            @endforelse
        </div>
    </div>
</section>