<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\DayPackage;

class DayPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DayPackage::truncate();
        // Option A: Using model (recommended - uses fillable & timestamps)
        $packages = [
            [
                'name'       => 'Companion Care Package',
                'price'      => 5000.00,
                'active'     => true,
                'created_at' => '2026-02-05 05:20:45',
                'updated_at' => '2026-02-05 05:20:45',
            ],
            [
                'name'       => 'Shared Comfort Package',
                'price'      => 6500.00,
                'active'     => true,
                'created_at' => '2026-02-05 05:20:55',
                'updated_at' => '2026-02-05 05:20:55',
            ],
            [
                'name'       => 'Private Heaven Package',
                'price'      => 9500.00,
                'active'     => true,
                'created_at' => '2026-02-05 05:21:06',
                'updated_at' => '2026-02-05 05:23:25',
            ],
        ];

        foreach ($packages as $package) {
            DayPackage::updateOrCreate(
                ['name' => $package['name']],  // prevent duplicates if re-run
                $package
            );
        }

        // Option B: If you prefer raw insert (exact copy of your dump)
        // DB::table('day_packages')->insert([
        //     [
        //         'id'         => 1,
        //         'name'       => 'Companion Care Package',
        //         'price'      => 5000.00,
        //         'active'     => 1,
        //         'created_at' => '2026-02-05 05:20:45',
        //         'updated_at' => '2026-02-05 05:20:45',
        //     ],
        //     // ... other two rows
        // ]);
    }
}