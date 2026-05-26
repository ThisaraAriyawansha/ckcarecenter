<div class="overflow-hidden space z-index-common">
    <div class="container-fluid p-0">
        <div class="title-area text-center">
            <span class="sub-title style2 text-anim" data-cue="slideInUp">Recent stories</span>
            <h2 class="sec-title text-anim" data-cue="slideInUp">Our success stories</h2>
            <p class="fs-18 text-anim2" data-cue="slideInUp">Easily find and book trusted Pet Caregivers near you</p>
        </div>

        <div class="gallery-1-wrap">
            @php
                $storyIndex = 0;
                $totalStories = count($successStories);
            @endphp

            @while($storyIndex < $totalStories)
                @if($storyIndex % 3 === 0)
                    {{-- Single large image (left side) --}}
                    @if(isset($successStories[$storyIndex]))
                        <div class="gallery-card">
                            <div class="gallery-img gallery-img-large">
                                <img 
                                    src="{{ asset('success_stories_img/' . $successStories[$storyIndex]->image) }}" 
                                    alt="{{ $successStories[$storyIndex]->image_alt ?? $successStories[$storyIndex]->title }}"
                                >
                                <a href="{{ asset('success_stories_img/' . $successStories[$storyIndex]->image) }}" class="icon-btn th-popup-image">
                                    <i class="fa-regular fa-magnifying-glass"></i>
                                </a>
                            </div>
                        </div>
                        @php $storyIndex++; @endphp
                    @endif
                @else
                    {{-- Paired images (right side) --}}
                    <div class="gallery-card-wrap">
                        @for($i = 0; $i < 2; $i++)
                            @if(isset($successStories[$storyIndex]))
                                <div class="gallery-card">
                                    <div class="gallery-img gallery-img-small">
                                        <img src="{{ asset('success_stories_img/' . $successStories[$storyIndex]->image) }}" alt="{{ $successStories[$storyIndex]->image_alt ?? $successStories[$storyIndex]->title }}">
                                        <a href="{{ asset('success_stories_img/' . $successStories[$storyIndex]->image) }}" class="icon-btn th-popup-image">
                                            <i class="fa-regular fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                </div>
                                @php $storyIndex++; @endphp
                            @endif
                        @endfor
                    </div>
                @endif
            @endwhile
        </div>
    </div>
</div>

<style>
/* Large image (left side) - fixed height */
.gallery-img-large {
    height: 500px; /* Adjust this value as needed */
    overflow: hidden;
}

.gallery-img-large img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

/* Small images (right side) - fixed height */
.gallery-img-small {
    height: 240px; /* Adjust this value as needed */
    overflow: hidden;
}

.gallery-img-small img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

/* Responsive - adjust heights for different screen sizes */
@media (max-width: 768px) {
    .gallery-img-large {
        height: 300px;
    }
    
    .gallery-img-small {
        height: 200px;
    }
}

@media (min-width: 769px) and (max-width: 1024px) {
    .gallery-img-large {
        height: 400px;
    }
    
    .gallery-img-small {
        height: 190px;
    }
}
</style>