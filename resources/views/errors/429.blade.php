@extends('layouts.frontend')

@section('title', '429 - Too Many Requests | Care365')
@section('meta_description', 'You have made too many requests. Please slow down and try again.')

@section('content')
<section class="error-section" style="min-height: 100vh; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); padding: 60px 20px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="error-content text-center" style="background: white; padding: 60px 40px; border-radius: 20px; box-shadow: 0 20px 60px rgba(0,0,0,0.1);">
                    <div class="error-image mb-4">
                        <i class="fas fa-exclamation-triangle" style="font-size: 120px; color: #ff6b6b;"></i>
                    </div>
                    <h2 style="font-size: 36px; font-weight: 600; color: #333; margin-bottom: 20px;">Too Many Requests</h2>
                    <p style="font-size: 18px; color: #666; margin-bottom: 40px; max-width: 500px; margin-left: auto; margin-right: auto;">
                        Whoa! You're going too fast. Please slow down and try again in a few moments.
                    </p>

                    <div class="info-box mt-4 mb-4" style="background: #f8d7da; padding: 20px; border-radius: 10px; border-left: 4px solid #dc3545;">
                        <p style="font-size: 14px; color: #721c24; margin: 0;">
                            <i class="fas fa-shield-alt"></i> We've detected unusual activity. This is a security measure to protect our service. Please wait a moment before trying again.
                        </p>
                    </div>

                    <div class="error-actions">
                        <a href="{{ route('home') }}" class="btn btn-primary" style="background: #1A4137; border: none; padding: 15px 40px; font-size: 16px; font-weight: 600; border-radius: 50px; text-decoration: none; display: inline-block; color: white; transition: all 0.3s;">
                            <i class="fas fa-home"></i> Go to Homepage
                        </a>
                    </div>

                    <div class="countdown mt-4" id="countdown" style="font-size: 14px; color: #999;">
                        <p>You can try again in: <span id="timer" style="font-weight: 600; color: #1A4137;">60</span> seconds</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .btn-primary:hover {
        background: #2a5547 !important;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(26, 65, 55, 0.2);
    }
</style>

<script>
    // Countdown timer
    let seconds = 60;
    const timerElement = document.getElementById('timer');

    const countdown = setInterval(function() {
        seconds--;
        timerElement.textContent = seconds;

        if (seconds <= 0) {
            clearInterval(countdown);
            document.getElementById('countdown').innerHTML = '<p style="color: #28a745; font-weight: 600;"><i class="fas fa-check-circle"></i> You can try again now!</p>';
        }
    }, 1000);
</script>
@endsection
