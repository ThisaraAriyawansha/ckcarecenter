@extends('layouts.frontend')

{{-- SEO Meta Tags for Blogs Page --}}
@section('title', 'Blog | Home Nursing & Elder Care Tips | C & K Home Nursing and Care Center')

@section('meta_description', 'Read expert articles from C & K Home Nursing and Care Center on home nursing, elder care, healthy aging, and patient wellness in Sri Lanka. Helpful tips for families and caregivers.')

@section('meta_keywords', 'home nursing blog Sri Lanka, elder care tips Sri Lanka, nursing care articles, caregiver tips Sri Lanka, patient care blog, home nursing advice Piliyandala, C&K nursing blog')

@section('og_image', asset('assets/image/logo/og_image.webp'))

@section('og_type', 'website')


@section('content')
     @include('frontend.blog.hero')
     @include('frontend.blog.blogarea')
@endsection


 