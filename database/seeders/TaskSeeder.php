<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;
class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::insert([
            [
                'name' => 'Prepare Annual Report',
                'description' => 'Compile and prepare the annual financial report.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'System Backup',
                'description' => 'Perform a full backup of all company systems.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Recruitment Drive',
                'description' => 'Organize recruitment for new developers.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
