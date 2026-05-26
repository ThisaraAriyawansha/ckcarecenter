
            <section class="p-0 z-1000 relative">
                <div class="container mt-min-60">
                    <div class="row">
                        <div class="col-lg-12">
                            <img src="{{ asset('blog_img/' . $blog->image_path) }}" class="w-100 rounded-1" alt="" loading="lazy">
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <div class="container">
                    <div class="row gx-5">
                        <div class="col-lg-8">
                            <div class="blog-read">
                        <h2 class="sec-title text-anim2" data-cue="slideInUp">{{ $blog->title }}</h2>
                                <div class="post-text">
                                    <p>{!! $blog->description !!}</p>
                                </div>

                            </div>

                            <div class="spacer-single"></div>

                            

                        </div>

                        <div class="col-lg-4">
                            @if($relatedBlogs->count() > 0)
                                <div class="widget widget-post">
                                    <h4>Recent Posts</h4>   <!-- or change title to "More Articles" -->
                                    <ul class="de-bloglist-type-1">
                                        @foreach($relatedBlogs as $relatedBlog)
                                            <li>
                                                <div class="d-image">
                                                    <img 
                                                        src="{{ image_url($relatedBlog->image_path, 'blog') }}" 
                                                        alt="{{ $relatedBlog->title }}"
                                                        loading="lazy"
                                                    >
                                                </div>
                                                <div class="d-content">
                                                    <a href="{{ url('/' . $relatedBlog->title_slug) }}">
                                                        <h4>{{ Str::limit($relatedBlog->title, 60) }}</h4>
                                                    </a>
                                                    <div class="d-date">
                                                        {{ $relatedBlog->date->format('F j, Y') }}
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            
                        <div class="widget widget_tags">
                            <h4>Popular Tags</h4>
                            <ul>
                                @if($blog->tags->count() > 0)
                                    @foreach($blog->tags as $tag)
                                    <li><a href="#">{{ $tag->name }}</a></li>

                                    @endforeach
                                @else
                                    <li class="text-muted">No tags available yet.</li>
                                @endif
                            </ul>
                        </div>
                        </div>

                        </div>
                    </div>
                </div>
            </section>   


            