

    <!-- How It Works Section -->
    <section class="border-top" id="Admissions-Process">
                    <div class="container">
        <div class="row g-4">
            <div class="col-lg-6 offset-lg-3 text-center" style="margin-bottom: 70px;">
                <div class="subtitle wow fadeInUp mb-3">How to Proceed</div>
                <h2 class="mb-4 wow fadeInUp" data-wow-delay=".2s">The Process of Admitting to Our Homes</h2>
            </div>
        </div>  
        <!-- Steps Container -->
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 60px; position: relative; align-items: start;">
            
            <!-- SVG Connecting Lines -->
            <svg style="position: absolute; top: 42px; left: 13%; width: 74%; height: 150px; z-index: 0; pointer-events: none;" viewBox="0 0 1000 150" preserveAspectRatio="none">
                <!-- First curve (going down from step 1 to step 2) -->
                <path d="M 80 20 Q 250 120, 420 20" stroke="#C7D2DD" stroke-width="3" fill="none" stroke-dasharray="12,12" stroke-linecap="round" />
                <!-- Second curve (going down from step 2 to step 3) -->
                <path d="M 580 20 Q 750 120, 920 20" stroke="#C7D2DD" stroke-width="3" fill="none" stroke-dasharray="12,12" stroke-linecap="round" />
            </svg>

            <!-- Step 1: Select Package -->
            <div style="text-align: center; position: relative; z-index: 1; padding: 0 20px;">
                <!-- Circle Number -->
                <div class="step-circle" style="width: 85px; height: 85px; background: #2563EB; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 35px auto; transition: all 0.4s ease; cursor: pointer;">
                    <span style="font-size: 38px; font-weight: 700; color: #ffffff; line-height: 1;">1</span>
                </div>
                
                <!-- Title -->
                <h3 style="font-size: 26px; font-weight: 700; color: #1F2937; margin: 0 0 18px 0; letter-spacing: -0.4px; line-height: 1.2;">Select Package</h3>
                
                <!-- Description -->
                <p style="font-size: 16px; color: #6B7280; line-height: 1.65; margin: 0; font-weight: 400;">
                    Pay for the selected package via our website and get the membership.
                </p>
            </div>

            <!-- Step 2: Onboard Digital -->
            <div style="text-align: center; position: relative; z-index: 1; padding: 0 20px;">
                <!-- Circle Number -->
                <div class="step-circle" style="width: 85px; height: 85px; background: #2563EB; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 35px auto; transition: all 0.4s ease; cursor: pointer;">
                    <span style="font-size: 38px; font-weight: 700; color: #ffffff; line-height: 1;">2</span>
                </div>
                
                <!-- Title -->
                <h3 style="font-size: 26px; font-weight: 700; color: #1F2937; margin: 0 0 18px 0; letter-spacing: -0.4px; line-height: 1.2;">Onboard Digital</h3>
                
                <!-- Description -->
                <p style="font-size: 16px; color: #6B7280; line-height: 1.65; margin: 0; font-weight: 400;">
                    You will have an account in our platform and can check the updated medical records and other things of your elder via our platform.
                </p>
            </div>

            <!-- Step 3: Admit your Loved Ones -->
            <div style="text-align: center; position: relative; z-index: 1; padding: 0 20px;">
                <!-- Circle Number -->
                <div class="step-circle" style="width: 85px; height: 85px; background: #2563EB; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 35px auto; transition: all 0.4s ease; cursor: pointer;">
                    <span style="font-size: 38px; font-weight: 700; color: #ffffff; line-height: 1;">3</span>
                </div>
                
                <!-- Title -->
                <h3 style="font-size: 26px; font-weight: 700; color: #1F2937; margin: 0 0 18px 0; letter-spacing: -0.4px; line-height: 1.2;">Admit your Loved Ones</h3>
                
                <!-- Description -->
                <p style="font-size: 16px; color: #6B7280; line-height: 1.65; margin: 0; font-weight: 400;">
                    Visit our home and admit your member by yourself or by a guardian.
                </p>
            </div>

        </div>
        </div>

    </section>

    <!-- Responsive CSS & Hover Effects -->
    <style>
        * {
            box-sizing: border-box;
        }

        /* Hover Effect - Blue to Yellow */
        .step-circle:hover {
            background: #02367d !important;
            transform: scale(1.1);
        }

        @media (max-width: 1024px) {
            section {
                padding: 70px 30px !important;
            }
            
            div[style*="grid-template-columns: repeat(3, 1fr)"] {
                gap: 40px !important;
            }
        }

        @media (max-width: 768px) {
            section {
                padding: 50px 20px !important;
            }
            
            div[style*="grid-template-columns: repeat(3, 1fr)"] {
                grid-template-columns: 1fr !important;
                gap: 60px !important;
            }
            
            /* Hide desktop SVG on mobile */
            svg {
                display: none !important;
            }
            
            /* Add mobile connectors */
            div[style*="grid-template-columns: repeat(3, 1fr)"] > div:not(:last-child)::after {
                content: '';
                position: absolute;
                bottom: -50px;
                left: 50%;
                transform: translateX(-50%);
                width: 3px;
                height: 40px;
                background-image: repeating-linear-gradient(
                    to bottom,
                    #C7D2DD,
                    #C7D2DD 8px,
                    transparent 8px,
                    transparent 16px
                );
                border-radius: 2px;
            }
        }

        @media (max-width: 480px) {
            section {
                padding: 40px 15px !important;
            }
            
            div[style*="width: 85px; height: 85px"] {
                width: 75px !important;
                height: 75px !important;
            }
            
            span[style*="font-size: 38px"] {
                font-size: 34px !important;
            }
            
            h3[style*="font-size: 26px"] {
                font-size: 22px !important;
            }
            
            p[style*="font-size: 16px"] {
                font-size: 15px !important;
            }
        }
    </style>

