<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        Testimonial::truncate();

        $testimonials = [
            [
                'name' => 'Ruwan de Silva',
                'position' => 'senior Software Engineer',
                'rating' => 5,
                'message' => "Elder Care Home's compassionate team understood my mom's needs, giving me confidence in my decision for her care.",
                'image_path' => 'default_testimonial_img.png',
                'is_public' => true,
            ],
            [
                'name' => 'Silvia Peoiris',
                'position' => 'Bank Officer',
                'rating' => 5,
                'message' => 'Moving my dad to ElderCare Home was easy thanks to their personalized approach and welcoming environment.',
                'image_path' => 'default_testimonial_img.png',
                'is_public' => true,
            ],
            [
                'name' => 'Jeewan Mahanama',
                'position' => 'Accountant',
                'rating' => 4,
                'message' => "Eager to explore options for my loved one's care, I stumbled upon ElderCare's digital platform. Little did I know, this virtual portal would become my lifeline, offering a wealth of information and support as I navigated the journey ahead.",
                'image_path' => 'default_testimonial_img.png',
                'is_public' => true,
            ],
            [
                'name' => 'Srimani Alwis',
                'position' => 'Lawyer',
                'rating' => 5,
                'message' => 'Thanks to Care 365s digital platform, I\'ve gained invaluable insights into elder care options. From informative website with interactive tools, it\'s empowered me to make informed decisions with confidence, ensuring the best possible outcome for my loved one.',
                'image_path' => 'default_testimonial_img.png',
                'is_public' => true,
            ],
            
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
