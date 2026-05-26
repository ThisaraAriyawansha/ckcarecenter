<section class="relative overflow-hidden" style="margin-bottom: 30px;">
    <div class="container">
        <div class="row g-4 grid-divider">
            <div class="col-md-3 wow fadeInRight" data-wow-delay=".2s">
                <div class="text-center">       
                    <i class="bg-color text-light fs-32 p-30 circle mb-3 fa fa-phone"></i>
                    <h5 class="mb-0">Call Us</h5>
                    <a href="tel:+94776604040" class="text-decoration-none">(+94) 77 660 40 40</a>
                </div>
            </div>
            <div class="col-md-3 wow fadeInRight" data-wow-delay=".4s">
                <div class="text-center">                  
                    <i class="bg-color text-light fs-32 p-30 circle mb-3 fa fa-user"></i>    
                    <h5 class="mb-0">Support / Inquiries</h5>
                    <a href="tel:+94776604040" class="text-decoration-none">(+94) 77 660 40 40</a>
                </div>
            </div>
            <div class="col-md-3 wow fadeInRight" data-wow-delay=".6s">
                <div class="text-center">                         
                    <i class="bg-color text-light fs-32 p-30 circle mb-3 fa-brands fa-whatsapp"></i>  
                    <h5 class="mb-0">Whatsapp</h5>
                    <a href="https://wa.me/94779191818" target="_blank" class="text-decoration-none">077 919 1818</a>
                </div>
            </div>
            <div class="col-md-3 wow fadeInRight" data-wow-delay=".8s">
                <div class="text-center">
                    <i class="bg-color text-light fs-32 p-30 circle mb-3 fa fa-envelope"></i>
                    <h5 class="mb-0">Email</h5>
                    <a href="mailto:info@care36t5.com" class="text-decoration-none">info@care36t5.com</a>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="bg-light relative no-top no-bottom bg-white" style="margin-bottom: 20px;">
    <div class="container-fluid position-relative half-fluid">
        <div class="container">
            <div class="row g-4">
                <!-- Image -->
                <div class="col-lg-6 position-lg-absolute left-half h-100">
                    <video 
                        id="scrollVideo"
                        controls
                        controlslist="nodownload"
                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;"
                        muted 
                        loop 
                        playsinline
                        preload="metadata"
                        poster="{{ asset('assets/images/Video/66546547.webp') }}">
                        <track kind="captions" label="English" srclang="en">
                        <source src="{{ asset('assets/images/Video/Ai_ad.mp4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    
                    <!-- Fallback Image (shown if video fails to load) -->
                    <div id="videoFallback" style="display: none; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url('{{ asset('assets/images/Video/325456.webp') }}'); background-size: cover; background-position: center;">
                        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; color: white; background: rgba(0,0,0,0.7); padding: 20px; border-radius: 8px;">
                            <i class="fas fa-video" style="font-size: 48px; margin-bottom: 10px;"></i>
                            <p style="margin: 0; font-size: 14px;">Video temporarily unavailable</p>
                        </div>
                    </div>
                </div>
                <!-- Text -->
                <div class="col-lg-6 offset-lg-6">
                    <div class="spacer-single"></div>
                    <div class="spacer-double"></div>
                    <div class="ps-lg-5">
                        <h3>Do you have any question?</h3>
                        
                        <!-- Add CSRF token if using Laravel -->
                            <form id="contactForm" class="contact-form" style="width: 100%;">
                                @csrf
                                <div class="row" style="display: flex; flex-wrap: wrap; margin: 0 -10px;">
                                    <div class="form-group col-md-6" style="padding: 0 10px; margin-bottom: 25px; flex: 0 0 50%; max-width: 50%;">
                                        <input type="text" class="form-control input-animate" name="name" id="name" placeholder="Your name*" required 
                                            style="width: 100%; padding: 15px 20px; border: none; border-bottom: 2px solid #48b1fb; background: transparent; font-size: 15px; color: #374151; outline: none;">
                                    </div>
                                    <div class="form-group col-md-6" style="padding: 0 10px; margin-bottom: 25px; flex: 0 0 50%; max-width: 50%;">
                                        <input type="email" class="form-control input-animate" name="email" id="email" placeholder="Email Address*" required 
                                            style="width: 100%; padding: 15px 20px; border: none; border-bottom: 2px solid #48b1fb; background: transparent; font-size: 15px; color: #374151; outline: none;">
                                    </div>
                                    <div class="form-group col-md-6" style="padding: 0 10px; margin-bottom: 25px; flex: 0 0 50%; max-width: 50%;">
                                        <input type="text" class="form-control input-animate" name="number" id="number" placeholder="Phone Number*" required 
                                            style="width: 100%; padding: 15px 20px; border: none; border-bottom: 2px solid #48b1fb; background: transparent; font-size: 15px; color: #374151; outline: none;">
                                    </div>

                                    <div class="form-group col-md-6" style="padding: 0 10px; margin-bottom: 25px; flex: 0 0 50%; max-width: 50%;">
                                        <select name="subject" id="subject" class="form-select input-animate" required 
                                                style="width: 100%; padding: 15px 20px; border: none; border-bottom: 2px solid #48b1fb; background: transparent; font-size: 15px; color: #6b7280; outline: none; cursor: pointer;"
                                                onchange="this.style.color='#374151';">
                                            <option value="" disabled selected hidden>Select Service*</option>
                                            <option value="Medical Care">Medical Care</option>
                                            <option value="Nutritious Meals">Nutritious Meals</option>
                                            <option value="Social/Recreational Activities">Social/Recreational Activities</option>
                                            <option value="Transportation">Transportation</option>
                                            <option value="24-hour Staff Availability">24-hour Staff Availability</option>
                                            <option value="Religious and Spiritual Support">Religious and Spiritual Support</option>
                                            <option value="Wound Care">Wound Care</option>
                                            <option value="Paralysis Care">Paralysis Care</option>
                                            <option value="Dementia & Parkinson Care">Dementia & Parkinson Care</option>
                                            <option value="Housekeeping/Laundry Services">Housekeeping/Laundry Services</option>
                                            <option value="Physical Therapy and Rehabilitation">Physical Therapy and Rehabilitation</option>
                                            <option value="Video Conferencing Facility">Video Conferencing Facility</option>
                                            <option value="Music, Art Activities/Library Facilities">Music, Art Activities/Library Facilities</option>
                                            <option value="Affordable Packages">Affordable Packages</option>
                                            <option value="Television Room/Lounge">Television Room/Lounge</option>
                                            <option value="Digital Well-being Platform">Digital Well-being Platform</option>
                                            <option value="Post-surgical Care">Post-surgical Care</option>
                                            <option value="Green Environment">Green Environment</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-12" style="padding: 0 10px; margin-bottom: 25px; flex: 0 0 100%; max-width: 100%;">
                                        <textarea name="message" id="message" cols="30" rows="5" class="form-control input-animate" placeholder="Write a message*" required 
                                                style="width: 100%; padding: 15px 20px; border: none; border-bottom: 2px solid #48b1fb; background: transparent; font-size: 15px; color: #374151; outline: none; resize: vertical; font-family: inherit;"></textarea>
                                    </div>
                                    <div class="form-btn col-12" style="padding: 0 10px; margin-top: 20px; flex: 0 0 100%; max-width: 100%;">
                                        <button type="submit" class="th-btn style5" id="submitBtn" 
                                                style="background: #0A3F87; color: #ffffff; border: none; padding: 16px 40px; font-size: 15px; font-weight: 500; letter-spacing: 0.5px; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(10, 63, 135, 0.2); position: relative; overflow: hidden;"
                                                onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(10, 63, 135, 0.4)'; this.style.background='#48b1fb';"
                                                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(10, 63, 135, 0.2)'; this.style.background='#0A3F87';">
                                            <span class="btn-text" style="display: inline-block;">Submit Message</span>
                                            <span class="btn-loader" style="display: none; align-items: center; gap: 8px;">
                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: inline-block; vertical-align: middle;">
                                                    <circle cx="12" cy="12" r="10" opacity="0.25"/>
                                                    <path d="M12 2a10 10 0 0 1 10 10" opacity="0.75">
                                                        <animateTransform attributeName="transform" type="rotate" from="0 12 12" to="360 12 12" dur="1s" repeatCount="indefinite"/>
                                                    </path>
                                                </svg>
                                                Sending...
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                    </div>
                    <div class="spacer-double"></div>
                    <div class="spacer-single"></div>
                </div>
            </div>
        </div>
    </div>
