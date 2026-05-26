@extends('layouts.frontend')

{{-- SEO Meta Tags for Services Page --}}
@section('title', 'Our Services - Luxury Elder Care & Senior Living in Sri Lanka | Care365')

@section('meta_author', 'Care365')

@section('meta_description', 'Explore premium services at Care365: assisted living, 24/7 nursing care, memory support, personalized elder care, and luxury amenities for seniors in Sri Lanka. Discover compassionate retirement living tailored to your loved ones.')

@section('meta_keywords', 'Elder care services Sri Lanka, Assisted living Sri Lanka, Luxury senior living services, Memory care Sri Lanka, 24/7 elder care, Retirement home amenities, Personalized senior care')

@section('og_image', asset('assets/img/logo.png'))

@section('og_type', 'website')



@section('content')
    @include('frontend.services.hero')
    @include('frontend.services.hero_2')
    @include('frontend.services.service')
    @include('frontend.services.mealplan')


@endsection
