<div class="section">
            <div class="r-container d-flex flex-column gap-3">
                <div class="row row-cols-xl-2 row-cols-1">
                    <div class="col col-xl-7 mb-3 scrollanimation animated fadeInLeft">
                        <div class="d-flex flex-column gap-3 w-100 px-5 pe-5 bg-accent-color-3">
                            <div class="pe-5">
                                <div class="d-flex flex-column gap-3 bg-accent-primary p-4"
                                    style="border-bottom-right-radius: 20px; margin-left: -3rem;">
                                    <div class="d-flex flex-row gap-2 align-items-center">
                                        <h6 class="accent-color m-0">Get In Touch</h6>
                                    </div>
                                    <h3>Our Care Home Team is Here to Help</h3>
                                    <p>Whether you are enquiring about residential care, respite care, or visiting a loved one, our dedicated team in Piliyandala is ready to assist you every step of the way.
                                    </p>
                                </div>
                            </div>
                            <div class="error_msg toast align-items-center w-100 shadow-none border-danger mb-3 my-4 border rounded-pill"
                                role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="d-flex p-2">
                                    <div class="toast-body f-18 d-flex flex-row gap-3 align-items-center text-danger">
                                        <i class="fa-solid fa-triangle-exclamation f-36 text-danger"></i>
                                        Something went wrong! Please try again.
                                    </div>
                                    <button type="button"
                                        class="me-2 m-auto bg-transparent border-0 ps-1 pe-0 text-danger"
                                        data-bs-dismiss="toast" aria-label="Close"><i
                                            class="fa-solid fa-xmark"></i></button>
                                </div>
                            </div>
                            <form
                                class="d-flex flex-column gap-1 h-100 justify-content-center w-100 needs-validation form"
                                action="{{ route('contact.send') }}"
                                method="POST"
                                novalidate>
                                @csrf
                                <div class="mb-3">
                                    <input type="text" class="form-control py-3 px-4" name="name" id="name"
                                        placeholder="Full Name" required>
                                    <div class="invalid-feedback">
                                        The field is required.
                                    </div>
                                </div>
                                <div class="row row-cols-xl-2 row-cols-1">
                                    <div class="col mb-3">
                                        <input type="email" class="form-control py-3 px-4" name="email" id="email"
                                            placeholder="Email Address" required>
                                        <div class="invalid-feedback">
                                            The field is required.
                                        </div>
                                    </div>
                                    <div class="col mb-3">
                                        <input type="tel" class="form-control py-3 px-4" name="number" id="number"
                                            placeholder="Phone Number" required>
                                        <div class="invalid-feedback">
                                            The field is required.
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <select name="subject" id="subject" class="form-select py-3 px-4" required>
                                        <option value="" selected>Select Subject</option>
                                        <option value="General Enquiry">General Enquiry</option>
                                        <option value="Residential Care">Residential Care</option>
                                        <option value="Respite Care">Respite Care</option>
                                        <option value="Medical Support">Medical Support</option>
                                        <option value="Visiting Information">Visiting Information</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a subject.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <textarea class="form-control py-3 px-4" id="message" name="message" rows="5"
                                        placeholder="Your Message" required></textarea>
                                    <div class="invalid-feedback">
                                        The field is required.
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" id="contactSubmitBtn"
                                        class="btn submit_form py-3 w-100 d-flex flex-row gap-3 justify-content-center gap-2 rounded-pill">
                                        Send Message
                                    </button>
                                </div>
                            </form>
                            <br/>
                        </div>
                    </div>
                    <div class="col col-xl-5 mb-3 scrollanimation animated fadeInRight">
                        <div class="d-flex flex-column gap-3 h-100">
                            <img src="assets/image/contact/jpg.avif" class="img-fluid h-100 rounded-4" alt="">
                            <div class="d-flex flex-column gap-3">
                                <div class="d-flex flex-row align-items-center font-2 gap-3">
                                    <i class="rtmicon rtmicon-location fs-4"></i>
                                    <span>No 50, Kudamaduwa Road, Siddamull, Piliyandala, Kesbewa, Sri Lanka</span>
                                </div>
                                <div class="d-flex flex-row align-items-center font-2 gap-3">
                                    <i class="rtmicon rtmicon-classic-phone  fs-4"></i>
                                    <a href="tel:0773768767" class="text-decoration-none" style="color: inherit !important;">077 376 8767</a>
                                </div>
                                <div class="d-flex flex-row align-items-center font-2 gap-3">
                                    <i class="rtmicon rtmicon-envelope fs-4"></i>
                                    <a href="mailto:candkhomenursing17@gmail.com" class="text-decoration-none" style="color: inherit !important;">candkhomenursing17@gmail.com</a>
                                </div>
                                <div class="d-flex flex-row align-items-center font-2 gap-3">
                                    <i class="rtmicon rtmicon-globe fs-4"></i>
                                    <a href="https://nursingcare.lk" target="_blank" rel="noopener noreferrer" class="text-decoration-none" style="color: inherit !important;">nursingcare.lk</a>
                                </div>
                                <div class="social-container team mb-xl-0 mb-3 gap-2">
                                    <a href="https://www.facebook.com" class="social-item-2">
                                        <i class="fa-brands fa-xs fa-facebook-f"></i>
                                    </a>
                                    <a href="https://www.twitter.com" class="social-item-2">
                                        <i class="fa-brands fa-xs fa-twitter"></i>
                                    </a>
                                    <a href="https://www.instagram.com" class="social-item-2">
                                        <i class="fa-brands fa-xs fa-instagram"></i>
                                    </a>
                                    <a href="https://www.youtube.com" class="social-item-2">
                                        <i class="fa-brands fa-xs fa-youtube"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Success Modal -->
        <div class="ck-modal-overlay" id="ckSuccessModal">
            <div class="ck-modal">
                <div class="ck-modal-icon">
                    <i class="fa-solid fa-check"></i>
                </div>
                <h4 class="ck-modal-title">Message Sent!</h4>
                <p class="ck-modal-text">Thank you for reaching out. Our team will get back to you as soon as possible.</p>
                <button class="ck-modal-btn" id="ckModalClose">Done</button>
            </div>
        </div>


        <style>
            #contactSubmitBtn{
                color: #ffffff;
            }

            #contactSubmitBtn:hover{
                color: #E6007E;
            }
        </style>