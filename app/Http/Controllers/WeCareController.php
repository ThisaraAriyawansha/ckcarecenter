<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Faq;
use App\Models\CareHome;
use App\Models\DayPackage;

class WeCareController extends Controller
{
    /**
     * Display the We Care page
     */
    public function index()
    {
        // Get packages with their features
        $packages = Package::with(['features' => function($query) {
            $query->where('is_active', true);
        }])
        ->where('status', 'active')
        ->orderBy('price_lkr', 'asc')
        ->get();

        // Get random 8 FAQs with visibility
        $faqs = Faq::where('visibility', true)
                   ->inRandomOrder()
                   ->take(5)
                   ->get();

                // Get all public Care Homes
        $carehomes = CareHome::where('is_public', true)
                            ->orderBy('created_at', 'desc')
                            ->get();

        $dayPackages = DayPackage::where('active', true)
                                 ->orderBy('price', 'asc')
                                 ->get();


        return view('frontend.wecare.index', compact('packages', 'faqs','carehomes', 'dayPackages'));

    }
}
