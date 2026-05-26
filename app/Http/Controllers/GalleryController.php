<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(Request $request): View
    {
        $galleries = Gallery::orderBy('id', 'desc')->get();
        
        $categories = Gallery::select('category_name')
            ->distinct()
            ->orderBy('category_name')
            ->pluck('category_name');
        
        // Get the location filter from request or session
        $filterLocation = $request->session()->get('gallery_filter_location', null);
        
        // If coming from homes page with location, filter galleries
        if ($filterLocation) {
            $galleries = Gallery::where('category_name', $filterLocation)
                ->orderBy('id', 'desc')
                ->get();
        }
        
        return view('frontend.gallery.index', compact('galleries', 'categories', 'filterLocation'));
    }
}