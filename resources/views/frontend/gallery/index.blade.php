@extends('layouts.frontend')

{{-- SEO Meta Tags for Gallery Page --}}
@section('title', 'Gallery - Care365 Elder Care Home Photos & Facilities | Sri Lanka')

@section('meta_author', 'Care365')

@section('meta_description', 'Browse our gallery showcasing luxurious rooms, beautiful gardens, activity areas, dining spaces, and joyful moments at Care365 retirement homes in Sri Lanka. See why seniors thrive here in comfort and care.')

@section('meta_keywords', 'Care365 gallery, Elder care home photos Sri Lanka, Senior living facilities images, Retirement home gallery, Luxury elder care interiors, Sri Lanka senior community photos')

@section('og_image', asset('assets/img/logo.png'))

@section('og_type', 'website')


@section('content')
    @include('frontend.gallery.hero')
    @include('frontend.gallery.gallery')
@endsection
