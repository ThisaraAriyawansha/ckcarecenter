<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Faq;
use App\Models\Testimonial;


class FaqController extends Controller
{
    public function index(): View
    {
        // Get all FAQs where visibility is true
        $faqs = Faq::where('visibility', true)
                   ->orderBy('created_at', 'desc')
                   ->get();

        $testimonials = Testimonial::where('is_public', true)
                            ->inRandomOrder()
                             ->take(4)
                            ->get();                   
        
        return view('frontend.faq.index', compact('faqs', 'testimonials'));
    }
}