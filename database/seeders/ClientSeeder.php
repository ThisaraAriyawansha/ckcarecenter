<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\Guardian;
use App\Models\User;
use App\Models\Branch;
use Carbon\Carbon;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        $branches = Branch::all();
        $careers = User::whereHas('roles', fn($q) => $q->where('name', 'career'))->get();
        $guardians = Guardian::all();

        if ($branches->isEmpty() || $careers->isEmpty()) {
            $this->command->warn('Required data missing. Ensure branches and users are seeded first.');
            return;
        }

        $clients = [
            [
                'reg_number' => 'CLT-2024-001',
                'name' => 'Somawathi Karunaratne',
                'gender' => 'female',
                'dob' => Carbon::parse('1945-03-15'),
                'age' => Carbon::parse('1945-03-15')->age,
                'height_cm' => 155.5,
                'weight_kg' => 62.0,
                'waist_circumference' => 85.0,
                'hip_circumference' => 95.0,
                'co_morbidities_risk_factors' => 'Type 2 Diabetes, Hypertension, Mild Dementia',
                'complaints' => [
                    ['date' => '2024-12-01', 'complaint' => 'Experiencing joint pain in knees'],
                    ['date' => '2024-12-15', 'complaint' => 'Occasional dizziness in the morning'],
                ],
            ],
            [
                'reg_number' => 'CLT-2024-002',
                'name' => 'Piyasena Wickramasinghe',
                'gender' => 'male',
                'dob' => Carbon::parse('1938-07-22'),
                'age' => Carbon::parse('1938-07-22')->age,
                'height_cm' => 168.0,
                'weight_kg' => 70.5,
                'waist_circumference' => 92.0,
                'hip_circumference' => 98.0,
                'co_morbidities_risk_factors' => 'Heart Disease, High Cholesterol, Arthritis',
                'complaints' => [
                    ['date' => '2024-11-20', 'complaint' => 'Chest discomfort after meals'],
                ],
            ],
            [
                'reg_number' => 'CLT-2024-003',
                'name' => 'Mangala Jayawardena',
                'gender' => 'female',
                'dob' => Carbon::parse('1950-11-08'),
                'age' => Carbon::parse('1950-11-08')->age,
                'height_cm' => 150.0,
                'weight_kg' => 55.0,
                'waist_circumference' => 78.0,
                'hip_circumference' => 88.0,
                'co_morbidities_risk_factors' => 'Osteoporosis, Vitamin D Deficiency',
                'complaints' => [
                    ['date' => '2024-12-10', 'complaint' => 'Lower back pain worsening'],
                    ['date' => '2024-12-18', 'complaint' => 'Difficulty sleeping at night'],
                ],
            ],
            [
                'reg_number' => 'CLT-2024-004',
                'name' => 'Ariyawansa Perera',
                'gender' => 'male',
                'dob' => Carbon::parse('1942-05-30'),
                'age' => Carbon::parse('1942-05-30')->age,
                'height_cm' => 172.0,
                'weight_kg' => 75.0,
                'waist_circumference' => 95.0,
                'hip_circumference' => 100.0,
                'co_morbidities_risk_factors' => 'COPD, Former Smoker, Hypertension',
                'complaints' => [
                    ['date' => '2024-12-05', 'complaint' => 'Shortness of breath during activities'],
                ],
            ],
            [
                'reg_number' => 'CLT-2024-005',
                'name' => 'Kusumawathi Silva',
                'gender' => 'female',
                'dob' => Carbon::parse('1948-09-12'),
                'age' => Carbon::parse('1948-09-12')->age,
                'height_cm' => 158.0,
                'weight_kg' => 60.0,
                'waist_circumference' => 80.0,
                'hip_circumference' => 90.0,
                'co_morbidities_risk_factors' => 'Mild Depression, Anxiety, Insomnia',
                'complaints' => [
                    ['date' => '2024-12-12', 'complaint' => 'Feeling anxious and restless'],
                ],
            ],
            [
                'reg_number' => 'CLT-2024-006',
                'name' => 'Bandula Fernando',
                'gender' => 'male',
                'dob' => Carbon::parse('1940-02-18'),
                'age' => Carbon::parse('1940-02-18')->age,
                'height_cm' => 165.0,
                'weight_kg' => 68.0,
                'waist_circumference' => 88.0,
                'hip_circumference' => 96.0,
                'co_morbidities_risk_factors' => 'Parkinsons Disease, Diabetes',
                'complaints' => [
                    ['date' => '2024-12-08', 'complaint' => 'Tremors increasing in hands'],
                    ['date' => '2024-12-20', 'complaint' => 'Balance issues when walking'],
                ],
            ],
        ];

        foreach ($clients as $index => $clientData) {
            $client = Client::firstOrCreate(
                ['reg_number' => $clientData['reg_number']],
                [
                    'date' => today()->subDays(rand(30, 180)),
                    'name' => $clientData['name'],
                    'gender' => $clientData['gender'],
                    'dob' => $clientData['dob'],
                    'age' => $clientData['age'],
                    'height_cm' => $clientData['height_cm'],
                    'weight_kg' => $clientData['weight_kg'],
                    'bmi' => round($clientData['weight_kg'] / (($clientData['height_cm'] / 100) ** 2), 2),
                    'waist_circumference' => $clientData['waist_circumference'],
                    'hip_circumference' => $clientData['hip_circumference'],
                    'co_morbidities_risk_factors' => $clientData['co_morbidities_risk_factors'],
                    'complaints' => $clientData['complaints'],
                    'officer_in_charge_id' => $careers->random()->id,
                    'branch_id' => $branches->random()->id,
                ]
            );

            if ($client->wasRecentlyCreated && $guardians->isNotEmpty()) {
                $client->guardians()->attach(
                    $guardians->random(min(rand(1, 2), $guardians->count()))->pluck('id')->toArray()
                );
            }
        }

        $this->command->info('Clients created successfully with guardians!');
    }
}
