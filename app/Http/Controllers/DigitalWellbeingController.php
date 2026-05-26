<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;


class DigitalWellbeingController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('is_public', true)
                    ->orderBy('date', 'desc')
                    ->take(3)
                    ->get();        

        return view('frontend.digitalwellbeing.index', compact('blogs'));
    }

}
