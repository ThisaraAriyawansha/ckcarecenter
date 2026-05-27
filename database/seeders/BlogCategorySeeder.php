<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class BlogCategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Category::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $categories = [
            ['id' => 7,  'name' => 'Senior Living',   'slug' => 'senior-living',   'description' => 'Articles about senior living facilities and retirement communities.', 'is_active' => true],
            ['id' => 8,  'name' => 'Elder Care',       'slug' => 'elder-care',       'description' => 'Guides and tips on elder care for families.', 'is_active' => true],
            ['id' => 9,  'name' => 'Health & Wellness','slug' => 'health-wellness',  'description' => 'Health and wellness topics for seniors.', 'is_active' => true],
            ['id' => 10, 'name' => 'News',              'slug' => 'news',             'description' => 'Latest news and updates from C & K Home Nursing and Care Center.', 'is_active' => true],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        $this->command->info('✅ Blog categories seeded successfully!');
    }
}
