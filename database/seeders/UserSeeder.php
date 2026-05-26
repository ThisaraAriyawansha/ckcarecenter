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

        // Create Admin users
        $admin = User::firstOrCreate(
            ['email' => 'admin@care365.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'branch_id' => $branches->first()->id,
            ]
        );
        $admin->syncRoles(['admin']);

        // Create Managers for each branch
        $managerNames = ['John Silva', 'Sarah Fernando', 'Michael Perera', 'Emma Jayawardena'];
        foreach ($branches->take(4) as $index => $branch) {
            $manager = User::firstOrCreate(
                ['email' => strtolower(str_replace(' ', '.', $managerNames[$index])) . '@care365.com'],
                [
                    'name' => $managerNames[$index],
                    'password' => Hash::make('password'),
                    'branch_id' => $branch->id,
                ]
            );
            $manager->syncRoles(['manager']);
        }

        // Create Career staff
        $careerNames = [
            'Nimal Bandara', 'Kumari Dissanayake', 'Sunil Gunawardena',
            'Priya Wickramasinghe', 'Ajith Rajapaksa', 'Champa Senanayake'
        ];
        foreach ($careerNames as $index => $name) {
            $career = User::firstOrCreate(
                ['email' => strtolower(str_replace(' ', '.', $name)) . '@care365.com'],
                [
                    'name' => $name,
                    'password' => Hash::make('password'),
                    'branch_id' => $branches->random()->id,
                ]
            );
            $career->syncRoles(['career']);
        }

        // Create Chef users
        $chefNames = ['Chef Ravi', 'Chef Malini', 'Chef Asanka'];
        foreach ($chefNames as $index => $name) {
            $chef = User::firstOrCreate(
                ['email' => strtolower(str_replace(' ', '.', $name)) . '@care365.com'],
                [
                    'name' => $name,
                    'password' => Hash::make('password'),
                    'branch_id' => $branches->random()->id,
                ]
            );
            $chef->syncRoles(['chef']);
        }

        // Create regular Users (Guardians)
        $guardianNames = [
            'Robert Silva', 'Lisa Fernando', 'David Perera', 'Maria Jayasinghe',
            'James Rodrigo', 'Anna Wickremaratne', 'Thomas De Silva', 'Sophie Gunasekara'
        ];
        foreach ($guardianNames as $name) {
            $user = User::firstOrCreate(
                ['email' => strtolower(str_replace(' ', '.', $name)) . '@care365.com'],
                [
                    'name' => $name,
                    'password' => Hash::make('password'),
                    'branch_id' => $branches->random()->id,
                ]
            );
            $user->syncRoles(['user']);
        }

        $this->command->info('Test users created successfully!');
        $this->command->info('');
        $this->command->info('Login credentials (all passwords: password):');
        $this->command->info('Admin: admin@care365.com');
        $this->command->info('Manager: john.silva@care365.com');
        $this->command->info('Career: nimal.bandara@care365.com');
        $this->command->info('Chef: chef.ravi@care365.com');
        $this->command->info('User: robert.silva@care365.com');
    }
}
