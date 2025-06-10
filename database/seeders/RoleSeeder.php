<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Department;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = Department::pluck('id', 'name');
        Role::insert([
            [
                'name' => 'Manager',
                'description' => 'Manages a department.',
                'department_id' => $departments['Management'] ?? 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Developer',
                'description' => 'Develops and maintains software.',
                'department_id' => $departments['IT'] ?? 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'HR Specialist',
                'description' => 'Handles HR tasks.',
                'department_id' => $departments['HR'] ?? 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
