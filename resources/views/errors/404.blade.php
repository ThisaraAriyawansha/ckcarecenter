@extends('layouts.frontend')

@section('title', '404 - Page Not Found | Care365')
@section('meta_description', 'The page you are looking for could not be found. Return to Care365 homepage.')

@section('content')
<section class="error-section" style="min-height: 100vh; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); padding: 60px 20px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="error-content text-center" style="background: white; padding: 60px 40px; border-radius: 20px; box-shadow: 0 20px 60px rgba(0,0,0,0.1);">
                    <div class="error-image mb-4">
                        <h1 style="font-size: 150px; font-weight: 700; color: #1A4137; margin: 0; line-height: 1;">404</h1>
                    </div>
                    <h2 style="font-size: 36px; font-weight: 600; color: #333; margin-bottom: 20px;">Page Not Found</h2>
                    <p style="font-size: 18px; color: #666; margin-bottom: 40px; max-width: 500px; margin-left: auto; margin-right: auto;">
                        Oops! The page you are looking for doesn't exist or has been moved. Don't worry, we'll help you get back on track.
                    </p>
                    <div class="error-actions">
                        <a href="{{ route('home') }}" class="btn btn-primary" style="background: #1A4137; border: none; padding: 15px 40px; font-size: 16px; font-weight: 600; border-radius: 50px; text-decoration: none; display: inline-block; margin-right: 15px; color: white; transition: all 0.3s;">
                            <i class="fas fa-home"></i> Go to Homepage
                        </a>
                        <a href="javascript:history.back()" class="btn btn-outline" style="background: transparent; border: 2px solid #1A4137; color: #1A4137; padding: 15px 40px; font-size: 16px; font-weight: 600; border-radius: 50px; text-decoration: none; display: inline-block; transition: all 0.3s;">
                            <i class="fas fa-arrow-left"></i> Go Back
                        </a>
                    </div>

                    <div class="helpful-links mt-5 pt-4" style="border-top: 1px solid #eee;">
                        <p style="font-size: 14px; color: #999; margin-bottom: 15px;">You might be looking for:</p>
                        <div class="link-list">
                            <a href="{{ route('services') }}" style="color: #1A4137; text-decoration: none; margin: 0 15px; font-size: 14px;">Services</a>
                            <a href="{{ route('about') }}" style="color: #1A4137; text-decoration: none; margin: 0 15px; font-size: 14px;">About Us</a>
                            <a href="{{ route('blog') }}" style="color: #1A4137; text-decoration: none; margin: 0 15px; font-size: 14px;">Blog</a>
                            <a href="{{ route('contact') }}" style="color: #1A4137; text-decoration: none; margin: 0 15px; font-size: 14px;">Contact</a>
                        </div>
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

    .btn-outline:hover {
        background: #1A4137 !important;
        color: white !important;
        transform: translateY(-2px);
    }

    .helpful-links a:hover {
        text-decoration: underline !important;
    }
</style>
@endsection
