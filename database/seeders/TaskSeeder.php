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
        Task::factory()
            ->count(2)
            ->hasSteps(3)
            ->create();

        Task::factory()
            ->count(3)
            ->hasSteps(5)
            ->create();
    }
}
