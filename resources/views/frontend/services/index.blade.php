@extends('layouts.frontend')

{{-- SEO Meta Tags for Services Page --}}
@section('title', 'Our Services | C & K Home Nursing and Care Center - Home Nursing Sri Lanka')

@section('meta_description', 'Explore professional home nursing and elder care services offered by C & K Home Nursing and Care Center in Piliyandala, Sri Lanka. From 24/7 nursing care to post-surgery recovery and elderly support — care delivered to your home.')

@section('meta_keywords', 'home nursing services Sri Lanka, elder care services Piliyandala, 24/7 nursing care Sri Lanka, post surgery nursing care Sri Lanka, elderly care at home Sri Lanka, C&K nursing services, professional home nurses Kesbewa')

@section('og_image', asset('assets/image/logo/og_image.webp'))

@section('og_type', 'website')



@section('content')
    @include('frontend.services.hero')
    @include('frontend.services.service')


@endsection
