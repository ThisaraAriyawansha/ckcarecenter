<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctor;
use App\Models\Client;

class DoctorSeeder extends Seeder
{
    public function run(): void
    {
        $doctors = [
            [
                'name' => 'Dr. Samantha Wijesinghe',
                'specialization' => 'General Physician',
                'license_number' => 'SLMC-12345',
                'phone' => '+94 11 234 5670',
                'email' => 'dr.samantha@medicenter.lk',
                'address' => '45 Hospital Road, Colombo 07',
                'is_active' => true,
            ],
            [
                'name' => 'Dr. Rohan Jayasuriya',
                'specialization' => 'Cardiologist',
                'license_number' => 'SLMC-12346',
                'phone' => '+94 11 234 5671',
                'email' => 'dr.rohan@hearthealth.lk',
                'address' => '120 Cardiac Center, Colombo 03',
                'is_active' => true,
            ],
            [
                'name' => 'Dr. Nimal Perera',
                'specialization' => 'Geriatric Medicine',
                'license_number' => 'SLMC-12347',
                'phone' => '+94 11 234 5672',
                'email' => 'dr.nimal@eldercare.lk',
                'address' => '78 Senior Care Center, Kandy',
                'is_active' => true,
            ],
            [
                'name' => 'Dr. Malini Seneviratne',
                'specialization' => 'Neurologist',
                'license_number' => 'SLMC-12348',
                'phone' => '+94 11 234 5673',
                'email' => 'dr.malini@neuroclinic.lk',
                'address' => '23 Brain Institute, Colombo 05',
                'is_active' => true,
            ],
            [
                'name' => 'Dr. Ananda Silva',
                'specialization' => 'Orthopedic Surgeon',
                'license_number' => 'SLMC-12349',
                'phone' => '+94 11 234 5674',
                'email' => 'dr.ananda@boneclinic.lk',
                'address' => '56 Orthopedic Hospital, Negombo',
                'is_active' => true,
            ],
            [
                'name' => 'Dr. Priya Gunasekara',
                'specialization' => 'Psychiatrist',
                'license_number' => null,
                'phone' => '+94 11 234 5675',
                'email' => 'dr.priya@mentalhealth.lk',
                'address' => '89 Mental Wellness Center, Galle',
                'is_active' => true,
            ],
            [
                'name' => 'Dr. Chaminda Fernando',
                'specialization' => 'Diabetologist',
                'license_number' => 'SLMC-12351',
                'phone' => '+94 11 234 5676',
                'email' => 'dr.chaminda@diabetescenter.lk',
                'address' => '34 Diabetes Care Unit, Colombo 04',
                'is_active' => true,
            ],
        ];

        foreach ($doctors as $doctorData) {
            Doctor::firstOrCreate(
                ['email' => $doctorData['email']],
                $doctorData
            );
        }

        // Assign doctors to clients
        $clients = Client::all();
        $allDoctors = Doctor::all();

        if ($clients->isNotEmpty() && $allDoctors->isNotEmpty()) {
            foreach ($clients as $client) {
                $existingDoctorIds = $client->doctors()->pluck('doctors.id')->toArray();
                $assignedDoctors = $allDoctors->random(rand(1, 3));

                foreach ($assignedDoctors as $doctor) {
                    if (!in_array($doctor->id, $existingDoctorIds)) {
                        $client->doctors()->attach($doctor->id, [
                            'assigned_date' => today()->subDays(rand(1, 90)),
                            'notes' => 'Regular ' . strtolower($doctor->specialization) . ' consultation',
                        ]);
                    }
                }
            }
        }

        $this->command->info('Doctors created and assigned to clients successfully!');
    }
}
