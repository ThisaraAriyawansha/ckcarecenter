<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;
use Illuminate\Support\Facades\DB;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks to allow truncate
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Clear pivot and blog tables
        DB::table('blog_tag')->truncate();
        Blog::truncate();

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Blogs data
        $blogs = [
            [
                'id' => 20,
                'title' => 'Ultimate Guide: Senior Living Facilities Sri Lanka',
                'title_slug' => 'senior-living-facilities-sri-lanka',
                'meta_title' => 'Senior Living Facilities Sri Lanka | Ultimate 2025 Guide',
                'meta_description' => 'Discover the best senior living facilities in Sri Lanka for your elderly loved ones.',
                'meta_keywords' => 'senior living sri lanka, elder care sri lanka, retirement homes sri lanka',
                'category_id' => 7,
                'name' => 'Care365 Team',
                'date' => '2025-06-06',
                'description' => 'Senior living facilities Sri Lanka have moved from being a niche option to an essential solution for families.',
                'image_path' => 'blog_20260123074610_2eA3NnEt.jpg',
                'is_public' => true,
                'created_at' => '2026-01-23 07:46:10',
                'updated_at' => '2026-01-23 07:57:05',
            ],
            [
                'id' => 21,
                'title' => 'Ultimate Elder Care Guide: 7 Essentials for Sri Lankan Families',
                'title_slug' => 'elder-care-sri-lanka-guide',
                'meta_title' => 'Elder Care in Sri Lanka | 7 Essential Tips for Families',
                'meta_description' => 'Learn the 7 essentials of elder care in Sri Lanka to ensure safety and dignity for your parents.',
                'meta_keywords' => 'elder care in sri lanka, elderly care sri lanka, senior care tips',
                'category_id' => 8,
                'name' => 'Care365 Team',
                'date' => '2025-06-06',
                'description' => 'Elder care in Sri Lanka is no longer a distant concern. Ensure aging parents enjoy safety, dignity, and joy.',
                'image_path' => 'blog_20260123075319_Rphcdin4.jpg',
                'is_public' => true,
                'created_at' => '2026-01-23 07:53:19',
                'updated_at' => '2026-01-23 07:57:20',
            ],
            [
                'id' => 22,
                'title' => 'Top-Rated Best Retirement Homes for Seniors in Sri Lanka',
                'title_slug' => 'best-retirement-homes-for-seniors-in-sri-lanka',
                'meta_title' => 'Best Retirement Homes for Seniors in Sri Lanka | 2025 Guide',
                'meta_description' => 'Explore the best retirement homes for seniors in Sri Lanka and make the right choice for your loved ones.',
                'meta_keywords' => 'best retirement homes sri lanka, retirement homes sri lanka, senior living sri lanka',
                'category_id' => 7,
                'name' => 'Care365 Team',
                'date' => '2025-06-06',
                'description' => 'Best retirement homes for seniors in Sri Lanka are essential for families seeking secure and dignified living.',
                'image_path' => 'blog_20260123075647_4lpnyKbe.png',
                'is_public' => true,
                'created_at' => '2026-01-23 07:56:47',
                'updated_at' => '2026-01-23 07:56:47',
            ],
        ];

        // Insert blogs
        foreach ($blogs as $blog) {
            Blog::create($blog);
        }

        // Blog tags pivot table
        $blogTags = [
            20 => [22, 23, 24, 25, 26],
            21 => [23, 12, 22, 27],
            22 => [24, 25, 23, 26, 27],
        ];

        foreach ($blogTags as $blogId => $tags) {
            DB::table('blog_tag')->insert(
                array_map(fn($tagId) => [
                    'blog_id' => $blogId,
                    'tag_id' => $tagId,
                ], $tags)
            );
        }

        $this->command->info('✅ Blogs and blog_tag pivot seeded successfully!');
    }
}
