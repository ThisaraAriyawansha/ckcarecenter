<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Service;
use App\Models\Whoweare;
use App\Models\CareHome;
use App\Models\Testimonial;
use App\Models\Team;

class AboutUsController extends Controller
{
    public function index(): View
    {

        $teamMembers = Team::where('active', true)
                           ->orderBy('id')  
                           ->get();
        
        return view('frontend.about.index', compact('teamMembers'));
    }
}