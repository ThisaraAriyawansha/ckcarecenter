@extends('layouts.frontend')

{{-- SEO Meta Tags for Contact Page --}}
@section('title', 'Contact Us | C & K Home Nursing and Care Center - Call 077 376 8767')

@section('meta_description', 'Contact C & K Home Nursing and Care Center in Piliyandala, Sri Lanka. Call 077 376 8767 or email candkhomenursing17@gmail.com. Located at No 50, Kudamaduwa Road, Siddamull, Piliyandala, Kesbewa.')

@section('meta_keywords', 'contact C&K home nursing, home nursing Piliyandala contact, nursing care Kesbewa phone, C&K care center address, home nursing Sri Lanka contact, elder care inquiries Sri Lanka')

@section('og_image', asset('assets/image/logo/og_image.webp'))

@section('og_type', 'website')


@section('content')

     @include('frontend.contact.hero')
     @include('frontend.contact.contactarea')
     @include('frontend.contact.map')

@endsection
