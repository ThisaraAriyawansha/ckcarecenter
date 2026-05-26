<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Service;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
public function boot(): void
{
    // Share services only with footer views
    View::composer(
        ['frontend.components.footer', 'layouts.footer', 'partials.footer'], 
        function ($view) {
            // Get ALL public services once (most performant)
            // Cache for 1 hour to improve TTFB
            $publicServices = Cache::remember('footer_services', 3600, function () {
                return Service::where('is_public', true)
                    ->select('title', 'title_slug')
                    ->get();
            });

            // Shuffle once and take what we need
            $shuffled = $publicServices->shuffle();

            // Only share footer_services (no header_services)
            $view->with([
                'footer_services' => $shuffled->take(5),
            ]);
        }
    );
}
}