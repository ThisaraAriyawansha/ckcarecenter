<?php

namespace App\Http\Controllers;
use App\Models\Testimonial;


use Illuminate\Http\Request;

class HowWorkController extends Controller
{
     public function index()
    {
          $testimonials = Testimonial::where('is_public', true)
                                ->inRandomOrder()
                                ->get();
                                
        return view('frontend.howwork.index', compact('testimonials')); 

    }
    

}
