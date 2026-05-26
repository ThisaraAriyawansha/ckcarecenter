@extends('layouts.frontend')

@section('title', 'We Care at Care365 | Elder Care Packages & Meal Plans in Sri Lanka')

@section('meta_author', 'Care365')

@section('meta_description', 'Explore Care365 We Care services including personalized elder care packages, healthy meal plans, medical support, and compassionate daily assistance. Trusted senior care in Sri Lanka.')

@section('meta_keywords', 
'We Care Care365, Elder care packages Sri Lanka, Senior meal plans, Elderly care services, Retirement home services Sri Lanka, Assisted living care, Luxury senior care'
)

@section('og_image', asset('assets/img/we-care/og-we-care.png'))

@section('og_type', 'website')



@section('content')
    @include('frontend.digitalwellbeing.hero')
    @include('frontend.digitalwellbeing.blog')
    @include('frontend.digitalwellbeing.calander')
    @include('frontend.digitalwellbeing.onlineadmissions')

    

@endsection




    


