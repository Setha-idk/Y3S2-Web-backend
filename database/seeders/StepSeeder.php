<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = \App\Models\Task::pluck('id', 'name');
        \App\Models\Step::insert([
            [
                'task_id' => $tasks['Prepare Annual Report'] ?? 1,
                'name' => 'Collect Data',
                'description' => 'Gather all financial data from departments.',
                'status' => 'in_progress',
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'task_id' => $tasks['Prepare Annual Report'] ?? 1,
                'name' => 'Draft Report',
                'description' => 'Draft the initial version of the report.',
                'status' => 'in_progress',
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'task_id' => $tasks['System Backup'] ?? 2,
                'name' => 'Notify Users',
                'description' => 'Notify all users about the scheduled backup.',
                'status' => 'in_progress',
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
