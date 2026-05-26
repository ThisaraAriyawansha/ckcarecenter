@extends('layouts.frontend')

{{-- SEO Meta Tags for Blogs Page --}}
@section('title', 'Blog - Senior Care Tips & Retirement Living Insights | Care365 Sri Lanka')

@section('meta_author', 'Care365')

@section('meta_description', 'Read the latest blog articles from Care365 on elder care advice, healthy aging, dementia support, retirement lifestyle tips, and senior wellness in Sri Lanka. Stay informed with expert insights.')

@section('meta_keywords', 'Senior care blog Sri Lanka, Elder care tips, Retirement living articles, Dementia care blog, Senior health insights, Care365 blog')

@section('og_image', asset('assets/img/logo.png'))

@section('og_type', 'website')


@section('content')
     @include('frontend.blog.hero')
     @include('frontend.blog.blogarea')
@endsection


 