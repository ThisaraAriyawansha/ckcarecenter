@extends('layouts.frontend')

{{-- SEO Meta Tags for Gallery Page --}}
@section('title', 'Gallery | C & K Home Nursing and Care Center - Our Work in Sri Lanka')

@section('meta_description', 'View photos from C & K Home Nursing and Care Center — our team, home nursing visits, and care services in Piliyandala, Sri Lanka. See the compassionate care we provide to every patient.')

@section('meta_keywords', 'C&K home nursing gallery, home nursing photos Sri Lanka, elder care center Piliyandala photos, nursing care images Sri Lanka, home nursing team Sri Lanka')

@section('og_image', asset('assets/image/logo/og_image.webp'))

@section('og_type', 'website')


@section('content')
    @include('frontend.gallery.hero')
    @include('frontend.gallery.gallery')
@endsection
