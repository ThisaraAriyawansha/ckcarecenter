@extends('layouts.frontend')

{{-- Dynamic SEO Meta Tags for Blog Detail Page --}}
@section('title', $blog->meta_title ?: ($blog->title . ' | C & K Home Nursing and Care Center'))

@section('meta_description', $blog->meta_description ?: Str::limit(strip_tags($blog->description), 160))

@section('meta_keywords', $blog->meta_keywords ?: 'home nursing Sri Lanka, elder care tips, nursing care blog, C&K home nursing')

{{-- OG Image - Uses blog image if available, falls back to og_image --}}
@section('og_image', $blog->image_path ? image_url($blog->image_path, 'blog') : asset('assets/image/logo/og_image.webp'))

@section('og_type', 'article')

@section('content')

    @include('frontend.blogdetails.hero')
    @include('frontend.blogdetails.blogdetails')








@endsection

