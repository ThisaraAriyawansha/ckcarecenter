
        <div class="section position-relative bg-attach-fixed overflow-hidden mx-auto rounded-4"
            style="background-image: url(assets/image/breadcrumb/56365356.webp); background-position: top; height: 50vh; max-width: 1770px;">
            <div class="cta-overlay"></div>
            <div class="r-container h-100 position-relative" style="z-index: 2;">
                <div class="d-flex flex-column w-100 h-100 justify-content-center mx-auto align-items-center text-white gap-3"
                    style="max-width: 895px;">
                    <h2 class="m-0 text-white">{{ $service->title }}</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $service->title }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>