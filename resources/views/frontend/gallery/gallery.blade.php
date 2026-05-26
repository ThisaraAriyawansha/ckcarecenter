<div class="overflow-hidden space">
    <div class="container">
        {{-- Category Filter (only show if there are galleries) --}}
        @if($galleries->isNotEmpty())
            <div class="gallery-filter-wrap mb-5" style="padding: 30px 0;">
                <div class="text-center">
                    <button class="filter-btn active" data-filter="all" style="background: white; color: #1e40af; border: 2px solid #1e40af; padding: 10px 28px; margin: 5px; cursor: pointer; border-radius: 6px; font-weight: 500; transition: all 0.3s ease; font-size: 14px;">All Images</button>
                    @foreach($categories as $category)
                        <button class="filter-btn" data-filter="{{ Str::slug($category) }}" style="background: white; border: 2px solid #e5e7eb; color: #6b7280; padding: 10px 28px; margin: 5px; cursor: pointer; border-radius: 6px; font-weight: 500; transition: all 0.3s ease; font-size: 14px;">
                            {{ $category }}
                        </button>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Gallery Grid --}}
        <div class="gallery-grid" id="galleryGrid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 24px; margin-bottom: 50px;">
            @forelse($galleries as $index => $gallery)
                <div class="gallery-item" data-category="{{ Str::slug($gallery->category_name) }}" style="opacity: 1; transform: scale(1); transition: all 0.3s ease;">
                    <div class="gallery-card" style="position: relative; overflow: hidden; border-radius: 8px; background: white; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08); cursor: pointer; border: 1px solid #f3f4f6;">
                        <div class="gallery-img" style="position: relative; overflow: hidden;">
                            <img 
                                src="{{ asset('gallery_img/' . $gallery->image_path) }}" 
                                alt="{{ $gallery->category_name ?? 'Gallery Image' }}"
                                loading="lazy"
                                style="width: 100%; height: 280px; object-fit: cover; transition: transform 0.4s ease;"
                                onerror="this.onerror=null; this.src='{{ asset('images/no-image-available.jpg') }}'; this.alt='Image not available';"
                                onclick="openLightbox('{{ asset('gallery_img/' . $gallery->image_path) }}', '{{ $gallery->category_name ?? 'Gallery Image' }}')"
                            >
                            @if(file_exists(public_path('gallery_img/' . $gallery->image_path)))
                                <div class="icon-btnn" onclick="openLightbox('{{ asset('gallery_img/' . $gallery->image_path) }}', '{{ $gallery->category_name ?? 'Gallery Image' }}')" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; width: 48px; height: 48px; border-radius: 50%; display: flex; align-items: center; justify-content: center; opacity: 0; transition: all 0.3s ease; z-index: 3; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
                                    <i class="fa-regular fa-magnifying-glass" style="font-size: 18px; color: #1e40af;"></i>
                                </div>
                            @endif
                            <div class="gallery-category-label" style="position: absolute; top: 12px; left: 12px; background: white; color: #1e40af; padding: 6px 14px; border-radius: 6px; font-size: 11px; font-weight: 600; z-index: 2; box-shadow: 0 2px 6px rgba(0,0,0,0.1); text-transform: uppercase; letter-spacing: 0.5px;">{{ $gallery->category_name ?? 'Uncategorized' }}</div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5 my-5 empty-gallery-state" style="min-height: 400px; display: flex; flex-direction: column; align-items: center; justify-content: center; background: white; border-radius: 8px; border: 2px dashed #e5e7eb; grid-column: 1 / -1;">
                    <i class="fa-solid fa-images fa-5x mb-4" style="color: #d1d5db; opacity: 0.5;"></i>
                    <h3 style="color: #374151; font-weight: 600; margin-bottom: 0.5rem; font-size: 20px;">No images in the gallery yet</h3>
                    <p style="color: #9ca3af; margin-bottom: 0; font-size: 14px;">Check back later for updates</p>
                </div>
            @endforelse
        </div>
    </div>
    
    {{-- Lightbox Modal --}}
    <div id="lightboxModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.92); z-index: 9999; backdrop-filter: blur(20px);">
        <button onclick="closeLightbox()" style="position: absolute; top: 24px; right: 24px; background: white; color: #374151; border: none; width: 44px; height: 44px; border-radius: 50%; font-size: 20px; cursor: pointer; z-index: 10001; box-shadow: 0 2px 12px rgba(0,0,0,0.3); transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; font-weight: 400;">
            ✕
        </button>
        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); max-width: 90%; max-height: 90%; display: flex; flex-direction: column; align-items: center;">
            <img id="lightboxImg" src="" alt="" style="max-width: 100%; max-height: 82vh; object-fit: contain; border-radius: 8px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4); filter: drop-shadow(0 0 30px rgba(255, 255, 255, 0.1));">
            <p id="lightboxCaption" style="color: white; margin-top: 24px; font-size: 15px; font-weight: 500; text-align: center; background: rgba(255, 255, 255, 0.1); padding: 10px 20px; border-radius: 6px; backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);"></p>
        </div>
    </div>
</div>

<style>
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.gallery-card:hover img {
    transform: scale(1.05);
}

