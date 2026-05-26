<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ChefChecklist;
use App\Models\User;
use Carbon\Carbon;

class ChefChecklistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all chefs
        $chefs = User::whereHas('roles', fn($q) => $q->where('name', 'chef'))->get();

        if ($chefs->isEmpty()) {
            $this->command->warn('No chefs found. Please create chef users first.');
            return;
        }

        // Get a random manager for signing some checklists
        $manager = User::whereHas('roles', fn($q) => $q->whereIn('name', ['admin', 'manager']))->first();

        // Create checklists for the last 30 days
        foreach ($chefs as $chef) {
            for ($i = 0; $i < 30; $i++) {
                $date = Carbon::now()->subDays($i);

                // Skip some days randomly to make it realistic
                if (rand(0, 10) > 8) {
                    continue;
                }

                ChefChecklist::firstOrCreate(
                    ['chef_id' => $chef->id, 'date' => $date->toDateString()],
                    [
                        'manager_id' => rand(0, 1) ? $manager?->id : null,
                        'week_number' => $date->weekOfMonth,
                        'month' => $date->format('F Y'),
                        'dining_tasks' => $this->getRandomTasks(['wipe_table', 'sweep_floor', 'clean_windows', 'clean_baseboards', 'set_table']),
                        'kitchen_dinning_tasks' => $this->getRandomTasks(['clean_kitchen', 'vacuum_spills', 'wash_dishes', 'laundry', 'take_trash', 'make_bed', 'wipe_bathroom', 'clean_appliances', 'sanitize_switch', 'mail_bills']),
                        'bathroom_tasks' => $this->getRandomTasks(['clean_windows_mirror', 'dust_surface', 'empty_trash', 'make_bed', 'flip_mattress']),
                        'common_area_tasks' => $this->getRandomTasks(['clean_drains', 'sanitize_basin', 'clean_fixtures', 'sweep_mop', 'vacuum_corners', 'tv_lobby', 'garden_outside', 'reports']),
                        'chef_signed' => true,
                        'chef_signed_at' => $date->setTime(rand(16, 18), rand(0, 59)),
                        'manager_signed' => rand(0, 1),
                        'manager_signed_at' => rand(0, 1) ? $date->setTime(rand(19, 21), rand(0, 59)) : null,
                        'notes' => rand(0, 5) > 3 ? 'All tasks completed successfully.' : null,
                    ]
                );
            }
        }

        $this->command->info('Chef checklists seeded successfully!');
    }

    /**
     * Get random tasks from the list
     */
    private function getRandomTasks(array $tasks): array
    {
        $selectedCount = rand(ceil(count($tasks) * 0.6), count($tasks));
        shuffle($tasks);
        return array_slice($tasks, 0, $selectedCount);
    }
}
