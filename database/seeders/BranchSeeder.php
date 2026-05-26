<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Branch;

class BranchSeeder extends Seeder
{
    public function run(): void
    {
        $branches = [
            [
                'name' => 'Main Branch - Colombo',
                'code' => 'COL-001',
                'address' => '123 Galle Road, Colombo 03, Sri Lanka',
                'phone' => '+94 11 234 5678',
                'email' => 'colombo@care365.lk',
                'is_active' => true,
            ],
            [
                'name' => 'Kandy Care Center',
                'code' => 'KDY-002',
                'address' => '456 Peradeniya Road, Kandy, Sri Lanka',
                'phone' => '+94 81 234 5678',
                'email' => 'kandy@care365.lk',
                'is_active' => true,
            ],
            [
                'name' => 'Negombo Branch',
                'code' => 'NEG-003',
                'address' => '789 Main Street, Negombo, Sri Lanka',
                'phone' => '+94 31 234 5678',
                'email' => 'negombo@care365.lk',
                'is_active' => true,
            ],
            [
                'name' => 'Galle Care Facility',
                'code' => 'GAL-004',
                'address' => '321 Fort Road, Galle, Sri Lanka',
                'phone' => '+94 91 234 5678',
                'email' => 'galle@care365.lk',
                'is_active' => true,
            ],
        ];

        foreach ($branches as $branch) {
            Branch::create($branch);
        }
    }
}
