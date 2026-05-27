@extends('layouts.frontend')

{{-- Dynamic SEO Meta Tags for Service Detail Page --}}
@section('title', $service->title . ' | C & K Home Nursing and Care Center Sri Lanka')

@section('meta_description', Str::limit(strip_tags($service->description), 160) ?: 'Professional home nursing and elder care services by C & K Home Nursing and Care Center in Piliyandala, Sri Lanka.')

@section('meta_keywords', $service->title . ', home nursing Sri Lanka, elder care services Sri Lanka, C&K nursing care, professional nursing Piliyandala')

@php
    $serviceOgImage = !$service->image_path || str_starts_with($service->image_path, 'assets/')
        ? asset('assets/image/logo/og_image.webp')
        : \Illuminate\Support\Facades\Storage::disk('services_public')->url($service->image_path);
@endphp
@section('og_image', $serviceOgImage)

@section('og_type', 'article')

@section('content')

    @include('frontend.servicedetails.hero')
    @include('frontend.servicedetails.servicedetails')

@endsection