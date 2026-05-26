@extends('layouts.frontend')

{{-- SEO Meta Tags for FAQs Page --}}
@section('title', 'FAQs - Frequently Asked Questions About Care365 Elder Care Sri Lanka')

@section('meta_author', 'Care365')

@section('meta_description', 'Find answers to common questions about Care365 luxury retirement homes: admission process, services, costs, amenities, visiting rules, and senior care in Sri Lanka. Your questions answered clearly.')

@section('meta_keywords', 'Care365 FAQs, Elder care questions Sri Lanka, Senior living FAQ, Retirement home frequently asked questions, Assisted living queries')

@section('og_image', asset('assets/img/logo.png'))

@section('og_type', 'website')


@section('content')
    @include('frontend.faq.hero')
    @include('frontend.faq.faq')
    @include('frontend.faq.testimonial')
@endsection

