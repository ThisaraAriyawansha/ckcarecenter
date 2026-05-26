@extends('layouts.frontend')

@section('title', '500 - Server Error | Care365')
@section('meta_description', 'Something went wrong on our server. We are working to fix it.')

@section('content')
<section class="error-section" style="min-height: 100vh; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); padding: 60px 20px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="error-content text-center" style="background: white; padding: 60px 40px; border-radius: 20px; box-shadow: 0 20px 60px rgba(0,0,0,0.1);">
                    <div class="error-image mb-4">
                        <h1 style="font-size: 150px; font-weight: 700; color: #dc3545; margin: 0; line-height: 1;">500</h1>
                    </div>
                    <h2 style="font-size: 36px; font-weight: 600; color: #333; margin-bottom: 20px;">Internal Server Error</h2>
                    <p style="font-size: 18px; color: #666; margin-bottom: 40px; max-width: 500px; margin-left: auto; margin-right: auto;">
                        Oops! Something went wrong on our server. Our team has been notified and we're working to fix this issue.
                    </p>
                    <div class="error-actions">
                        <a href="{{ route('home') }}" class="btn btn-primary" style="background: #1A4137; border: none; padding: 15px 40px; font-size: 16px; font-weight: 600; border-radius: 50px; text-decoration: none; display: inline-block; margin-right: 15px; color: white; transition: all 0.3s;">
                            <i class="fas fa-home"></i> Go to Homepage
                        </a>
                        <a href="javascript:location.reload()" class="btn btn-outline" style="background: transparent; border: 2px solid #1A4137; color: #1A4137; padding: 15px 40px; font-size: 16px; font-weight: 600; border-radius: 50px; text-decoration: none; display: inline-block; transition: all 0.3s;">
                            <i class="fas fa-sync-alt"></i> Try Again
                        </a>
                    </div>

                    <div class="helpful-info mt-5 pt-4" style="border-top: 1px solid #eee;">
                        <p style="font-size: 14px; color: #999; margin-bottom: 10px;">If the problem persists, please contact us:</p>
                        <a href="{{ route('contact') }}" style="color: #1A4137; text-decoration: none; font-size: 14px; font-weight: 600;">Contact Support</a>
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
