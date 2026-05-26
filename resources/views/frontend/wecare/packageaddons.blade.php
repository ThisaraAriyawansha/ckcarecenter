<section class="feature-area-1 position-relative overflow-hidden bg-white" id="service-sec" style="padding: 5rem 0;">

    <div class="container">
        <div class="row justify-content-center">
            <div class="title-area text-center mb-5 pb-3">
                <div class="subtitle text-uppercase mb-2" style="color: #3498db; font-size: 13px; letter-spacing: 2px; font-weight: 600;">
                    Our Package Addons
                </div>
                <h2 class="sec-title mb-3" style="font-size: 36px; font-weight: 700; color: #2c3e50; line-height: 1.2; margin: 0;">
                    Get the Exclusive Benefits of our Package Addons
                </h2>
                <p class="lead mb-0 text-muted mx-auto" style="max-width: 700px; font-size: 16px; line-height: 1.6;">
                    Enhance your care package with our premium addon services tailored to your needs.
                </p>
            </div>
        </div>

        <div id="package-addons-container">
            <!-- Cards will be dynamically generated here -->
        </div>
    </div>

</section>

<script>
// Package addons data array
const packageAddons = [
    // First row
    {
        icon: 'fa-heartbeat',
        title: 'Health Checkup Packages',
        description: 'Regular comprehensive medical examinations (monthly, quarterly, or semi-annually) to monitor health.'
    },
    {
        icon: 'fa-user-doctor',
        title: 'Doctor Visits / E-Channeling',
        description: 'Convenient scheduling of doctor appointments or teleconsultations.'
    },
    {
        icon: 'fa-prescription-bottle-medical',
        title: 'Monthly Medicine Supply',
        description: 'Hassle-free monthly delivery of prescribed medications.'
    },
    {
        icon: 'fa-car',
        title: 'Transportation',
        description: 'Reliable transportation services for appointments, errands, or outings.'
    },
    // Second row
    {
        icon: 'fa-heart-pulse',
        title: 'Emergency Death Package',
        description: 'Compassionate end-of-life arrangements and services.'
    },
    {
        icon: 'fa-utensils',
        title: 'Extra Meal Package',
        description: 'Additional meal options beyond the standard meal plan.'
    },
    {
        icon: 'fa-cake-candles',
        title: 'Birthday Package',
        description: 'Celebratory packages to make birthdays extra special.'
    },
    {
        icon: 'fa-bus',
        title: 'Annual Tour Package',
        description: 'Organized group tours and travel experiences.'
    },
    // Last single card
    {
        icon: 'fa-cart-shopping',
        title: 'Online Shopping Package',
        description: 'Assistance with online shopping and delivery of desired items.'
    }
];

// Function to generate HTML for a single card
function generateCard(cardData) {
    return `
        <div class="col-xl-3 col-lg-6 col-md-6" style="display: flex;">
            <div class="feature-card bg-white position-relative" 
                 style="display: flex; 
                        flex-direction: column; 
                        height: 100%; 
                        padding: 2rem 1.5rem; 
                        background: white; 
                        transition: all 0.3s ease;
                        width: 100%;">
                
                <div class="box-icon d-flex align-items-center justify-content-center mb-3" 
                     style="width: 70px; 
                            height: 70px; 
                            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%); 
                            border-radius: 12px;
                            box-shadow: 0 4px 12px rgba(52, 152, 219, 0.2);
                            transition: all 0.3s ease;">
                    <i class="fa-solid ${cardData.icon}" style="color: white; font-size: 32px; transition: all 0.3s ease;"></i>
                </div>
                
                <h3 class="box-title mb-3" style="font-size: 20px; font-weight: 600; color: #2c3e50; line-height: 1.3;">
                    ${cardData.title}
                </h3>
                
                <p class="box-text mb-0" style="font-size: 14px; line-height: 1.7; flex-grow: 1; color: #5a6c7d;">
                    ${cardData.description}
                </p>
            </div>
        </div>
    `;
}

// Function to render all cards in appropriate rows
function renderPackageAddons() {
    const container = document.getElementById('package-addons-container');
    let html = '';
    
    // Group cards into rows of 4 (for the first 8 cards)
    for (let i = 0; i < packageAddons.length; i++) {
        // Start a new row for every 4 cards (and for the last card)
        if (i % 4 === 0) {
            if (i > 0) html += '</div>'; // Close previous row
            
            // Check if this is the last card (9th card - index 8)
            if (i === 8) {
                html += '<div class="row gy-4">'; // Single card row
            } else {
                html += '<div class="row gy-4 mb-4">'; // Regular row with margin-bottom
            }
        }
        
        html += generateCard(packageAddons[i]);
        
        // Close the last row
        if (i === packageAddons.length - 1) {
            html += '</div>';
        }
    }
    
    container.innerHTML = html;
}

// Render the cards when the page loads
document.addEventListener('DOMContentLoaded', renderPackageAddons);
</script>

<style>
/* Card Hover Effects */
.feature-card:hover {
    transform: translateY(-8px);
}

/* Icon Hover Animation - Blue to Yellow */
.feature-card:hover .box-icon {
background: linear-gradient(135deg, #1E90FF 0%, #2563EB 100%) !important;
}

/* Icon color change on hover */
.feature-card:hover .box-icon i {
    color: white !important; /* Keep icon white on yellow background */
}

.box-icon {
    transition: all 0.3s ease;
}

/* Responsive Typography */
@media (max-width: 991.98px) {
    .sec-title {
        font-size: 32px !important;
    }
    
    .lead {
        font-size: 15px !important;
    }
}

@media (max-width: 767.98px) {
    .sec-title {
        font-size: 28px !important;
    }
    
    .box-title {
        font-size: 18px !important;
    }
    
    .box-text {
        font-size: 13px !important;
    }
    
    .feature-card {
        padding: 1.5rem 1.25rem !important;
    }
    
    .box-icon {
        width: 60px !important;
        height: 60px !important;
    }
    
    .box-icon i {
        font-size: 28px !important;
    }
}

@media (max-width: 575.98px) {
    section {
        padding: 3rem 0 !important;
    }
}

/* Smooth transitions for all elements */
.feature-card, .box-icon, .box-title, .box-icon i {
    transition: all 0.3s ease;
}
</style>