<?php

use App\Helpers\UrlHelper;

if (!function_exists('content_url')) {
    /**
     * Get content URL
     */
    function content_url($model)
    {
        return UrlHelper::contentUrl($model);
    }
}

if (!function_exists('blog_url')) {
    /**
     * Get blog URL
     */
    function blog_url($blog)
    {
        return UrlHelper::blogUrl($blog);
    }
}

if (!function_exists('service_url')) {
    /**
     * Get service URL
     */
    function service_url($service)
    {
        return UrlHelper::serviceUrl($service);
    }
}

if (!function_exists('image_url')) {
    /**
     * Get image URL with fallback
     */
    function image_url($path, $type = 'blog')
    {
        return UrlHelper::imageUrl($path, $type);
    }
}

if (!function_exists('placeholder_image')) {
    /**
     * Get placeholder image
     */
    function placeholder_image($type = 'blog')
    {
        return UrlHelper::placeholderImage($type);
    }
}

if (!function_exists('excerpt')) {
    /**
     * Get excerpt with limit
     */
    function excerpt($text, $limit = 100, $end = '...')
    {
        return UrlHelper::excerpt($text, $limit, $end);
    }
}

if (!function_exists('format_date')) {
    /**
     * Format date
     */
    function format_date($date, $format = 'd M, Y')
    {
        return UrlHelper::formattedDate($date, $format);
    }
}

if (!function_exists('active_menu')) {
    /**
     * Check if menu is active
     */
    function active_menu($route, $activeClass = 'active', $defaultClass = '')
    {
        return request()->routeIs($route) ? $activeClass : $defaultClass;
    }
}

if (!function_exists('is_route')) {
    /**
     * Check if current route matches
     */
    function is_route($route)
    {
        return request()->routeIs($route);
    }
}