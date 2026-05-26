<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('package_features')->delete();
        DB::table('packages')->delete();

        // ────────────────────────────────────────────────
        // Package 2: Companion Care
        // ────────────────────────────────────────────────
        $package2 = DB::table('packages')->insertGetId([
            'title'            => 'Companion Care',
            'title_slug'       => 'companion-care',
            'price_lkr'        => 85000.00,
            'price_usd'        => 275.00,
            'currency'         => 'LKR',
            'room_type'        => 'Shared by 3 persons',
            'sharing_capacity' => 3,
            'bathroom_type'    => 'mixed',
            'status'           => 'active',
            'created_at'       => '2026-01-26 01:10:32',
            'updated_at'       => '2026-01-26 01:10:32',
        ]);

        $features2 = [
            'Shared by 3 persons',
            'Wardrobe/Side Table',
            'Single Bed with double layer Mattress/Mirror+Pillow+Bedding',
            'Shared Bathroom',
            'Modern designed interior',
        ];

        foreach ($features2 as $feature) {
            DB::table('package_features')->insert([
                'package_id' => $package2,
                'feature'    => $feature,
                'is_active'  => 1,
                'created_at' => '2026-01-26 01:10:32',
                'updated_at' => '2026-01-26 01:10:32',
            ]);
        }

        // ────────────────────────────────────────────────
        // Package 3: Shared Comfort
        // ────────────────────────────────────────────────
        $package3 = DB::table('packages')->insertGetId([
            'title'            => 'Shared Comfort',
            'title_slug'       => 'shared-comfort',
            'price_lkr'        => 125000.00,
            'price_usd'        => 400.00,
            'currency'         => 'LKR',
            'room_type'        => 'Shared by 2 persons',
            'sharing_capacity' => 2,
            'bathroom_type'    => 'shared',
            'status'           => 'active',
            'created_at'       => '2026-01-26 01:17:16',
            'updated_at'       => '2026-01-26 01:17:16',
        ]);

        $features3 = [
            'Individual Room : Shared by 2 persons',
            'Wardrobe/Side Table',
            'Double Bed with double layer Mattress+Pillow+Bedding',
            'In Suit or Outside shared Bathroom (Depending on the location)',
            'Common Library / TV Lobby',
            'Weekend News Papers',
            'Monthly activity plans & access to our “Fun Time Club”',
        ];

        foreach ($features3 as $feature) {
            DB::table('package_features')->insert([
                'package_id' => $package3,
                'feature'    => $feature,
                'is_active'  => 1,
                'created_at' => '2026-01-26 01:17:16',
                'updated_at' => '2026-01-26 01:17:16',
            ]);
        }

        // ────────────────────────────────────────────────
        // Package 4: Private Heaven
        // ────────────────────────────────────────────────
        $package4 = DB::table('packages')->insertGetId([
            'title'            => 'Private Heaven',
            'title_slug'       => 'private-heaven',
            'price_lkr'        => 175000.00,
            'price_usd'        => 575.00,
            'currency'         => 'LKR',
            'room_type'        => 'Individual Room',
            'sharing_capacity' => 1,
            'bathroom_type'    => 'ensuite',
            'status'           => 'active',
            'created_at'       => '2026-01-26 01:19:34',
            'updated_at'       => '2026-01-26 01:19:34',
        ]);

        $features4 = [
            'Individual Room',
            'Wardrobe/ Mirror/Chair with Mini Table',
            'In Suit Bathroom',
            'Separate Double Bed with double layer Mattress + Pillow + Bedding',
            'PEO TV Facility',
            'Additional Medication Management (T&C Apply)',
            'Extra Meal Package & Switch Menu x 2 (T&C Apply)',
            'Birthday Surprise service with Pik Bokz',
            'Mini Fridge',
            'Air Conditioning (T&C Apply)',
            'Door Bell Communication System',
            'Common Library/ TV Lobby / Garden',
            'Weekend News Papers',
            'Monthly activity plans & access to our “Fun Time Club”',
        ];

        foreach ($features4 as $feature) {
            DB::table('package_features')->insert([
                'package_id' => $package4,
                'feature'    => $feature,
                'is_active'  => 1,
                'created_at' => '2026-01-26 01:19:34',
                'updated_at' => '2026-01-26 01:19:34',
            ]);
        }
    }
}