@extends('layouts.frontend')

{{-- SEO Meta Tags for Terms & Conditions Page --}}
@section('title', 'Terms & Conditions - C & K Home Nursing and Care Center Sri Lanka')

@section('meta_author', 'C & K Home Nursing and Care Center')

@section('meta_description', 'Read the Terms and Conditions for using C & K Home Nursing and Care Center website and services, including luxury retirement living, elder care agreements, and policies in Sri Lanka. Clear guidelines for residents and families.')

@section('meta_keywords', 'C & K Home Nursing and Care Center terms and conditions, Elder care terms Sri Lanka, Senior living policies, Retirement home terms')

@section('og_image', asset('assets/img/logo.png'))

@section('og_type', 'website')


@section('content')
    @include('frontend.termscondition.hero')
    @include('frontend.termscondition.termscondition')


    

    

@endsection