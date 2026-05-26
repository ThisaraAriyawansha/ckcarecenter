<?php

// =====================================
// Controller: app/Http/Controllers/EventController.php
// =====================================

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class EventController extends Controller
{


    /**
     * Get events for a specific month (API endpoint)
     */
    public function getMonthEvents(Request $request): JsonResponse
    {
        $request->validate([
            'month' => 'required|integer|between:1,12',
            'year' => 'required|integer|min:2024'
        ]);

        $month = $request->input('month');
        $year = $request->input('year');

        // Get first and last day of the month
        $startDate = date('Y-m-01', strtotime("$year-$month-01"));
        $endDate = date('Y-m-t', strtotime("$year-$month-01"));

        // Fetch events for the month
        $events = Event::where('is_active', true)
                      ->whereBetween('event_date', [$startDate, $endDate])
                      ->orderBy('event_date', 'asc')
                      ->orderBy('event_time', 'asc')
                      ->get()
                      ->map(function ($event) {
                          return [
                              'id' => $event->id,
                              'title' => $event->title,
                              'description' => $event->description,
                              'event_date' => $event->event_date->format('Y-m-d'),
                              'event_time' => $event->event_time ? $event->event_time->format('H:i') : null,
                              'location' => $event->location,
                          ];
                      });

        return response()->json([
            'success' => true,
            'month' => $month,
            'year' => $year,
            'events' => $events
        ]);
    }

    /**
     * Get all upcoming events (optional)
     */
    public function getUpcomingEvents(): JsonResponse
    {
        $events = Event::where('is_active', true)
                      ->where('event_date', '>=', now()->format('Y-m-d'))
                      ->orderBy('event_date', 'asc')
                      ->orderBy('event_time', 'asc')
                      ->take(10)
                      ->get();

        return response()->json([
            'success' => true,
            'events' => $events
        ]);
    }
}