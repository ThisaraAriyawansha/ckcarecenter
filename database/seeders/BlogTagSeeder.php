<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class BlogTagSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('blog_tag')->truncate();
        Tag::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $tags = [
            ['id' => 12, 'name' => 'Sri Lanka',        'slug' => 'sri-lanka',         'is_active' => true],
            ['id' => 22, 'name' => 'Senior Living',     'slug' => 'senior-living',     'is_active' => true],
            ['id' => 23, 'name' => 'Elder Care',        'slug' => 'elder-care',        'is_active' => true],
            ['id' => 24, 'name' => 'Retirement Homes',  'slug' => 'retirement-homes',  'is_active' => true],
            ['id' => 25, 'name' => 'Nursing Care',      'slug' => 'nursing-care',      'is_active' => true],
            ['id' => 26, 'name' => 'Healthcare',        'slug' => 'healthcare',        'is_active' => true],
            ['id' => 27, 'name' => 'Family Care',       'slug' => 'family-care',       'is_active' => true],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }

        $this->command->info('✅ Blog tags seeded successfully!');
    }
}
