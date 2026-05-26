<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class LeadFormController extends Controller
{
    public function index()
    {
        return view('frontend.lead-form.index');
    }



        public function submit(Request $request)
    {
        // Log the incoming request
        Log::info('=== EXIT POPUP FORM SUBMISSION START ===');
        Log::info('Request method: ' . $request->method());
        Log::info('Request URL: ' . $request->fullUrl());
        Log::info('Request data:', $request->all());
        Log::info('Request headers:', $request->headers->all());

        // Validate the request
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
                'age' => 'required|integer|min:60|max:120',
                'care_type' => 'required|string',
                'timeline' => 'required|string',
            ]);
            
            Log::info('Form validation PASSED', ['validated_data' => $validated]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation FAILED', ['errors' => $e->errors()]);
            
            return response()
                ->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $e->errors()
                ], 422)
                ->header('Content-Type', 'application/json');
        }

        // Map care type values to readable labels
        $careTypeLabels = [
            'companion' => 'Companion Care',
            'shared' => 'Shared Comfort',
            'private' => 'Private Heaven',
            'dementia' => 'Dementia/Specialized',
            'other' => 'Not Sure',
        ];

        $timelineLabels = [
            'immediate' => 'Immediately',
            '1-3' => '1–3 months',
            '3-6' => '3–6 months',
            'planning' => 'Just planning',
        ];

        $careType = $careTypeLabels[$validated['care_type']] ?? $validated['care_type'];
        $timeline = $timelineLabels[$validated['timeline']] ?? $validated['timeline'];
        $submissionTime = now()->format('Y-m-d H:i:s');

        try {
            // Data for email templates
            $adminEmailData = [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'age' => $validated['age'],
                'care_type' => $careType,
                'timeline' => $timeline,
                'submitted_at' => $submissionTime
            ];

            $userEmailData = [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'age' => $validated['age'],
                'care_type' => $careType,
                'timeline' => $timeline
            ];

            // Get admin email
            $adminEmail = env('CONTACT_FORM_RECIPIENT', 'carethree65@gmail.com');
            
            Log::info('Attempting to send ADMIN email', ['to' => $adminEmail]);
            
            // 1. Send email to admin
            Mail::send('emails.exit-popup-admin', $adminEmailData, function($message) use ($adminEmail) {
                $message->to($adminEmail)
                        ->subject('New Exit Popup Submission - Elder Care Planning Guide')
                        ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            });

            Log::info('Admin email sent SUCCESSFULLY');
            
            Log::info('Attempting to send USER email', ['to' => $validated['email']]);
            
            // 2. Send confirmation email to user
            Mail::send('emails.exit-popup-user', $userEmailData, function($message) use ($validated) {
                $message->to($validated['email'])
                        ->subject('Your Elder Care Planning Guide - Care 365')
                        ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            });

            Log::info('User email sent SUCCESSFULLY');

            // Prepare success response
            $response = [
                'success' => true,
                'message' => 'Thank you! We have received your information.'
            ];
            
            Log::info('=== PREPARING SUCCESS RESPONSE ===');
            Log::info('Response data:', $response);
            Log::info('Response will be JSON');
            
            // Return JSON response with explicit headers
            return response()
                ->json($response, 200)
                ->header('Content-Type', 'application/json')
                ->header('Cache-Control', 'no-cache, no-store, must-revalidate');

        } catch (\Exception $e) {
            Log::error('=== EXIT POPUP SUBMISSION FAILED ===');
            Log::error('Exception type: ' . get_class($e));
            Log::error('Error message: ' . $e->getMessage());
            Log::error('Error file: ' . $e->getFile());
            Log::error('Error line: ' . $e->getLine());
            Log::error('Error trace: ' . $e->getTraceAsString());
            
            $response = [
                'success' => false,
                'message' => 'Something went wrong. Please try again.',
                'error' => $e->getMessage()
            ];
            
            Log::error('Returning ERROR response', ['response' => $response]);
            
            return response()
                ->json($response, 500)
                ->header('Content-Type', 'application/json')
                ->header('Cache-Control', 'no-cache, no-store, must-revalidate');
        }
    }
}
