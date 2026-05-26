@extends('layouts.frontend')

{{-- Dynamic SEO Meta Tags for Blog Detail Page --}}
@section('title', $blog->meta_title ?: ($blog->title . ' - Care365'))

@section('meta_author', $blog->name ?: 'Care365')

@section('meta_description', $blog->meta_description ?: Str::limit(strip_tags($blog->description), 160))

@section('meta_keywords', $blog->meta_keywords ?: ($blog->tags->pluck('name')->implode(', ') ?: 'care365, elderly care, retirement home'))

{{-- OG Image - Uses blog image if available --}}
@section('og_image', $blog->image_path ? asset('blog_img/' . $blog->image_path) : asset('assets/img/logo.png'))

@section('og_type', 'article')

@section('content')

    @include('frontend.blogdetails.hero')
    @include('frontend.blogdetails.blogdetails')








@endsection

