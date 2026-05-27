@extends('layouts.frontend')

{{-- SEO Meta Tags for FAQs Page --}}
@section('title', 'FAQs | C & K Home Nursing and Care Center - Home Nursing Questions Answered')

@section('meta_description', 'Have questions about home nursing or elder care in Sri Lanka? Find answers to frequently asked questions about C & K Home Nursing and Care Center services, costs, and how to get started.')

@section('meta_keywords', 'home nursing FAQ Sri Lanka, elder care questions Sri Lanka, C&K nursing FAQs, home nursing cost Sri Lanka, nursing care services questions, home care Piliyandala FAQ')

@section('og_image', asset('assets/image/logo/og_image.webp'))

@section('og_type', 'website')


@section('content')
    @include('frontend.faq.hero')
    @include('frontend.faq.faq')
@endsection

