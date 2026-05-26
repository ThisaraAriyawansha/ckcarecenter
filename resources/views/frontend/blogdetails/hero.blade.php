
            <section class="bg-color-3 text-light relative overflow-hidden">

                <div class="container relative z-1000">                    
                    <div class="row g-3 align-items-center justify-content-center">
                        <div class="col-lg-8">
                            <div class="relative z-1000 text-center">
                                <div class="spacer-single sm-hide"></div>
                                <div class="spacer-double sm-hide"></div>
                                <h2 class="wow fadeInUp mb-2" data-wow-delay=".2s">{{ Str::limit($blog->title, 50) }}</h2>
                                <div class="spacer-single"></div>

                                <div class="d-flex justify-content-center">
                                    <div class="text-white px-3"><i class="icofont-calendar me-2 id-color-2"></i>{{ $blog->date->format('d M, Y') }}</div>
                                    <div class="text-white px-3"><i class="icofont-user-alt-6 me-2 id-color-2"></i>By: {{ $blog->name }}</div>
                                </div>
                                <div class="spacer-double"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </section>