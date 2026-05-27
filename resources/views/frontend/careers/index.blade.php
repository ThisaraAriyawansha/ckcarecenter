@extends('layouts.frontend')

{{-- SEO Meta Tags for Careers Page --}}
@section('title', 'Careers at C & K Home Nursing and Care Center - Join Our Elder Care Team in Sri Lanka')

@section('meta_author', 'C & K Home Nursing and Care Center')

@section('meta_description', 'Looking for rewarding jobs in senior care? Explore career opportunities at C & K Home Nursing and Care Center: nursing, caregiving, admin roles in luxury retirement homes across Sri Lanka. Join a compassionate team dedicated to elder well-being.')

@section('meta_keywords', 'Elder care jobs Sri Lanka, Senior living careers, Caregiver vacancies Sri Lanka, Nursing jobs retirement homes, C & K Home Nursing and Care Center careers, Elderly care employment')

@section('og_image', asset('assets/img/logo.png'))

@section('og_type', 'website')


@section('content')


    @include('frontend.careers.hero')
    @include('frontend.careers.careers')


@endsection