@extends('layouts.frontend')

@section('title', $service->title . ' - Luxury Elder Care Service | Care365 Sri Lanka')

@section('meta_description', Str::limit(strip_tags($service->description), 160) . ' Discover personalized senior care at Care365 in Sri Lanka.')

@section('meta_keywords', $service->title . ', elder care Sri Lanka, senior living services, luxury retirement home')

@section('og_image', $service->image_path ? asset('services_img/' . $service->image_path) : asset('assets/img/logo.png'))

@section('og_type', 'article') {{-- better for service/detail pages --}}

@section('content')

@section('content')

    @include('frontend.servicedetails.hero')
    @include('frontend.servicedetails.servicedetails')

    

    

@endsection