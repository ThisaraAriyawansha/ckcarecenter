@extends('layouts.frontend')


{{-- SEO Meta Tags for About Page --}}
@section('title', 'About Care365 - Leading Elder Care Home in Sri Lanka')

@section('meta_author', 'Care365')

@section('meta_description', 'Learn about Care365, Sri Lanka\'s trusted luxury retirement home. Our dedicated team treats every resident like family, providing compassionate care, safety, and well-being. Discover why families trust us for senior living.')

@section('meta_keywords', 'About Care365, Elder care homes Sri Lanka, Best retirement homes Sri Lanka, Senior care facilities, Luxury elder care Sri Lanka, Trusted elderly care, Quality senior living')

@section('og_image', asset('assets/img/logo.png'))

@section('og_type', 'website')



@section('content')
    @include('frontend.about.hero')
    @include('frontend.about.about')
    @include('frontend.about.why_choose_us')
    @include('frontend.about.services')
    @include('frontend.about.package')
    @include('frontend.about.day_package')
    @include('frontend.about.team')
    @include('frontend.about.testimonials')
    @include('frontend.about.faq')
@endsection




    


