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

            $galleries = [
                // Colombo (20 images)
                ['category_name' => 'Colombo', 'image_path' => 'gallery_20260123091522_NOqzvmz2.jpg', 'created_at' => '2026-01-26 22:04:45', 'updated_at' => '2026-01-26 22:04:45'],
                ['category_name' => 'Colombo', 'image_path' => 'gallery_20260123091535_3959v8Yo.jpg', 'created_at' => '2026-01-26 22:04:45', 'updated_at' => '2026-01-26 22:04:45'],
                ['category_name' => 'Colombo', 'image_path' => 'gallery_20260123091550_KugPtRXa.jpg', 'created_at' => '2026-01-26 22:04:45', 'updated_at' => '2026-01-26 22:04:45'],
                ['category_name' => 'Colombo', 'image_path' => 'gallery_20260123091609_hPtAZw3i.jpg', 'created_at' => '2026-01-26 22:04:45', 'updated_at' => '2026-01-26 22:04:45'],
                ['category_name' => 'Colombo', 'image_path' => 'gallery_20260123091624_qS3RwnCA.jpg', 'created_at' => '2026-01-26 22:04:45', 'updated_at' => '2026-01-26 22:04:45'],
                ['category_name' => 'Colombo', 'image_path' => 'gallery_20260123091645_UQXH5Z5n.jpg', 'created_at' => '2026-01-26 22:04:45', 'updated_at' => '2026-01-26 22:04:45'],
                ['category_name' => 'Colombo', 'image_path' => 'gallery_20260123091714_8xeNAp1M.jpg', 'created_at' => '2026-01-26 22:04:45', 'updated_at' => '2026-01-26 22:04:45'],
                ['category_name' => 'Colombo', 'image_path' => 'gallery_20260123091729_6YLCu4Km.jpg', 'created_at' => '2026-01-26 22:04:45', 'updated_at' => '2026-01-26 22:04:45'],
                ['category_name' => 'Colombo', 'image_path' => 'gallery_20260123091753_DklKvHX1.jpg', 'created_at' => '2026-01-26 22:04:45', 'updated_at' => '2026-01-26 22:04:45'],
                ['category_name' => 'Colombo', 'image_path' => 'gallery_20260123091807_ekksaDps.jpg', 'created_at' => '2026-01-26 22:04:45', 'updated_at' => '2026-01-26 22:04:45'],
                ['category_name' => 'Colombo', 'image_path' => 'gallery_20260123091833_Bi4el9L2.jpg', 'created_at' => '2026-01-26 22:04:45', 'updated_at' => '2026-01-26 22:04:45'],
                ['category_name' => 'Colombo', 'image_path' => 'gallery_20260123091848_pGN7VmCa.jpg', 'created_at' => '2026-01-26 22:04:45', 'updated_at' => '2026-01-26 22:04:45'],
                ['category_name' => 'Colombo', 'image_path' => 'gallery_20260123091915_jIx4vZmk.jpg', 'created_at' => '2026-01-26 22:04:45', 'updated_at' => '2026-01-26 22:04:45'],
                ['category_name' => 'Colombo', 'image_path' => 'gallery_20260123091929_yBTWAEKe.jpg', 'created_at' => '2026-01-26 22:04:45', 'updated_at' => '2026-01-26 22:04:45'],
                ['category_name' => 'Colombo', 'image_path' => 'gallery_20260123091945_DI7cf5RS.jpg', 'created_at' => '2026-01-26 22:04:45', 'updated_at' => '2026-01-26 22:04:45'],
                ['category_name' => 'Colombo', 'image_path' => 'gallery_20260123092015_h4PkMuTE.jpg', 'created_at' => '2026-01-26 22:04:45', 'updated_at' => '2026-01-26 22:04:45'],
                ['category_name' => 'Colombo', 'image_path' => 'gallery_20260123092048_lQgcAqd1.jpg', 'created_at' => '2026-01-26 22:04:45', 'updated_at' => '2026-01-26 22:04:45'],
                ['category_name' => 'Colombo', 'image_path' => 'gallery_20260123092059_tvAncKUR.jpg', 'created_at' => '2026-01-26 22:04:45', 'updated_at' => '2026-01-26 22:04:45'],
                ['category_name' => 'Colombo', 'image_path' => 'gallery_20260123092126_PZcKFDCC.jpg', 'created_at' => '2026-01-26 22:04:45', 'updated_at' => '2026-01-26 22:04:45'],
                ['category_name' => 'Colombo', 'image_path' => 'gallery_20260123092137_PbZtVxRj.jpg', 'created_at' => '2026-01-26 22:04:45', 'updated_at' => '2026-01-26 22:04:45'],

                // Facility & Environment
                ['category_name' => 'Facility & Environment', 'image_path' => 'gallery_20260123092155_Ume3yyEp.jpg', 'created_at' => '2026-01-26 22:04:45', 'updated_at' => '2026-01-26 22:05:33'],

                // Negombo & Kandy (newer ones)
                ['category_name' => 'Negombo', 'image_path' => 'gallery_20260127033654_2Z7BZRp6.jpg', 'created_at' => '2026-01-26 22:06:54', 'updated_at' => '2026-01-26 22:06:54'],
                ['category_name' => 'Kandy',    'image_path' => 'gallery_20260127033715_vaoFFY0Y.jpg', 'created_at' => '2026-01-26 22:07:15', 'updated_at' => '2026-01-26 22:07:15'],
            ];

            DB::table('galleries')->insert($galleries);
        }
}
