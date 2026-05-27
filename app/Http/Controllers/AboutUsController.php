<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Faq;
use App\Models\Service;
use App\Models\Whoweare;
use App\Models\CareHome;
use App\Models\Testimonial;
use App\Models\Team;
use App\Models\Package;
use App\Models\DayPackage;

class AboutUsController extends Controller
{
    public function index(): View
    {
        $packages = Package::active()->with(['features' => function ($q) {
            $q->active();
        }])->get();

        $dayPackages = DayPackage::where('active', true)->get();

        $services = Service::where('is_public', true)
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        $teamMembers = Team::where('active', true)
            ->orderBy('created_at', 'asc')
            ->get();

        $testimonials = Testimonial::where('is_public', true)
            ->inRandomOrder()
            ->take(6)
            ->get();

        $faqs = Faq::where('visibility', 'public')
            ->orderBy('created_at', 'asc')
            ->take(6)
            ->get();

        return view('frontend.about.index', compact(
            'packages',
            'dayPackages',
            'services',
            'teamMembers',
            'testimonials',
            'faqs'
        ));
    }
}