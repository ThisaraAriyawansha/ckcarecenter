<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Service;
use App\Models\Faq;
use App\Models\Package;
use App\Models\Event;




class ServicesController extends Controller
{
    
    // In your existing controller method, add events
    public function index(): View
    {
        $services = Service::where('is_public', true)
                          ->orderBy('created_at', 'desc')
                          ->get();
        

        
        return view('frontend.services.index', compact('services'));
    }

    public function servicedetails($slug = null): View
    {
        // If no slug provided, show first service or 404
        if (!$slug) {
            $service = Service::where('is_public', true)->first();
            if (!$service) {
                abort(404);
            }
            return redirect()->route('servicedetails', ['slug' => $service->title_slug]);
        }
        
        // Find service by slug
        $service = Service::where('title_slug', $slug)
                         ->where('is_public', true)
                         ->firstOrFail();
        
        // Get related services (excluding current one)
        $relatedServices = Service::where('is_public', true)
                                 ->where('id', '!=', $service->id)
                                 ->inRandomOrder()
                                 ->take(3)
                                 ->get();
        
        return view('frontend.servicedetails.index', compact('service', 'relatedServices'));
    }



}