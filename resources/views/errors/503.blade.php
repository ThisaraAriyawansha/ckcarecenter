@extends('layouts.frontend')

@section('title', '503 - Service Unavailable | Care365')
@section('meta_description', 'Our website is currently undergoing maintenance. We will be back shortly.')

@section('content')
<section class="error-section" style="min-height: 100vh; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); padding: 60px 20px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="error-content text-center" style="background: white; padding: 60px 40px; border-radius: 20px; box-shadow: 0 20px 60px rgba(0,0,0,0.1);">
                    <div class="error-image mb-4">
                        <i class="fas fa-tools" style="font-size: 120px; color: #ffc107;"></i>
                    </div>
                    <h2 style="font-size: 36px; font-weight: 600; color: #333; margin-bottom: 20px;">We'll Be Right Back!</h2>
                    <p style="font-size: 18px; color: #666; margin-bottom: 40px; max-width: 500px; margin-left: auto; margin-right: auto;">
                        Our website is currently undergoing scheduled maintenance. We should be back shortly. Thank you for your patience!
                    </p>

                    <div class="maintenance-info mt-4 mb-4" style="background: #fff3cd; padding: 20px; border-radius: 10px; border-left: 4px solid #ffc107;">
                        <p style="font-size: 16px; color: #856404; margin: 0;">
                            <i class="fas fa-info-circle"></i> We are improving our services to serve you better.
                        </p>
                    </div>

                    <div class="error-actions">
                        <a href="javascript:location.reload()" class="btn btn-primary" style="background: #1A4137; border: none; padding: 15px 40px; font-size: 16px; font-weight: 600; border-radius: 50px; text-decoration: none; display: inline-block; color: white; transition: all 0.3s;">
                            <i class="fas fa-sync-alt"></i> Refresh Page
                        </a>
                    </div>

                    <div class="helpful-info mt-5 pt-4" style="border-top: 1px solid #eee;">
                        <p style="font-size: 14px; color: #999; margin-bottom: 10px;">Need urgent assistance?</p>
                        <a href="mailto:info@care365.lk" style="color: #1A4137; text-decoration: none; font-size: 14px; font-weight: 600;">
                            <i class="fas fa-envelope"></i> info@care365.lk
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
</style>
@endsection
