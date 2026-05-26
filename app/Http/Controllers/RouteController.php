<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Blog;
use App\Models\Service;

class RouteController extends Controller
{
    public function resolve($slug): View
    {
        // First, check if it's a blog
        $blog = Blog::where('title_slug', $slug)
                   ->where('is_public', true)
                   ->first();
        
        if ($blog) {
            $relatedBlogs = Blog::where('is_public', true)
                               ->where('id', '!=', $blog->id)
                               ->inRandomOrder()
                               ->take(3)
                               ->get();
            
            return view('frontend.blogdetails.index', [
                'blog' => $blog,
                'relatedBlogs' => $relatedBlogs
            ]);
        }
        
        // Then check if it's a service
        $service = Service::where('title_slug', $slug)
                         ->where('is_public', true)
                         ->first();
        
        if ($service) {
            $relatedServices = Service::where('is_public', true)
                                     ->where('id', '!=', $service->id)
                                     ->inRandomOrder()
                                     ->take(3)
                                     ->get();
            
            return view('frontend.servicedetails.index', [
                'service' => $service,
                'relatedServices' => $relatedServices
            ]);
        }
        
        // If neither, show 404
        abort(404, "Page not found");
    }
}