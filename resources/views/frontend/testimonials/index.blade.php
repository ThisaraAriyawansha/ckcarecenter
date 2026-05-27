@extends('layouts.frontend')

{{-- SEO Meta Tags for Testimonials Page --}}
@section('title', 'Testimonials | C & K Home Nursing and Care Center - What Our Patients Say')

@section('meta_description', 'Read real reviews and testimonials from patients and families who have experienced home nursing and elder care from C & K Home Nursing and Care Center in Piliyandala, Sri Lanka.')

@section('meta_keywords', 'C&K home nursing reviews, home nursing testimonials Sri Lanka, elder care reviews Piliyandala, nursing care feedback Sri Lanka, trusted home nursing Sri Lanka, patient reviews C&K')

@section('og_image', asset('assets/image/logo/og_image.webp'))

@section('og_type', 'website')


@section('content')
    @include('frontend.testimonials.hero')
    @include('frontend.testimonials.testimonial')
@endsection




 