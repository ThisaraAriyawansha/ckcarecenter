<section class="bg-smoke2 space overflow-hidden" id="Online-Admissions">
    <div class="container mb-4">


         <div class="title-area text-center mb-5 pb-3">
            <div class="subtitle text-uppercase mb-2" style="color: #3498db; font-size: 13px; letter-spacing: 2px; font-weight: 600;">
                Online Admissions
            </div>
            <h2 class="mb-3" style="font-size: 36px; font-weight: 700; color: #2c3e50;">Our Goal Is To Make Your Life Better</h2>
            <p class="lead mb-0 text-muted mx-auto" style=" font-size: 16px; line-height: 1.6;">
                We simplify admissions with our easy online system, allowing you to initiate the process from anywhere globally. Secure online payments are accepted via credit card in multiple currencies, and installment plans are available. Log in to view payments and history.
            </p>
        </div>
        
        <!-- Button wrapper with flexbox for centering -->
        <div class="btn-wrap mt-50 d-flex justify-content-center" data-cue="slideInUp">
            <a href="{{ route('wecare') }}" 
            class="  fw-600 join-now-btn" 
            style="background-color: #48b1fb; 
                    text-align: center; 
                    color: #FFFFFF; 
                    border: none; 
                    border-radius: 50px; 
                    padding: 12px 32px;          
                    transition: all 0.3s ease; 
                    text-decoration: none;
                    font-size: 16px;             
                    min-width: 160px;">
                Join Now
            </a>
        </div>
    </div>
</section>


<style>
    .join-now-btn:hover {
        background-color: #2563EB !important;
        color: #FFFFFF !important;
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3); /* soft blue glow on hover */
    }
    .join-now-btn {
        min-width: 140px; /* ensures good size balance */
    }
</style>