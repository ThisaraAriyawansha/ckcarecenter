@extends('layouts.frontend')

{{-- SEO Meta Tags for We Care Page --}}
@section('title', 'We Care at C & K Home Nursing and Care Center | Elder Care Packages & Meal Plans in Sri Lanka')

@section('meta_author', 'C & K Home Nursing and Care Center')

@section('meta_description', 'Explore C & K Home Nursing and Care Center We Care services including personalized elder care packages, healthy meal plans, medical support, and compassionate daily assistance. Trusted senior care in Sri Lanka.')

@section('meta_keywords',
'We Care C & K Home Nursing and Care Center, Elder care packages Sri Lanka, Senior meal plans, Elderly care services, Retirement home services Sri Lanka, Assisted living care, Luxury senior care'
)

@section('og_image', asset('assets/img/we-care/og-we-care.png'))

@section('og_type', 'website')

@section('content')

    @include('frontend.wecare.hero')
    @include('frontend.wecare.packages')
    @include('frontend.wecare.daypackages')
    @include('frontend.wecare.otherpackage')
    @include('frontend.wecare.packageaddons')
    @include('frontend.wecare.admissions')
    @include('frontend.wecare.location')




@endsection
