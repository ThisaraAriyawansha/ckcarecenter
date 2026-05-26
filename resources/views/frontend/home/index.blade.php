@extends('layouts.frontend')


{{-- SEO Meta Tags for Homepage --}}
@section('title', 'Care365 - Luxury Retirement Living in Sri Lanka | Best Elder Care Homes')



@section('meta_author', 'Care365')

@section('meta_description', 'CARE 365: Luxury retirement living where seniors thrive with joy, independence, and exceptional care. We provide compassionate and personalized care for seniors in a warm and home-like environment. Our dedicated team is committed to enhancing the quality of life for our residents in Sri Lanka.')

@section('meta_keywords', 'Elder care homes in Sri Lanka, Elderly homes in Sri Lanka, Best retirement homes for seniors in Sri Lanka, Elder care, senior living facilities Sri Lanka, 24/7 medical elder care in Sri Lanka, Safe and secure elder care homes, Affordable luxury senior care Sri Lanka, Trusted elder care for Sri Lanka, Senior living with luxury amenities Sri Lanka, Senior Care facilities')

@section('og_image', asset('assets/img/logo.webp'))

@section('og_type', 'website')



@section('content')

     @include('frontend.home.hero')
     @include('frontend.home.about')
     @include('frontend.home.why')
     @include('frontend.home.counter')
     @include('frontend.home.cta')
     @include('frontend.home.services')
     @include('frontend.home.testimonial')
     @include('frontend.home.team')
     @include('frontend.home.faq')

     {{-- @include('frontend.home.blog') --}}
     {{-- @include('frontend.home.contact') --}}

    {{-- @include('frontend.home.carehome') --}}
    {{-- @include('frontend.home.packages') --}}

   
    {{-- @include('frontend.home.videoarea') --}}
    @include('frontend.home.temp')



    
 @endsection