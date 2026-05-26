@extends('layouts.frontend')

@section('title', '419 - Page Expired | Care365')
@section('meta_description', 'Your session has expired. Please refresh the page.')

@section('content')
<section class="error-section" style="min-height: 100vh; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); padding: 60px 20px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="error-content text-center" style="background: white; padding: 60px 40px; border-radius: 20px; box-shadow: 0 20px 60px rgba(0,0,0,0.1);">
                    <div class="error-image mb-4">
                        <i class="fas fa-clock" style="font-size: 120px; color: #f39c12;"></i>
                    </div>
                    <h2 style="font-size: 36px; font-weight: 600; color: #333; margin-bottom: 20px;">Page Expired</h2>
                    <p style="font-size: 18px; color: #666; margin-bottom: 40px; max-width: 500px; margin-left: auto; margin-right: auto;">
                        Your session has expired due to inactivity. Please refresh the page and try again.
                    </p>

                    <div class="info-box mt-4 mb-4" style="background: #fff3cd; padding: 20px; border-radius: 10px; border-left: 4px solid #f39c12;">
                        <p style="font-size: 14px; color: #856404; margin: 0;">
                            <i class="fas fa-info-circle"></i> This happens when you stay on a page for too long without activity. It's a security measure to protect your data.
                        </p>
                    </div>

                    <div class="error-actions">
                        <a href="javascript:location.reload()" class="btn btn-primary" style="background: #1A4137; border: none; padding: 15px 40px; font-size: 16px; font-weight: 600; border-radius: 50px; text-decoration: none; display: inline-block; margin-right: 15px; color: white; transition: all 0.3s;">
                            <i class="fas fa-sync-alt"></i> Refresh Page
                        </a>
                        <a href="{{ route('home') }}" class="btn btn-outline" style="background: transparent; border: 2px solid #1A4137; color: #1A4137; padding: 15px 40px; font-size: 16px; font-weight: 600; border-radius: 50px; text-decoration: none; display: inline-block; transition: all 0.3s;">
                            <i class="fas fa-home"></i> Go to Homepage
                        </a>
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
</style>
@endsection
