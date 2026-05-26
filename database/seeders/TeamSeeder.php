<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    public function run(): void
    {
        Team::truncate();

        $members = [
            [
                'name'       => 'Dr. Robert Nathan',
                'bio'        => 'Owner',
                'image_path' => null,
                'active'     => true,
            ],
            [
                'name'       => 'Angela Clay',
                'bio'        => 'Pharmacist',
                'image_path' => null,
                'active'     => true,
            ],
            [
                'name'       => 'Kenzo Abigail',
                'bio'        => 'Medical Laboratory',
                'image_path' => null,
                'active'     => true,
            ],
            [
                'name'       => 'Clarine Kitty',
                'bio'        => 'Cashier',
                'image_path' => null,
                'active'     => true,
            ],
            [
                'name'       => 'Andrea Cruis',
                'bio'        => 'Nurse',
                'image_path' => null,
                'active'     => true,
            ],
        ];

        foreach ($members as $member) {
            Team::create($member);
        }
    }
}
