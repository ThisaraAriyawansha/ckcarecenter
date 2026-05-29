@extends('layouts.frontend')

@section('title', '404 - Page Not Found | C & K Home Nursing and Care Center')
@section('meta_description', 'The page you are looking for could not be found. Return to C & K Home Nursing and Care Center homepage.')

@section('content')
<section class="error-section" style="min-height: 100vh; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); padding: 60px 20px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-12">
                <div class="error-content text-center">
                    <div class="error-image">
                        <h1 class="error-number">404</h1>
                    </div>
                    <h2 class="error-title">Page Not Found</h2>
                    <p class="error-desc">
                        Oops! The page you are looking for doesn't exist or has been moved. Don't worry, we'll help you get back on track.
                    </p>
                    <div class="error-actions">
                        <a href="{{ route('home') }}" class="btn-error btn-error-primary">
                            <i class="fas fa-home"></i> Go to Homepage
                        </a>
                        <a href="javascript:history.back()" class="btn-error btn-error-outline">
                            <i class="fas fa-arrow-left"></i> Go Back
                        </a>
                    </div>

                    <div class="helpful-links">
                        <p class="helpful-label">You might be looking for:</p>
                        <div class="link-list">
                            <a href="{{ route('services') }}" class="helpful-link">Services</a>
                            <a href="{{ route('about') }}" class="helpful-link">About Us</a>
                            <a href="{{ route('blog') }}" class="helpful-link">Blog</a>
                            <a href="{{ route('contact') }}" class="helpful-link">Contact</a>
                        </div>
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
        margin-bottom: 16px;
    }

    .error-number {
        font-size: 150px;
        font-weight: 700;
        color: #1C3F6E;
        margin: 0;
        line-height: 1;
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
        margin-bottom: 40px;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
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

    .btn-error-outline {
        background: transparent;
        border: 2px solid #1C3F6E;
        color: #1C3F6E;
    }

    .btn-error-outline:hover {
        background: #1C3F6E;
        color: white;
        transform: translateY(-2px);
    }

    .helpful-links {
        margin-top: 40px;
        padding-top: 30px;
        border-top: 1px solid #eee;
    }

    .helpful-label {
        font-size: 14px;
        color: #999;
        margin-bottom: 15px;
    }

    .link-list {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 8px 0;
    }

    .helpful-link {
        color: #1C3F6E;
        text-decoration: none;
        margin: 0 15px;
        font-size: 14px;
    }

    .helpful-link:hover {
        text-decoration: underline;
    }

    /* Tablet */
    @media (max-width: 768px) {
        .error-content {
            padding: 40px 25px;
            border-radius: 16px;
        }

        .error-number {
            font-size: 110px;
        }

        .error-title {
            font-size: 28px;
        }

        .error-desc {
            font-size: 16px;
            margin-bottom: 30px;
        }

        .btn-error {
            padding: 13px 30px;
            font-size: 15px;
        }
    }

    /* Mobile */
    @media (max-width: 480px) {
        .error-section {
            padding: 40px 15px !important;
        }

        .error-content {
            padding: 35px 20px;
            border-radius: 14px;
        }

        .error-number {
            font-size: 80px;
        }

        .error-title {
            font-size: 22px;
            margin-bottom: 14px;
        }

        .error-desc {
            font-size: 14px;
            margin-bottom: 24px;
        }

        .error-actions {
            flex-direction: column;
            align-items: center;
            gap: 12px;
        }

        .btn-error {
            width: 100%;
            max-width: 280px;
            padding: 13px 20px;
            font-size: 15px;
            text-align: center;
        }

        .helpful-links {
            margin-top: 28px;
            padding-top: 22px;
        }

        .helpful-link {
            margin: 0 8px;
            font-size: 13px;
        }
    }

    /* Extra small screens */
    @media (max-width: 360px) {
        .error-number {
            font-size: 68px;
        }

        .error-title {
            font-size: 20px;
        }
    }
</style>
@endsection
