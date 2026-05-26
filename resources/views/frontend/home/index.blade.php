@extends('layouts.frontend')


{{-- SEO Meta Tags for Homepage --}}
@section('title', 'Care365 - Luxury Retirement Living in Sri Lanka | Best Elder Care Homes')

@push('head')
    <link rel="preload" as="image" href="{{ asset('assets/img/Home-img/personalized-care-tailoring-services-to-individual-needs-hero-1.webp') }}" media="(min-width: 769px)" fetchpriority="high">
    <link rel="preload" as="image" href="{{ asset('assets/img/Home-img/personalized-care-tailoring-services-to-individual-needs-hero-1-mobile.webp') }}" media="(max-width: 768px)" fetchpriority="high">
@endpush

@section('meta_author', 'Care365')

@section('meta_description', 'CARE 365: Luxury retirement living where seniors thrive with joy, independence, and exceptional care. We provide compassionate and personalized care for seniors in a warm and home-like environment. Our dedicated team is committed to enhancing the quality of life for our residents in Sri Lanka.')

@section('meta_keywords', 'Elder care homes in Sri Lanka, Elderly homes in Sri Lanka, Best retirement homes for seniors in Sri Lanka, Elder care, senior living facilities Sri Lanka, 24/7 medical elder care in Sri Lanka, Safe and secure elder care homes, Affordable luxury senior care Sri Lanka, Trusted elder care for Sri Lanka, Senior living with luxury amenities Sri Lanka, Senior Care facilities')

@section('og_image', asset('assets/img/logo.webp'))

@section('og_type', 'website')



@section('content')
    @include('frontend.home.hero_2')
    @include('frontend.home.about')
    @include('frontend.home.leadmagnet')
    @include('frontend.home.services')
    @include('frontend.home.carehome')
    @include('frontend.home.packages')

    @include('frontend.home.testimonial')
    @include('frontend.home.videoarea')


    <!--
    @include('frontend.home.specialities_2')
-->
    
 @endsection