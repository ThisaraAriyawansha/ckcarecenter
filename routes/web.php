<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\TestimonialsController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\PackagesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\CareersController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\TermsConditionController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\WeCareController;
use App\Http\Controllers\DigitalWellbeingController;
use App\Http\Controllers\HowWorkController;
use App\Http\Controllers\ExitPopupController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\LeadFormController;



// Home Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// About Us Page
Route::get('about/', [AboutUsController::class, 'index'])->name('about');

// Blog Page
Route::get('blog/', [BlogController::class, 'index'])->name('blog');
//Route::get('/blog/{id}', [BlogController::class, 'blogdetails'])->name('blogdetails');

// Services Page
Route::get('services/', [ServicesController::class, 'index'])->name('services');

// Contact Page
Route::get('contact/', [ContactController::class, 'index'])->name('contact');

// Gallery Page
Route::get('gallery/', [GalleryController::class, 'index'])->name('gallery');

// Testimonials Page
Route::get('testimonials/', [TestimonialsController::class, 'index'])->name('testimonial');

// FAQ Page
Route::get('faq/', [FaqController::class, 'index'])->name('faq');

// Team Page
Route::get('team/', [TeamController::class, 'index'])->name('team');

// Packages Page
Route::get('packages/', [PackagesController::class, 'index'])->name('packages');

// Careers Page
Route::get('careers/', [CareersController::class, 'index'])->name('careers');

//Send Contact Mail
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

// Privacy Policy Page
Route::get('privacy-policy/', [PrivacyPolicyController::class, 'index'])->name('privacy-policy');

// Terms and Conditions Page
Route::get('terms-and-conditions/', [TermsConditionController::class, 'index'])->name('termsconditions');

//Get Events by Month 
Route::get('/events', [EventController::class, 'getMonthEvents']);
Route::get('/events/upcoming', [EventController::class, 'getUpcomingEvents']);

// We Care Page
Route::get('/we-care', [WeCareController::class, 'index'])->name('wecare');

// Digital Wellbeing Page
Route::get('/digital-wellbeing', [DigitalWellbeingController::class, 'index'])->name('digitalwellbeing');


// How It Works Page
Route::get('/how-it-works', [HowWorkController::class, 'index'])->name('howitworks');


// Lead Magnet
Route::post('/exit-popup/submit', [ExitPopupController::class, 'submit'])->name('exit-popup.submit');

// Sitemap
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// Lead Form
Route::get('/lead-form', [LeadFormController::class, 'index'])->name('lead-form');
Route::get('/lead-form/submit', [LeadFormController::class, 'submit'])->name('lead-form.submit');



// Catch-all dynamic routes - MUST BE LAST
Route::get('/{slug}', [RouteController::class, 'resolve']);



