
    <style>


        .vision-mission-section {
            max-width: 1200px;
            margin: 0 auto;
            padding: 80px 20px;
            background-color: #ffffff;
        }

        /* Section Header */
        .section-header {
            text-align: center;
            margin-bottom: 60px;
        }


        .section-header h2 {
            font-size: 42px;
            font-weight: 700;
            color: #0F172A;
            margin-bottom: 15px;
            letter-spacing: -1px;
        }

        .section-description {
            font-size: 16px;
            color: #64748B;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* Cards Container */
        .cards-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 35px;
            margin-bottom: 70px;
        }

        /* Card Styles */
        .card {
            background: #F8FAFC;
            padding: 45px 40px;
            border-radius: 12px;
            border-left: 5px solid #2563EB;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 150px;
            height: 150px;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.05) 0%, transparent 100%);
            border-radius: 0 0 0 100%;
        }

        .card.mission {
            border-left-color: #F59E0B;
            background: #FFFBEB;
        }

        .card.mission::before {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.05) 0%, transparent 100%);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        /* Icon Container */
        .icon-container {
            width: 70px;
            height: 70px;
            background: #ffffff;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            position: relative;
            z-index: 1;
        }

        .card.mission .icon-container {
            background: #ffffff;
        }

        .icon-container svg {
            width: 36px;
            height: 36px;
        }

        /* Card Content */
        .card h3 {
            font-size: 26px;
            font-weight: 700;
            color: #0F172A;
            margin-bottom: 18px;
            letter-spacing: -0.5px;
            position: relative;
            z-index: 1;
        }

        .card p {
            font-size: 15px;
            color: #475569;
            line-height: 1.8;
            font-weight: 400;
            position: relative;
            z-index: 1;
        }

        

        /* Responsive Design */
        @media (max-width: 968px) {
            .section-header h2 {
                font-size: 36px;
            }

            .cards-container {
                grid-template-columns: 1fr;
                gap: 25px;
            }

            .stats-container {
                grid-template-columns: repeat(2, 1fr);
                gap: 30px;
            }

            .card {
                padding: 35px 30px;
            }
        }

        @media (max-width: 640px) {
            .vision-mission-section {
                padding: 50px 15px;
            }

            .section-header h2 {
                font-size: 30px;
            }

            .stats-container {
                grid-template-columns: 1fr;
                gap: 25px;
            }

            .stat-number {
                font-size: 34px;
            }
        }
    </style>
</head>
<body>

    <section class="vision-mission-section" id="who-we-are">
        
        <!-- Section Header -->
        <div class="section-header">
            <div class="subtitle">What Drives Us</div>
            <h2>Vision & Mission</h2>
            <p class="section-description">
                Committed to excellence in care, we blend innovation with compassion to create meaningful experiences.
            </p>
        </div>

        <!-- Vision & Mission Cards -->
        <div class="cards-container">
            
            <!-- Vision Card -->
            <div class="card vision">
                <div class="icon-container">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                </div>
                
                <h3>Our Vision</h3>
                
                <p>
                    To be the No. 1 care home in Sri Lanka, pioneering innovative care solutions that seamlessly integrate modern comforts and digital services for unparalleled experiences.
                </p>
            </div>

            <!-- Mission Card -->
            <div class="card mission">
                <div class="icon-container">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#F59E0B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"></path>
                    </svg>
                </div>
                
                <h3>Our Mission</h3>
                
                <p>
                    At Care365, we are committed to redefining care by blending contemporary living standards with personalized digital services. Through constant innovation and dedication, we strive to exceed expectations, fostering holistic well-being and creating lasting memories.
                </p>
            </div>

        </div>

        <!-- Statistics -->
        

    </section>

