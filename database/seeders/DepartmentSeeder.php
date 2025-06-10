<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::insert([
            [
                'name' => 'Management',
                'description' => 'Handles company management and administration.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'IT',
                'description' => 'Responsible for IT infrastructure and support.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'HR',
                'description' => 'Human Resources department.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
