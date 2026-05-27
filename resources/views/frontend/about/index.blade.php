@extends('layouts.frontend')


{{-- SEO Meta Tags for About Page --}}
@section('title', 'About Us | C & K Home Nursing and Care Center - Piliyandala, Sri Lanka')

@section('meta_description', 'Learn about C & K Home Nursing and Care Center — a trusted home nursing and elder care provider based in Piliyandala, Kesbewa, Sri Lanka. We deliver compassionate, professional care to your home.')

@section('meta_keywords', 'about C&K home nursing, home nursing Piliyandala, elder care center Sri Lanka, trusted nursing care Sri Lanka, nursing care Kesbewa, home care providers Sri Lanka, professional home nurses Sri Lanka')

@section('og_image', asset('assets/image/logo/og_image.webp'))

@section('og_type', 'website')



@section('content')
    @include('frontend.about.hero')
    @include('frontend.about.about')
    @include('frontend.about.why_choose_us')
    @include('frontend.about.services')
    @include('frontend.about.package')
    @include('frontend.about.day_package')
    @include('frontend.about.team')
    @include('frontend.about.testimonials')
    @include('frontend.about.faq')
@endsection




    


