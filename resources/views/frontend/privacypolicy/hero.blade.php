
<style>
    /* Breadcrumb Section Styles */
    .breadcrumb-area {
        position: relative;
        width: 100%;
        height: 370px;
        background-image: url('assets/images/breadcrumb/56365356.jpg');
        background-size: 100% 100%; /* Forces image to fit exactly */
        background-position: center center;
        background-repeat: no-repeat;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        box-sizing: border-box;
    }

    /* Background overlay for better text readability */
    .breadcrumb-area::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5); /* Dark overlay */
        z-index: 1;
    }

    /* Content container */
    .breadcrumb-content {
        position: relative;
        z-index: 2;
        color: white;
    }

    /* Main heading styles */
    .breadcrumb-content h1 {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 10px;
        color: white;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .breadcrumb-area {
            height: 250px;
            background-attachment: scroll;
        }
        
        .breadcrumb-content h1 {
            font-size: 2.5rem;
        }
    }

    @media (max-width: 480px) {
        .breadcrumb-area {
            height: 200px;
        }
        
        .breadcrumb-content h1 {
            font-size: 2rem;
        }
    }
</style>
<br/>
<!-- Breadcrumb Section -->
<section class="breadcrumb-area mt-6">
    <!-- Content -->
    <div class="breadcrumb-content">
        <h1 class="wow fadeInUp mb-2" data-wow-delay=".2s">Privacy Policy</h1>
    </div>
</section>