</section>



@include('frontend.components.email_alert_modal')

<script>
document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const submitBtn = document.getElementById('submitBtn');
    const btnText = submitBtn.querySelector('.btn-text');
    const btnLoader = submitBtn.querySelector('.btn-loader');
    
    // Disable button and show loader
    submitBtn.disabled = true;
    btnText.style.display = 'none';
    btnLoader.style.display = 'inline-flex';
    
    const formData = new FormData(this);
    
    fetch('/contact/send', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
            'Accept': 'application/json',
        }
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(err => {
                throw err;
            });
        }
        return response.json();
    })
    .then(data => {
        // Re-enable button
        submitBtn.disabled = false;
        btnText.style.display = 'inline';
        btnLoader.style.display = 'none';
        
        if (data.success) {
            showAlert('success', 'Success!', data.message);
            document.getElementById('contactForm').reset();
        } else {
            showAlert('error', 'Error!', data.message);
        }
    })
    .catch(error => {
        // Re-enable button
        submitBtn.disabled = false;
        btnText.style.display = 'inline';
        btnLoader.style.display = 'none';
        
        console.error('Error:', error);
        
        let errorMessage = 'An unexpected error occurred. Please try again.';
        if (error.message) {
            errorMessage = error.message;
        }
        if (error.error) {
            errorMessage = error.error;
        }
        
        showAlert('error', 'Error!', errorMessage);
    });
});

