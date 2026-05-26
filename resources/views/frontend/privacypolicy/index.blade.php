@extends('layouts.frontend')

{{-- SEO Meta Tags for Privacy Policy Page --}}
@section('title', 'Privacy Policy - Care365 Elder Care Sri Lanka')

@section('meta_author', 'Care365')

@section('meta_description', 'Care365 Privacy Policy: How we collect, use, and protect your personal information while providing luxury elder care and retirement living services in Sri Lanka. Your privacy matters to us.')

@section('meta_keywords', 'Care365 privacy policy, Elder care privacy Sri Lanka, Senior living data protection, Retirement home privacy')

@section('og_image', asset('assets/img/logo.png'))

@section('og_type', 'website')


@section('content')
    @include('frontend.privacypolicy.hero')
    @include('frontend.privacypolicy.privacypolicy')

@endsection