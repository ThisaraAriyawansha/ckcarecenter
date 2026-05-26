<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClientDailyChecklist;
use App\Models\Client;
use App\Models\User;
use Carbon\Carbon;

class ClientDailyChecklistSeeder extends Seeder
{
    public function run(): void
    {
        $clients = Client::all();
        $careers = User::whereHas('roles', fn($q) => $q->where('name', 'career'))->get();

        if ($clients->isEmpty() || $careers->isEmpty()) {
            $this->command->warn('Required data missing. Please seed clients and careers first.');
            return;
        }

        $tasks = ClientDailyChecklist::getChecklistTasks();

        // Generate checklists for the last 7 days for each client
        foreach ($clients as $client) {
            for ($day = 6; $day >= 0; $day--) {
                $date = now()->subDays($day);
                $dayOfWeek = $date->format('l');

                foreach ($tasks as $category => $categoryTasks) {
                    foreach ($categoryTasks as $taskKey => $taskName) {
                        // Randomly complete ~70% of tasks
                        $completed = rand(1, 100) <= 70;
                        $completedBy = $completed ? $careers->random()->id : null;
                        $completedAt = $completed ? $date->copy()->setTime(rand(8, 18), rand(0, 59)) : null;

                        ClientDailyChecklist::firstOrCreate(
                            [
                                'client_id' => $client->id,
                                'date' => $date->toDateString(),
                                'category' => $category,
                                'task_key' => $taskKey,
                            ],
                            [
                                'task_name' => $taskName,
                                'day_of_week' => $dayOfWeek,
                                'completed' => $completed,
                                'completed_by' => $completedBy,
                                'completed_at' => $completedAt,
                                'notes' => $completed && rand(1, 100) <= 30 ? 'Completed successfully' : null,
                            ]
                        );
                    }
                }
            }
        }

        $this->command->info('Daily checklists created successfully!');
        $this->command->info('Created ' . ClientDailyChecklist::count() . ' checklist entries for ' . $clients->count() . ' clients over 7 days.');
    }
}
