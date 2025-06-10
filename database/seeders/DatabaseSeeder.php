<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (DB::getDriverName() === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('users')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
        // Seed departments and roles first so foreign keys exist
        $this->call([
            DepartmentSeeder::class,
            RoleSeeder::class,
        ]);

        $departments = \App\Models\Department::pluck('id', 'name');
        $roles = \App\Models\Role::pluck('id', 'name');
        \App\Models\User::insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('12345678'),
                'access_level' => 'admin',
                'role_id' => $roles['Manager'] ?? 1,
                'department_id' => $departments['Management'] ?? 1,
                'profile_picture' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'IT Staff',
                'email' => 'it@gmail.com',
                'password' => bcrypt('12345678'),
                'access_level' => 'user',
                'role_id' => $roles['Developer'] ?? 2,
                'department_id' => $departments['IT'] ?? 2,
                'profile_picture' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Call remaining seeders
        $this->call([
            TaskSeeder::class,
            StepSeeder::class,
            UserSeeder::class,
            HistorySeeder::class
        ]);
    }
}
