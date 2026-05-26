<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\ContactMessage;

class ContactController extends Controller
{

    public function index(): View
    {
        return view('frontend.contact.index');
    }

    public function send(Request $request)
    {
        try {
            // Validate the form data
            $validated = $request->validate([
                'name'    => 'required|string|max:255',
                'email'   => 'required|email|max:255',
                'number'  => 'required|string|max:20',
                'subject' => 'required|string|max:255',
                'message' => 'required|string|max:5000',
            ]);

            // Save to database
            $message = ContactMessage::create([
                'name'    => $validated['name'],
                'email'   => $validated['email'],
                'number'  => $validated['number'],
                'subject' => $validated['subject'],
                'message' => $validated['message'],
                // is_read stays false by default
            ]);

            // Prepare data for email
            $data = $validated;

            // Send email
            Mail::send('emails.contact-form', ['data' => $data], function ($mail) use ($data) {
                $mail->to(env('CONTACT_FORM_RECIPIENT', 'carethree65@gmail.com'))
                     ->subject('New Contact Form Submission - ' . $data['subject'])
                     ->from(config('mail.from.address'), config('mail.from.name'));
            });

            return response()->json([
                'success' => true,
                'message' => 'Your message has been sent successfully! We will get back to you soon.'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Please fill all required fields correctly.',
                'errors'  => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('Contact form error: ' . $e->getMessage(), [
                'exception' => $e,
                'request'   => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Sorry, there was an error sending your message. Please try again later.',
                // 'error' => $e->getMessage()   ← remove or comment in production!
            ], 500);
        }
    }

}