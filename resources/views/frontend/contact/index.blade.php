@extends('layouts.frontend')

{{-- SEO Meta Tags for Contact Page --}}
@section('title', 'Contact Care365 - Elder Care Home Inquiries | Call 0779191818')

@section('meta_author', 'Care365')

@section('meta_description', 'Get in touch with Care365 for inquiries about our luxury elder care services in Sri Lanka. Call 0779191818 or visit us to learn how we can provide the best care for your loved ones.')

@section('meta_keywords', 'Contact Care365, Elder care inquiries Sri Lanka, Retirement home contact, Senior care consultation, Care365 phone number, Elder care services Sri Lanka')

@section('og_image', asset('assets/img/logo.png'))

@section('og_type', 'website')


@section('content')

     @include('frontend.contact.hero')
     @include('frontend.contact.contactarea')
     @include('frontend.contact.map')

@endsection
