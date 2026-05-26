<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Testimonial;

class TestimonialsController extends Controller
{
    public function index(): View
    {
        // Get all public testimonials
        $testimonials = Testimonial::where('is_public', true)
                                  ->orderBy('created_at', 'desc')
                                  ->get();
        
        return view('frontend.testimonials.index', compact('testimonials'));
    }
}