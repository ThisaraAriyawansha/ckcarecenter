@extends('layouts.frontend')

@section('title', '429 - Too Many Requests | C & K Home Nursing and Care Center')
@section('meta_description', 'You have made too many requests. Please slow down and try again.')

@section('content')
<section class="error-section" style="min-height: 100vh; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); padding: 60px 20px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-12">
                <div class="error-content text-center">
                    <div class="error-image">
                        <i class="fas fa-exclamation-triangle error-icon" style="color: #ff6b6b;"></i>
                    </div>
                    <h2 class="error-title">Too Many Requests</h2>
                    <p class="error-desc">
                        Whoa! You're going too fast. Please slow down and try again in a few moments.
                    </p>

                    <div class="info-box">
                        <p class="info-box-text" style="color: #721c24;">
                            <i class="fas fa-shield-alt"></i> We've detected unusual activity. This is a security measure to protect our service. Please wait a moment before trying again.
                        </p>
                    </div>

                    <div class="error-actions">
                        <a href="{{ route('home') }}" class="btn-error btn-error-primary">
                            <i class="fas fa-home"></i> Go to Homepage
                        </a>
                    </div>

                    <div class="countdown" id="countdown">
                        <p>You can try again in: <span id="timer" class="countdown-timer">60</span> seconds</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .error-content {
        background: white;
        padding: 60px 40px;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
    }

    .error-image {
        margin-bottom: 24px;
    }

    .error-icon {
        font-size: 120px;
    }

    .error-title {
        font-size: 36px;
        font-weight: 600;
        color: #333;
        margin-bottom: 20px;
    }

    .error-desc {
        font-size: 18px;
        color: #666;
        margin-bottom: 24px;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
    }

    .info-box {
        background: #f8d7da;
        padding: 20px;
        border-radius: 10px;
        border-left: 4px solid #dc3545;
        margin-bottom: 32px;
        text-align: left;
    }

    .info-box-text {
        font-size: 14px;
        margin: 0;
    }

    .error-actions {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 15px;
    }

    .btn-error {
        display: inline-block;
        padding: 15px 40px;
        font-size: 16px;
        font-weight: 600;
        border-radius: 50px;
        text-decoration: none;
        transition: all 0.3s;
        cursor: pointer;
    }

    .btn-error-primary {
        background: #1C3F6E;
        border: 2px solid #1C3F6E;
        color: white;
    }

    .btn-error-primary:hover {
        background: #152e52;
        border-color: #152e52;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(28, 63, 110, 0.2);
        color: white;
    }

    .countdown {
        margin-top: 20px;
        font-size: 14px;
        color: #999;
    }

    .countdown-timer {
        font-weight: 600;
        color: #1C3F6E;
    }

    @media (max-width: 768px) {
        .error-content {
            padding: 40px 25px;
            border-radius: 16px;
        }

        .error-icon {
            font-size: 90px;
        }

        .error-title {
            font-size: 28px;
        }

        .error-desc {
            font-size: 16px;
        }

        .btn-error {
            padding: 13px 30px;
            font-size: 15px;
        }
    }

    @media (max-width: 480px) {
        .error-section {
            padding: 40px 15px !important;
        }

        .error-content {
            padding: 35px 20px;
            border-radius: 14px;
        }

        .error-icon {
            font-size: 70px;
        }

        .error-title {
            font-size: 22px;
            margin-bottom: 14px;
        }

        .error-desc {
            font-size: 14px;
        }

        .info-box {
            padding: 14px;
        }

        .info-box-text {
            font-size: 13px;
        }

        .error-actions {
            flex-direction: column;
            align-items: center;
        }

        .btn-error {
            width: 100%;
            max-width: 280px;
            padding: 13px 20px;
            font-size: 15px;
            text-align: center;
        }
    }

    @media (max-width: 360px) {
        .error-icon {
            font-size: 58px;
        }

        .error-title {
            font-size: 20px;
        }
    }
</style>

<script>
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
