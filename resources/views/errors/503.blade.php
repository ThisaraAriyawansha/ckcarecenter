@extends('layouts.frontend')

@section('title', '503 - Service Unavailable | C & K Home Nursing and Care Center')
@section('meta_description', 'Our website is currently undergoing maintenance. We will be back shortly.')

@section('content')
<section class="error-section" style="min-height: 100vh; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); padding: 60px 20px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-12">
                <div class="error-content text-center">
                    <div class="error-image">
                        <i class="fas fa-tools error-icon" style="color: #ffc107;"></i>
                    </div>
                    <h2 class="error-title">We'll Be Right Back!</h2>
                    <p class="error-desc">
                        Our website is currently undergoing scheduled maintenance. We should be back shortly. Thank you for your patience!
                    </p>

                    <div class="info-box">
                        <p class="info-box-text" style="color: #856404;">
                            <i class="fas fa-info-circle"></i> We are improving our services to serve you better.
                        </p>
                    </div>

                    <div class="error-actions">
                        <a href="javascript:location.reload()" class="btn-error btn-error-primary">
                            <i class="fas fa-sync-alt"></i> Refresh Page
                        </a>
                    </div>

                    <div class="helpful-info">
                        <p class="helpful-label">Need urgent assistance?</p>
                        <a href="mailto:candkhomenursing17@gmail.com" class="helpful-link">
                            <i class="fas fa-envelope"></i> candkhomenursing17@gmail.com
                        </a>
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
        background: #fff3cd;
        padding: 20px;
        border-radius: 10px;
        border-left: 4px solid #ffc107;
        margin-bottom: 32px;
        text-align: left;
    }

    .info-box-text {
        font-size: 16px;
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

    .helpful-info {
        margin-top: 40px;
        padding-top: 28px;
        border-top: 1px solid #eee;
    }

    .helpful-label {
        font-size: 14px;
        color: #999;
        margin-bottom: 10px;
    }

    .helpful-link {
        color: #1C3F6E;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        word-break: break-word;
    }

    .helpful-link:hover {
        text-decoration: underline;
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

        .info-box-text {
            font-size: 14px;
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

        .helpful-info {
            margin-top: 28px;
            padding-top: 20px;
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
@endsection
