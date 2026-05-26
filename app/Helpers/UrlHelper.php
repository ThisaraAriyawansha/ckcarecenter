<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UrlHelper
{
    /**
     * Get URL for any content model (Blog, Service, etc.)
     */
    public static function contentUrl($model)
    {
        if (!$model || !isset($model->title_slug)) {
            return '#';
        }
        
        return url('/' . $model->title_slug);
    }
    
    /**
     * Get URL for Blog
     */
    public static function blogUrl($blog)
    {
        return self::contentUrl($blog);
    }
    
    /**
     * Get URL for Service
     */
    public static function serviceUrl($service)
    {
        return self::contentUrl($service);
    }
    
    /**
     * Get image URL with fallback
     */
    public static function imageUrl($path, $type = 'blog')
    {
        if (!$path) {
            return self::placeholderImage($type);
        }
        
        // Check if path already has http/https
        if (str_starts_with($path, 'http')) {
            return $path;
        }
        
        // Check if path starts with storage/
        if (str_starts_with($path, 'storage/')) {
            return asset($path);
        }
        
        // Use the appropriate storage disk for each type
        $disks = [
            'blog'        => 'blog_public',
            'service'     => 'services_public',
            'testimonial' => 'testimonial_public',
        ];

        if (isset($disks[$type])) {
            return Storage::disk($disks[$type])->url($path);
        }

        return asset('uploads/' . $path);
    }
    
    /**
     * Get placeholder image
     */
    public static function placeholderImage($type = 'blog')
    {
        $placeholders = [
            'blog' => 'assets/image/blog/blog_20260120084845_cZMzvwCu.jpg',
            'service' => 'assets/img/Home-img/service-placeholder.jpg',
            'testimonial' => 'assets/img/testimonial/avatar-placeholder.jpg',
            'default' => 'assets/image/blog/blog_20260120084845_cZMzvwCu.jpg',
        ];
        
        $path = $placeholders[$type] ?? $placeholders['default'];
        return asset($path);
    }
    
    /**
     * Get formatted date
     */
    public static function formattedDate($date, $format = 'd M, Y')
    {
        if (!$date) {
            return '';
        }
        
        try {
            if ($date instanceof Carbon) {
                return $date->format($format);
            }
            
            return Carbon::parse($date)->format($format);
        } catch (\Exception $e) {
            return '';
        }
    }
    
    /**
     * Get excerpt with limit
     */
    public static function excerpt($text, $limit = 100, $end = '...')
    {
        if (strlen($text) <= $limit) {
            return $text;
        }
        
        return substr($text, 0, $limit) . $end;
    }
}