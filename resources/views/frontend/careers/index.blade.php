@extends('layouts.frontend')

{{-- SEO Meta Tags for Careers Page --}}
@section('title', 'Careers at Care365 - Join Our Elder Care Team in Sri Lanka')

@section('meta_author', 'Care365')

@section('meta_description', 'Looking for rewarding jobs in senior care? Explore career opportunities at Care365: nursing, caregiving, admin roles in luxury retirement homes across Sri Lanka. Join a compassionate team dedicated to elder well-being.')

@section('meta_keywords', 'Elder care jobs Sri Lanka, Senior living careers, Caregiver vacancies Sri Lanka, Nursing jobs retirement homes, Care365 careers, Elderly care employment')

@section('og_image', asset('assets/img/logo.png'))

@section('og_type', 'website')


@section('content')


    @include('frontend.careers.hero')
    @include('frontend.careers.careers')


@endsection