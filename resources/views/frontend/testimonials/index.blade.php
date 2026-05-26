@extends('layouts.frontend')

{{-- SEO Meta Tags for Testimonials Page --}}
@section('title', 'Testimonials - What Families Say About Care365 Elder Care Sri Lanka')

@section('meta_author', 'Care365')

@section('meta_description', 'Hear from happy families and residents about their experience at Care365 luxury retirement homes in Sri Lanka. Real stories of compassionate care, independence, joy, and exceptional senior living services.')

@section('meta_keywords', 'Care365 testimonials, Elder care reviews Sri Lanka, Senior living feedback, Retirement home testimonials, Family reviews elder care, Trusted senior care Sri Lanka')

@section('og_image', asset('assets/img/logo.png'))

@section('og_type', 'website')


@section('content')
    @include('frontend.testimonials.hero')
    @include('frontend.testimonials.testimonial')
@endsection




 