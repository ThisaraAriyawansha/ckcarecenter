<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class SitemapController extends Controller
{
    public function index()
    {
        $sitemapPath = public_path('sitemap.xml');

        // Check if sitemap file exists, if not generate it
        if (!file_exists($sitemapPath)) {
            Artisan::call('sitemap:generate');
        }

        // Return the sitemap file
        return response()->file($sitemapPath, [
            'Content-Type' => 'application/xml'
        ]);
    }
}
