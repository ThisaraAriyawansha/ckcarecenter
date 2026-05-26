<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClientOuting;
use App\Models\Client;
use App\Models\User;
use Carbon\Carbon;

class ClientOutingSeeder extends Seeder
{
    public function run(): void
    {
        $clients = Client::all();
        $careers = User::whereHas('roles', fn($q) => $q->where('name', 'career'))->get();
        $managers = User::whereHas('roles', fn($q) => $q->whereIn('name', ['admin', 'manager']))->get();

        if ($clients->isEmpty() || $careers->isEmpty() || $managers->isEmpty()) {
            $this->command->warn('Required data missing. Please seed clients and users first.');
            return;
        }

        $reasons = [
            'Medical appointment at hospital',
            'Family visit',
            'Shopping with family',
            'Dental checkup',
            'Eye examination',
            'Physical therapy session',
            'Blood test at laboratory',
            'Religious ceremony',
            'Birthday celebration with family',
            'Walk in the park',
        ];

        $destinations = [
            'General Hospital Colombo',
            'Private Clinic',
            'Family Home',
            'Shopping Mall',
            'Dental Clinic',
            'Eye Care Center',
            'Physiotherapy Center',
            'Temple',
            'Restaurant',
            'Public Park',
        ];

        $transportModes = ['Car', 'Wheelchair', 'Walking', 'Taxi', 'Ambulance', 'Family Vehicle'];

        foreach ($clients as $client) {
            if ($client->outings()->exists()) {
                continue;
            }

            // Create 3-7 outings for each client
            $outingCount = rand(3, 7);

            for ($i = 0; $i < $outingCount; $i++) {
                $date = today()->subDays(rand(1, 60));
                $timeOut = Carbon::parse($date)->setTime(rand(8, 15), rand(0, 59));

                // 70% of outings are returned, 20% still out, 10% cancelled
                $statusRand = rand(1, 100);
                if ($statusRand <= 70) {
                    $status = 'returned';
                    $timeIn = (clone $timeOut)->addHours(rand(2, 6))->addMinutes(rand(0, 59));
                } elseif ($statusRand <= 90) {
                    $status = 'out';
                    $timeIn = null;
                } else {
                    $status = 'cancelled';
                    $timeIn = null;
                }

                $reasonIndex = array_rand($reasons);

                ClientOuting::create([
                    'client_id' => $client->id,
                    'date' => $date,
                    'time_out' => $timeOut->format('H:i:s'),
                    'time_in' => $timeIn ? $timeIn->format('H:i:s') : null,
                    'reason' => $reasons[$reasonIndex],
                    'destination' => $destinations[$reasonIndex],
                    'accompanied_by' => rand(0, 1) ? $careers->random()->id : null,
                    'transport_mode' => $transportModes[array_rand($transportModes)],
                    'status' => $status,
                    'notes' => rand(0, 1) ? 'Everything went smoothly' : null,
                    'authorized_by' => $managers->random()->id,
                ]);
            }
        }

        $this->command->info('Client outings created successfully!');
    }
}
