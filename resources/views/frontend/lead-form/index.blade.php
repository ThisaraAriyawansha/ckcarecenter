@extends('layouts.frontend')


{{-- SEO Meta Tags for Lead / Enquiry Page --}}
@section('title', 'Contact Care365 | Enquire About Elder Care & Senior Living in Sri Lanka')

@section('meta_author', 'Care365')

@section('meta_description', 'Get in touch with Care365 to enquire about trusted elder care and senior living in Sri Lanka. Submit your details to receive personalised guidance, pricing, and care options for your loved ones.')

@section('meta_keywords', 'Contact Care365, Elder care enquiry Sri Lanka, Senior living enquiry, Retirement home contact Sri Lanka, Elder care consultation, Care365 enquiry form, Luxury elder care Sri Lanka')

@section('og_image', asset('assets/img/logo.png'))

@section('og_type', 'website')




@section('content')

    @include('frontend.lead-form.lead-form')


@endsection




    


