@extends('layouts.frontend')

{{-- SEO Meta Tags for Privacy Policy Page --}}
@section('title', 'Privacy Policy - C & K Home Nursing and Care Center Sri Lanka')

@section('meta_author', 'C & K Home Nursing and Care Center')

@section('meta_description', 'C & K Home Nursing and Care Center Privacy Policy: How we collect, use, and protect your personal information while providing luxury elder care and retirement living services in Sri Lanka. Your privacy matters to us.')

@section('meta_keywords', 'C & K Home Nursing and Care Center privacy policy, Elder care privacy Sri Lanka, Senior living data protection, Retirement home privacy')

@section('og_image', asset('assets/img/logo.png'))

@section('og_type', 'website')


@section('content')
    @include('frontend.privacypolicy.hero')
    @include('frontend.privacypolicy.privacypolicy')

@endsection