.gallery-card:hover .icon-btnn {
    opacity: 1 !important;
}

.gallery-card:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12) !important;
}

.filter-btn:hover {
    background: #f9fafb !important;
    border-color: #1e40af !important;
    color: #1e40af !important;
    transform: translateY(-1px);
}

.filter-btn.active {
    background: #1e40af !important;
    color: white !important;
    border-color: #1e40af !important;
}

#lightboxModal {
    animation: fadeIn 0.3s ease;
}

#lightboxModal button:hover {
    background: #f3f4f6 !important;
    color: #1e40af !important;
    transform: scale(1.1);
}

.gallery-item.hidden {
    display: none !important;
}

@media (max-width: 768px) {
    .gallery-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)) !important;
        gap: 16px !important;
    }
    
    .filter-btn {
        padding: 8px 20px !important;
        font-size: 13px !important;
        margin: 3px !important;
    }
    
    #lightboxModal button {
        top: 16px !important;
        right: 16px !important;
        width: 40px !important;
        height: 40px !important;
        font-size: 18px !important;
    }
}
</style>

<script>
// Lightbox Functions
function openLightbox(imageSrc, caption) {
    const modal = document.getElementById('lightboxModal');
    const img = document.getElementById('lightboxImg');
    const captionText = document.getElementById('lightboxCaption');
    
    modal.style.display = 'block';
    img.src = imageSrc;
    captionText.textContent = caption;
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    const modal = document.getElementById('lightboxModal');
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
}

// Close on clicking outside the image
document.getElementById('lightboxModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeLightbox();
    }
});

// Close on ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeLightbox();
    }
});

// Gallery Filter with localStorage Support
document.addEventListener('DOMContentLoaded', function() {
    console.log('Gallery page loaded');
    
    // Check localStorage for filter
    const storageFilter = localStorage.getItem('galleryFilterLocation');
    const storageTime = localStorage.getItem('galleryFilterTime');
    const currentTime = Date.now();
    
    // Determine which filter to use
    let activeFilter = 'all';
    
    if (storageFilter && storageTime && (currentTime - storageTime) < 10000) {
        // Use localStorage filter if recent (within 10 seconds)
        activeFilter = storageFilter;
        console.log('Using localStorage filter (title):', activeFilter);
        
        // Clear storage
        localStorage.removeItem('galleryFilterLocation');
        localStorage.removeItem('galleryFilterTime');
    }
    
    console.log('Final filter to apply:', activeFilter);
    
    // Apply the filter
    if (activeFilter && activeFilter !== 'all') {
        applyFilterByTitle(activeFilter);
    }
    
    // Filter function - match title with category_name
    function applyFilterByTitle(titleFilter) {
        console.log('Applying filter by title:', titleFilter);
        
        // Convert title to slug to match button data-filter
        const slugFilter = titleFilter.toLowerCase()
                                     .replace(/[^\w\s-]/g, '')
                                     .replace(/\s+/g, '-')
                                     .replace(/-+/g, '-')
                                     .trim();
        
        console.log('Converted to slug:', slugFilter);
        
        // Find and activate the corresponding filter button
        const filterBtns = document.querySelectorAll('.filter-btn');
        let found = false;
        
        filterBtns.forEach(btn => {
            const btnFilter = btn.getAttribute('data-filter');
            const btnText = btn.textContent.trim();
            
            console.log('Checking button:', btnText, 'filter:', btnFilter);
            
            // Match either by slug or by category name
            if (btnFilter === slugFilter || btnText === titleFilter) {
                console.log('Found matching button!');
                found = true;
                
                // Remove active from all buttons
                filterBtns.forEach(b => b.classList.remove('active'));
                
                // Add active to this button
                btn.classList.add('active');
                
                // Filter the gallery items
                filterGalleryItems(btnFilter);
            }
        });
        
        if (!found) {
            console.warn('No filter button found for:', titleFilter);
            // Fallback to "all"
            filterGalleryItems('all');
        }
    }
    
    // Gallery items filtering function
    function filterGalleryItems(filterValue) {
        console.log('Filtering gallery items with:', filterValue);
        const galleryItems = document.querySelectorAll('.gallery-item');
        
        galleryItems.forEach(item => {
            const itemCategory = item.getAttribute('data-category');
            
            if (filterValue === 'all' || itemCategory === filterValue) {
                item.classList.remove('hidden');
                item.style.display = 'block';
                setTimeout(() => {
                    item.style.opacity = '1';
                    item.style.transform = 'scale(1)';
                }, 10);
            } else {
                item.style.opacity = '0';
                item.style.transform = 'scale(0.8)';
                setTimeout(() => {
                    item.classList.add('hidden');
                    item.style.display = 'none';
                }, 300);
            }
        });
    }
    
    // Setup filter button click handlers
    const filterBtns = document.querySelectorAll('.filter-btn');
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons
            filterBtns.forEach(b => b.classList.remove('active'));
            
            // Add active class to clicked button
            this.classList.add('active');
            
            // Get filter value
            const filterValue = this.getAttribute('data-filter');
            
            // Apply filter
            filterGalleryItems(filterValue);
        });
    });
});
</script>