<section class="pt-0">
    <div class="container">
        <div class="row g-3">
            <?php
                $services = [
                    [
                        'icon' => 'assets/images/icons/white/5634674.png',
                        'alt' => 'Medical care icon',
                        'title' => 'Holistic Approach',
                        'description' => 'Complete care for body, mind, and spirit.'
                    ],
                    [
                        'icon' => 'assets/images/icons/white/calendar.webp',
                        'alt' => 'Medication icon',
                        'title' => 'Customized Care Plans',
                        'description' => 'Personalized plans tailored to individual needs.'
                    ],
                    [
                        'icon' => 'assets/images/icons/white/5456456.png',
                        'alt' => 'Personal assistance icon',
                        'title' => 'Comprehensive Services',
                        'description' => 'Wide range of daily and medical services.'
                    ],
                    [
                        'icon' => 'assets/images/icons/white/65456467.png',
                        'alt' => 'Nutrition icon',
                        'title' => 'Community & Engagement',
                        'description' => 'Social activities that inspire connection and joy.'
                    ],
                    [
                        'icon' => 'assets/images/icons/white/eco-friendly.webp',
                        'alt' => 'Activities icon',
                        'title' => 'Quality & Friendly Staff',
                        'description' => 'Trained, caring, and compassionate professionals.'
                    ],
                    [
                        'icon' => 'assets/images/icons/white/56435634.png',
                        'alt' => 'Support icon',
                        'title' => '24/7 Support',
                        'description' => 'Care and assistance available day and night.'
                    ],
                    [
                        'icon' => 'assets/images/icons/white/calendar.webp',
                        'alt' => 'Support icon',
                        'title' => 'Comfort & Quality of Life',
                        'description' => 'Safe, comfortable living with dignity.'
                    ],
                    [
                        'icon' => 'assets/images/icons/white/45764.png',
                        'alt' => 'Support icon',
                        'title' => 'Continuum of Care',
                        'description' => 'Ongoing care as needs evolve.'
                    ]
                ];

                foreach ($services as $index => $service):
                    $mtClass = $index >= 3 ? 'mt-3' : '';
            ?>
            <div class="col-lg-4 col-md-6 <?php echo $mtClass; ?>">
                <div class="service-card">
                    <img src="<?php echo $service['icon']; ?>" 
                        class="service-icon bg-color-2 w-60px p-10 rounded-10 wow scaleIn" 
                        alt="<?php echo $service['alt']; ?>"
                        loading="lazy">
                    <div class="service-content wow fadeInUp">
                        <h5 class="service-title"><?php echo $service['title']; ?></h5>
                        <p class="service-text"><?php echo $service['description']; ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<style>
/* Service Card Container */
.service-card {
    display: flex;
    align-items: flex-start;
    gap: 15px;
    width: 100%;
}

/* Service Icon */
.service-icon {
    flex-shrink: 0;
    object-fit: contain;
    aspect-ratio: 1 / 1;
}

/* Service Content Wrapper */
.service-content {
    flex: 1;
    min-width: 0;
    overflow: hidden;
}

/* Service Title */
.service-title {
    font-size: 16px;
    margin-bottom: 4px;
    word-wrap: break-word;
    overflow-wrap: break-word;
}

/* Service Text */
.service-text {
    font-size: 13px;
    margin-bottom: 0;
    word-wrap: break-word;
    overflow-wrap: break-word;
    line-height: 1.5;
}

/* Mobile Responsive - Below 768px */
@media (max-width: 767px) {
    .service-card {
        gap: 12px;
    }
    
    .service-icon {
        width: 50px !important;
        padding: 8px !important;
    }
    
    .service-title {
        font-size: 14px !important;
    }
    
    .service-text {
        font-size: 12px !important;
    }
}

/* Extra Small Mobile - Below 576px */
@media (max-width: 575px) {
    .service-card {
        gap: 10px;
    }
    
    .service-icon {
        width: 45px !important;
        padding: 6px !important;
    }
    
    .service-title {
        font-size: 13px !important;
        line-height: 1.3;
    }
    
    .service-text {
        font-size: 11px !important;
        line-height: 1.4;
    }
}
</style>