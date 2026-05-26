<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SuccessStory;

class SuccessStorySeeder extends Seeder
{
    public function run(): void
    {
        // Clear table first
        SuccessStory::truncate();

        $stories = [
            [
                'id' => 1,
                'title' => 'A Peaceful Life at Care 365',
                'image' => '01KFMF6Z2EN9AKEMSGEJQVKXDP.png',
                'image_alt' => 'Senior resident enjoying a peaceful day at Care 365',
                'layout_type' => 'single',
                'sort_order' => 1,
                'is_active' => true,
                'created_at' => '2026-01-22 22:06:54',
                'updated_at' => '2026-01-22 22:13:49',
            ],
            [
                'id' => 2,
                'title' => 'Compassionate Daily Care',
                'image' => '01KFMF7KDQ8J8WST2F4MDS245D.jpg',
                'image_alt' => 'Caregiver assisting an elderly resident with daily activities',
                'layout_type' => 'paired_left',
                'sort_order' => 2,
                'is_active' => true,
                'created_at' => '2026-01-22 22:06:54',
                'updated_at' => '2026-01-22 22:14:10',
            ],
            [
                'id' => 3,
                'title' => '24/7 Medical Support',
                'image' => '01KFMFA6W3M6EGRXDX0Q183QW8.jpg',
                'image_alt' => 'Nurse providing medical care to a senior resident',
                'layout_type' => 'paired_right',
                'sort_order' => 3,
                'is_active' => true,
                'created_at' => '2026-01-22 22:06:54',
                'updated_at' => '2026-01-22 22:15:36',
            ],
            [
                'id' => 4,
                'title' => 'Healthy & Happy Living',
                'image' => '01KFMFXSANPFTWEQ1XAR7GS0HE.jpg',
                'image_alt' => 'Elderly residents enjoying a wellness activity together',
                'layout_type' => 'paired_left',
                'sort_order' => 6,
                'is_active' => true,
                'created_at' => '2026-01-22 22:06:54',
                'updated_at' => '2026-01-22 22:26:17',
            ],
            [
                'id' => 5,
                'title' => 'Comfortable & Safe Environment',
                'image' => '01KFMFB72BZ9ESJS6JG2MRVVFF.jpg',
                'image_alt' => 'Comfortable senior living room at Care 365',
                'layout_type' => 'paired_right',
                'sort_order' => 5,
                'is_active' => true,
                'created_at' => '2026-01-22 22:06:54',
                'updated_at' => '2026-01-22 22:16:09',
            ],
            [
                'id' => 6,
                'title' => 'Smiles That Matter',
                'image' => '01KFMFBR09NCVNQTC2T03YG13Y.jpg',
                'image_alt' => 'Happy elderly resident smiling with caregiver',
                'layout_type' => 'single',
                'sort_order' => 4,
                'is_active' => true,
                'created_at' => '2026-01-22 22:06:54',
                'updated_at' => '2026-01-22 22:19:02',
            ],
        ];

        foreach ($stories as $story) {
            SuccessStory::create($story);
        }
    }
}
