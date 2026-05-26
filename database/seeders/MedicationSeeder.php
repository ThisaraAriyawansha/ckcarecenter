<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Medication;
use App\Models\MedicationRecord;
use App\Models\Client;
use App\Models\User;
use Carbon\Carbon;

class MedicationSeeder extends Seeder
{
    public function run(): void
    {
        $clients = Client::all();
        $careers = User::whereHas('roles', fn($q) => $q->where('name', 'career'))->get();

        if ($clients->isEmpty() || $careers->isEmpty()) {
            $this->command->warn('Clients or careers not found. Please seed those first.');
            return;
        }

        $commonMedications = [
            ['drug' => 'Metformin', 'dosage' => '500mg', 'condition' => 'Diabetes'],
            ['drug' => 'Amlodipine', 'dosage' => '5mg', 'condition' => 'Hypertension'],
            ['drug' => 'Atorvastatin', 'dosage' => '20mg', 'condition' => 'High Cholesterol'],
            ['drug' => 'Aspirin', 'dosage' => '75mg', 'condition' => 'Heart Disease'],
            ['drug' => 'Omeprazole', 'dosage' => '20mg', 'condition' => 'Acid Reflux'],
            ['drug' => 'Paracetamol', 'dosage' => '500mg', 'condition' => 'Pain Relief'],
            ['drug' => 'Levothyroxine', 'dosage' => '50mcg', 'condition' => 'Thyroid'],
            ['drug' => 'Losartan', 'dosage' => '50mg', 'condition' => 'Blood Pressure'],
            ['drug' => 'Gabapentin', 'dosage' => '300mg', 'condition' => 'Nerve Pain'],
            ['drug' => 'Vitamin D3', 'dosage' => '1000IU', 'condition' => 'Vitamin Deficiency'],
        ];

        $frequencies = ['morning', 'afternoon', 'evening', 'morning_afternoon', 'morning_evening', 'afternoon_evening', 'all_three'];

        foreach ($clients as $client) {
            if ($client->medications()->exists()) {
                continue;
            }

            // Give each client 2-5 medications
            $medicationCount = rand(2, 5);
            $selectedMeds = collect($commonMedications)->random($medicationCount);

            foreach ($selectedMeds as $med) {
                $medication = Medication::create([
                    'client_id' => $client->id,
                    'drug_name' => $med['drug'],
                    'dosage' => $med['dosage'],
                    'frequency' => $frequencies[array_rand($frequencies)],
                    'start_date' => today()->subDays(rand(30, 90)),
                    'end_date' => rand(0, 1) ? today()->addDays(rand(30, 180)) : null,
                    'instructions' => 'Take ' . $med['dosage'] . ' for ' . $med['condition'],
                    'is_active' => true,
                ]);

                // Generate medication records for the last 7 days
                $this->generateMedicationRecords($medication, $careers);
            }
        }

        $this->command->info('Medications and records created successfully!');
    }

    private function generateMedicationRecords(Medication $medication, $careers): void
    {
        $frequencyTimes = [
            'morning' => ['morning'],
            'afternoon' => ['afternoon'],
            'evening' => ['evening'],
            'morning_afternoon' => ['morning', 'afternoon'],
            'morning_evening' => ['morning', 'evening'],
            'afternoon_evening' => ['afternoon', 'evening'],
            'all_three' => ['morning', 'afternoon', 'evening'],
        ];

        $times = $frequencyTimes[$medication->frequency];

        // Generate records for last 7 days
        for ($i = 6; $i >= 0; $i--) {
            $date = today()->subDays($i);

            foreach ($times as $timeOfDay) {
                // 80% chance medication was given
                $wasGiven = rand(1, 100) <= 80;

                $record = MedicationRecord::create([
                    'medication_id' => $medication->id,
                    'client_id' => $medication->client_id,
                    'date' => $date,
                    'time_of_day' => $timeOfDay,
                    'given' => $wasGiven,
                    'given_by' => $wasGiven ? $careers->random()->id : null,
                    'given_at' => $wasGiven ? $this->getTimeForPeriod($timeOfDay) : null,
                    'notes' => $wasGiven ? null : ($i == 0 ? 'Patient refused' : null),
                ]);
            }
        }
    }

    private function getTimeForPeriod(string $timeOfDay): string
    {
        return match($timeOfDay) {
            'morning' => '08:' . str_pad(rand(0, 59), 2, '0', STR_PAD_LEFT),
            'afternoon' => '14:' . str_pad(rand(0, 59), 2, '0', STR_PAD_LEFT),
            'evening' => '20:' . str_pad(rand(0, 59), 2, '0', STR_PAD_LEFT),
            default => '12:00',
        };
    }
}
