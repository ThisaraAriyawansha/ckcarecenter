<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Blog;
use App\Models\Service;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ServicesController;

class RouteResolver
{
    public function handle(Request $request, Closure $next): Response
    {
        $slug = $request->segment(1);
        
        // If it's empty (home page) or excluded routes, skip
        if (empty($slug) || $this->isExcludedRoute($slug)) {
            return $next($request);
        }
        
        // First check if it's a blog
        $blog = Blog::where('title_slug', $slug)
                   ->where('is_public', true)
                   ->first();
        
        if ($blog) {
            $controller = app(BlogController::class);
            return $controller->blogdetails($blog);
        }
        
        // Then check if it's a service
        $service = Service::where('title_slug', $slug)
                         ->where('is_public', true)
                         ->first();
        
        if ($service) {
            $controller = app(ServicesController::class);
            return $controller->servicedetails($slug);
        }
        
        // If not found, continue to next middleware
        return $next($request);
    }
    
    private function isExcludedRoute(string $slug): bool
    {
        $excludedRoutes = [
            'admin', 'login', 'register', 'logout', 'password',
            'api', 'storage', 'public', 'assets', 'css', 'js',
            'img', 'images', 'fonts', 'vendor', 'uploads'
        ];
        
        return in_array($slug, $excludedRoutes);
    }
}