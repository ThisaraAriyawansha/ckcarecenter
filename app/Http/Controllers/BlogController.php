<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index(): View
    {
        // Get all public blogs, ordered by date
        $blogs = Blog::where('is_public', true)
                    ->orderBy('date', 'desc')
                    ->paginate(9);
        
        return view('frontend.blog.index', compact('blogs'));
    }

    public function blogdetails($slug): View
    {
        // Find blog by slug
        $blog = Blog::where('title_slug', $slug)
                    ->where('is_public', true)
                    ->with(['category', 'tags'])
                    ->firstOrFail();
        
        // Get related blogs from same category (excluding current one)
        $relatedBlogs = Blog::where('is_public', true)
                        ->where('id', '!=', $blog->id)
                        ->when($blog->category_id, function($query) use ($blog) {
                            return $query->where('category_id', $blog->category_id);
                        })
                        ->inRandomOrder()
                        ->take(3)
                        ->with('category')
                        ->get();
        
        // Return view with blog data
        // Meta tags are handled by @section in the view
        return view('frontend.blogdetails.index', compact('blog', 'relatedBlogs'));
    }
}