function showAlert(type, title, message) {
    const modal = document.getElementById('alertModal');
    const icon = document.getElementById('alertIcon');
    const titleEl = document.getElementById('alertTitle');
    const messageEl = document.getElementById('alertMessage');
    
    if (type === 'success') {
        icon.innerHTML = '✓';
        modal.classList.remove('error');
    } else {
        icon.innerHTML = '✕';
        modal.classList.add('error');
    }
    
    titleEl.textContent = title;
    messageEl.textContent = message;
    modal.style.display = 'block';
}

function closeAlert() {
    document.getElementById('alertModal').style.display = 'none';
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('alertModal');
    if (event.target == modal) {
        closeAlert();
    }
}
</script>


<style>
/* Responsive adjustments */
@media (max-width: 768px) {
    .col-md-6 {
        flex: 0 0 100% !important;
        max-width: 100% !important;
    }
    .ps-lg-5 {
        padding-left: 1rem !important;
    }
}

/* Placeholder styling */
::placeholder {
    color: #9ca3af;
    opacity: 1;
}



/* Video section styling */

/* Custom Video Controls Styling */
#scrollVideo::-webkit-media-controls-panel {
    background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
}

#scrollVideo::-webkit-media-controls-play-button,
#scrollVideo::-webkit-media-controls-current-time-display,
#scrollVideo::-webkit-media-controls-time-remaining-display,
#scrollVideo::-webkit-media-controls-timeline,
#scrollVideo::-webkit-media-controls-volume-slider,
#scrollVideo::-webkit-media-controls-mute-button,
#scrollVideo::-webkit-media-controls-fullscreen-button {
    filter: brightness(1.2);
}

/* Responsive Video Section Styles */
@media (max-width: 991px) {
    #video-section .col-lg-6:first-child > div {
        min-height: 350px !important;
    }
    
    #video-section .col-lg-6:last-child > div {
        padding: 40px 20px !important;
    }
}

@media (max-width: 767px) {
    #video-section .col-lg-6:first-child > div {
        min-height: 300px !important;
    }
    
    #video-section .col-lg-6:last-child > div {
        padding: 30px 20px !important;
    }
}

@media (max-width: 575px) {
    #video-section .col-lg-6:first-child > div {
        min-height: 280px !important;
    }
    
    #video-section .col-lg-6:last-child > div {
        padding: 25px 15px !important;
    }
}

/* Ensure full height on desktop */
@media (min-width: 992px) {
    #video-section .row {
        min-height: 600px;
    }
    
    #video-section .col-lg-6:first-child > div {
        min-height: 600px !important;
    }
    
    #video-section .col-lg-6:last-child {
        display: flex;
        align-items: center;
    }
    
    #video-section .col-lg-6:last-child > div {
        padding: 80px 60px !important;
        width: 100%;
    }
}

/* Smooth video transitions */
#scrollVideo {
    transition: opacity 0.3s ease;
}


@media (max-width: 991px) {
    .position-lg-absolute {
        position: relative !important;
        width: 100% !important;
        height: 400px !important; /* Adjust height as needed */
        margin-bottom: 20px;
    }
    
    .offset-lg-6 {
        margin-left: 0 !important;
    }
    
    #scrollVideo {
        position: relative !important;
        height: 100%;
    }
    
    .half-fluid .container {
        padding: 0 15px;
    }
}

/* Also ensure the video section is visible on small screens */
@media (max-width: 768px) {
    .position-lg-absolute {
        height: 300px !important; /* Smaller height for mobile */
    }
}


@media (min-width: 992px) {
    .position-lg-absolute {
        margin-bottom: 0 !important; /* No margin on desktop since it's absolute positioned */
    }
}


</style>


