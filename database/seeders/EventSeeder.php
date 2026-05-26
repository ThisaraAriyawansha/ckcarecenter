<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Optional: Clear existing events (safe since no foreign keys)
        DB::table('events')->truncate();

        $events = [
            // January 2026
            [
                'title'       => 'New Year Reflection & Blessings',
                'description' => 'A calm group discussion where residents reflect on the past year and share hopes for the new year. Herbal tea and light snacks provided.',
                'event_date'  => '2026-01-05',
                'event_time'  => '10:00:00',
                'location'    => 'TV Lounge',
                'order'       => 1,
                'is_active'   => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'title'       => 'Gentle Chair Stretching',
                'description' => 'Slow, guided stretching exercises done while seated. Designed to improve circulation and relaxation.',
                'event_date'  => '2026-01-07',
                'event_time'  => '09:30:00',
                'location'    => 'Garden',
                'order'       => 2,
                'is_active'   => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],

            // February 2026
            [
                'title'       => 'Friendship & Memories Tea Time',
                'description' => 'Residents share fond memories and enjoy tea together in a warm, friendly atmosphere.',
                'event_date'  => '2026-02-14',
                'event_time'  => '14:00:00',
                'location'    => 'Activity Room',
                'order'       => 1,
                'is_active'   => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'title'       => 'Indoor Gardening Session',
                'description' => 'Simple indoor plant care demonstration. Residents can water plants and learn basic care tips.',
                'event_date'  => '2026-02-20',
                'event_time'  => '10:30:00',
                'location'    => 'Garden Patio',
                'order'       => 2,
                'is_active'   => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],

            // March 2026
            [
                'title'       => 'Women’s Appreciation Gathering',
                'description' => 'A peaceful gathering honoring women with soft music, short talks, and appreciation moments.',
                'event_date'  => '2026-03-08',
                'event_time'  => '15:00:00',
                'location'    => 'Main Hall',
                'order'       => 1,
                'is_active'   => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'title'       => 'Traditional Board & Table Games',
                'description' => 'Light games such as carrom, cards, and memory games to encourage social interaction.',
                'event_date'  => '2026-03-31',
                'event_time'  => '09:00:00',
                'location'    => 'Activity Room',
                'order'       => 2,
                'is_active'   => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],

            // April 2026
            [
                'title'       => 'Avurudu Sweets Tasting Session',
                'description' => 'Staff demonstrate traditional Avurudu sweets while residents enjoy tasting in moderation.',
                'event_date'  => '2026-04-10',
                'event_time'  => '10:00:00',
                'location'    => 'Dining Area',
                'order'       => 1,
                'is_active'   => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'title'       => 'Classic Movie & Relax Time',
                'description' => 'A calm afternoon watching a classic local movie with light refreshments.',
                'event_date'  => '2026-04-18',
                'event_time'  => '14:30:00',
                'location'    => 'TV Lounge',
                'order'       => 2,
                'is_active'   => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],

            // May 2026
            [
                'title'       => 'Vesak Lantern Viewing & Crafts',
                'description' => 'Simple Vesak-themed craft activities and lantern viewing to promote relaxation and mindfulness.',
                'event_date'  => '2026-05-15',
                'event_time'  => '09:30:00',
                'location'    => 'Activity Room',
                'order'       => 1,
                'is_active'   => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ];


        DB::table('events')->insert($events);

        $this->command->info('Events seeded successfully! ' . count($events) . ' sample events added.');
    }
}