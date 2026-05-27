@extends('layouts.frontend')


{{-- SEO Meta Tags for Lead / Enquiry Page --}}
@section('title', 'Enquire Now | C & K Home Nursing and Care Center - Get a Free Consultation')

@section('meta_description', 'Enquire about home nursing and elder care services from C & K Home Nursing and Care Center in Piliyandala, Sri Lanka. Submit your details and our team will get back to you shortly.')

@section('meta_keywords', 'home nursing enquiry Sri Lanka, elder care consultation Sri Lanka, C&K nursing enquiry form, home nursing quote Sri Lanka, nursing care inquiry Piliyandala, free nursing consultation Sri Lanka')

@section('og_image', asset('assets/image/logo/og_image.webp'))

@section('og_type', 'website')




@section('content')

    @include('frontend.lead-form.lead-form')


@endsection




    


