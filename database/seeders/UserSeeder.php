<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = \App\Models\Role::pluck('id')->all();
        $departments = \App\Models\Department::pluck('id')->all();
        \App\Models\User::factory(10)->make()->each(function ($user) use ($roles, $departments) {
            $user->role_id = $roles[array_rand($roles)];
            $user->department_id = $departments[array_rand($departments)];
            $user->save();
        });
    }
}
