@extends('layouts.frontend')

{{-- SEO Meta Tags for Homepage --}}
@section('title', 'C & K Home Nursing and Care Center | Professional Home Nursing in Sri Lanka')

@section('meta_description', 'C & K Home Nursing and Care Center offers trusted, professional home nursing and elder care services in Piliyandala, Kesbewa, Sri Lanka. Compassionate care delivered to your doorstep — call 077 376 8767.')

@section('meta_keywords', 'home nursing Sri Lanka, elder care Piliyandala, nursing care Kesbewa, C&K home nursing, home nursing services Sri Lanka, elder care center Sri Lanka, professional nursing care, home care services Sri Lanka, nursing care Piliyandala, home nursing Kesbewa')

@section('og_image', asset('assets/image/logo/og_image.webp'))

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
    @include('frontend.home.carehome')
    @include('frontend.home.blog')



    
 @endsection