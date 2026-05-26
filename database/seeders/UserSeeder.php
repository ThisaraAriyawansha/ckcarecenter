<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Branch;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $branches = Branch::all();

        if ($branches->isEmpty()) {
            $this->command->warn('No branches found. Please run BranchSeeder first.');
            return;
        }

        // Admin User
        $admin = User::firstOrCreate(
            ['email' => 'admin@ckhomecare.com'],
            [
                'name' => 'C & K Administrator',
                'password' => Hash::make('password'),
                'branch_id' => $branches->first()->id,
            ]
        );

        $admin->syncRoles(['admin']);

        // Branch Managers
        $managerNames = [
            'Kasun Silva',
            'Nadeesha Fernando',
            'Ravindu Perera',
            'Tharushi Jayawardena'
        ];

        foreach ($branches->take(4) as $index => $branch) {

            $manager = User::firstOrCreate(
                ['email' => strtolower(str_replace(' ', '.', $managerNames[$index])) . '@ckhomecare.com'],
                [
                    'name' => $managerNames[$index],
                    'password' => Hash::make('password'),
                    'branch_id' => $branch->id,
                ]
            );

            $manager->syncRoles(['manager']);
        }

        // Care Staff
        $careStaffNames = [
            'Amila Bandara',
            'Sanduni Wickramasinghe',
            'Chathura Gunawardena',
            'Dinithi Rajapaksha',
            'Saman Kumara',
            'Ishani Senanayake'
        ];

        foreach ($careStaffNames as $name) {

            $staff = User::firstOrCreate(
                ['email' => strtolower(str_replace(' ', '.', $name)) . '@ckhomecare.com'],
                [
                    'name' => $name,
                    'password' => Hash::make('password'),
                    'branch_id' => $branches->random()->id,
                ]
            );

            $staff->syncRoles(['career']);
        }

        // Nurses
        $nurseNames = [
            'Nurse Malini',
            'Nurse Roshan',
            'Nurse Dilani'
        ];

        foreach ($nurseNames as $name) {

            $nurse = User::firstOrCreate(
                ['email' => strtolower(str_replace(' ', '.', $name)) . '@ckhomecare.com'],
                [
                    'name' => $name,
                    'password' => Hash::make('password'),
                    'branch_id' => $branches->random()->id,
                ]
            );

            $nurse->syncRoles(['nurse']);
        }

        // Guardians / Clients
        $clientNames = [
            'Ruwan Silva',
            'Dilani Perera',
            'Niroshan Fernando',
            'Sachini Jayasinghe',
            'Malith Rodrigo',
            'Nethmi Wickramaratne'
        ];

        foreach ($clientNames as $name) {

            $user = User::firstOrCreate(
                ['email' => strtolower(str_replace(' ', '.', $name)) . '@ckhomecare.com'],
                [
                    'name' => $name,
                    'password' => Hash::make('password'),
                    'branch_id' => $branches->random()->id,
                ]
            );

            $user->syncRoles(['user']);
        }

        $this->command->info('C & K Home Nursing and Care Center users created successfully!');
        $this->command->info('');
        $this->command->info('Login credentials (all passwords: password)');
        $this->command->info('Admin: admin@ckhomecare.com');
        $this->command->info('Manager: kasun.silva@ckhomecare.com');
        $this->command->info('Care Staff: amila.bandara@ckhomecare.com');
        $this->command->info('Nurse: nurse.malini@ckhomecare.com');
        $this->command->info('User: ruwan.silva@ckhomecare.com');
    }
}