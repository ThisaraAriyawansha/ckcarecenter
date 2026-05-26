<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gallery;
use Illuminate\Support\Facades\DB;

class GallerySeeder extends Seeder
{
    public function run(): void
        {
            // Disable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            // Clear table
            Gallery::truncate();

            // Enable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            $placeholder = 'assets/image/gallery/The-new-aged-care-landscape-cover.jpg';

            $galleries = [
                // Colombo (20 images)
                ['category_name' => 'Colombo', 'image_path' => $placeholder, 'created_at' => '2026-01-26 22:04:45', 'updated_at' => '2026-01-26 22:04:45'],
                ['category_name' => 'Colombo', 'image_path' => $placeholder, 'created_at' => '2026-01-26 22:04:45', 'updated_at' => '2026-01-26 22:04:45'],
                ['category_name' => 'Colombo', 'image_path' => $placeholder, 'created_at' => '2026-01-26 22:04:45', 'updated_at' => '2026-01-26 22:04:45'],
                ['category_name' => 'Colombo', 'image_path' => $placeholder, 'created_at' => '2026-01-26 22:04:45', 'updated_at' => '2026-01-26 22:04:45'],
                ['category_name' => 'Colombo', 'image_path' => $placeholder, 'created_at' => '2026-01-26 22:04:45', 'updated_at' => '2026-01-26 22:04:45'],
                ['category_name' => 'Colombo', 'image_path' => $placeholder, 'created_at' => '2026-01-26 22:04:45', 'updated_at' => '2026-01-26 22:04:45'],
                ['category_name' => 'Colombo', 'image_path' => $placeholder, 'created_at' => '2026-01-26 22:04:45', 'updated_at' => '2026-01-26 22:04:45'],
                ['category_name' => 'Colombo', 'image_path' => $placeholder, 'created_at' => '2026-01-26 22:04:45', 'updated_at' => '2026-01-26 22:04:45'],
                ['category_name' => 'Colombo', 'image_path' => $placeholder, 'created_at' => '2026-01-26 22:04:45', 'updated_at' => '2026-01-26 22:04:45'],
                ['category_name' => 'Colombo', 'image_path' => $placeholder, 'created_at' => '2026-01-26 22:04:45', 'updated_at' => '2026-01-26 22:04:45'],
                ['category_name' => 'Colombo', 'image_path' => $placeholder, 'created_at' => '2026-01-26 22:04:45', 'updated_at' => '2026-01-26 22:04:45'],
                ['category_name' => 'Colombo', 'image_path' => $placeholder, 'created_at' => '2026-01-26 22:04:45', 'updated_at' => '2026-01-26 22:04:45'],
                ['category_name' => 'Colombo', 'image_path' => $placeholder, 'created_at' => '2026-01-26 22:04:45', 'updated_at' => '2026-01-26 22:04:45'],
                ['category_name' => 'Colombo', 'image_path' => $placeholder, 'created_at' => '2026-01-26 22:04:45', 'updated_at' => '2026-01-26 22:04:45'],
                ['category_name' => 'Colombo', 'image_path' => $placeholder, 'created_at' => '2026-01-26 22:04:45', 'updated_at' => '2026-01-26 22:04:45'],
                ['category_name' => 'Colombo', 'image_path' => $placeholder, 'created_at' => '2026-01-26 22:04:45', 'updated_at' => '2026-01-26 22:04:45'],
                ['category_name' => 'Colombo', 'image_path' => $placeholder, 'created_at' => '2026-01-26 22:04:45', 'updated_at' => '2026-01-26 22:04:45'],
                ['category_name' => 'Colombo', 'image_path' => $placeholder, 'created_at' => '2026-01-26 22:04:45', 'updated_at' => '2026-01-26 22:04:45'],
                ['category_name' => 'Colombo', 'image_path' => $placeholder, 'created_at' => '2026-01-26 22:04:45', 'updated_at' => '2026-01-26 22:04:45'],
                ['category_name' => 'Colombo', 'image_path' => $placeholder, 'created_at' => '2026-01-26 22:04:45', 'updated_at' => '2026-01-26 22:04:45'],

                // Facility & Environment
                ['category_name' => 'Facility & Environment', 'image_path' => $placeholder, 'created_at' => '2026-01-26 22:04:45', 'updated_at' => '2026-01-26 22:05:33'],

                // Negombo & Kandy
                ['category_name' => 'Negombo', 'image_path' => $placeholder, 'created_at' => '2026-01-26 22:06:54', 'updated_at' => '2026-01-26 22:06:54'],
                ['category_name' => 'Kandy',    'image_path' => $placeholder, 'created_at' => '2026-01-26 22:07:15', 'updated_at' => '2026-01-26 22:07:15'],
            ];

            DB::table('galleries')->insert($galleries);
        }
}
