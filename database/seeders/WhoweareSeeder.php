<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Whoweare;
use Illuminate\Support\Facades\DB;

class WhoweareSeeder extends Seeder
{
    public function run(): void
    {
        // Disable FK checks (safe practice)
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Clear existing data
        Whoweare::truncate();

        // Enable FK checks again
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $data = [
            [
                'title' => 'Our Vision',
                'description' => 'To be the No. 1 care home in Sri Lanka, pioneering innovative care solutions that seamlessly integrate modern comforts and digital services for unparalleled experiences.',
                'image_path' => 'whoweare_20260123084231_4UrKwm2d.jpg',
                'display_order' => 1,
                'is_public' => true,
            ],
            [
                'title' => 'Our Mission',
                'description' => 'At Care365, we are committed to redefining care by blending contemporary living standards with personalized digital services. Through constant innovation and dedication, we strive to exceed expectations, fostering holistic well-being and creating lasting memories as the premier care provider in Sri Lanka.',
                'image_path' => 'whoweare_20260123084315_IVyKPISN.jpg',
                'display_order' => 999,
                'is_public' => true,
            ],
        ];

        foreach ($data as $item) {
            Whoweare::create($item);
        }

        $this->command->info('✅ Who We Are section seeded successfully!');
    }
}
