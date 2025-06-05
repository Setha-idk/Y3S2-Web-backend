<?php

namespace Database\Factories;

use App\Models\History;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class HistoryFactory extends Factory
{
    protected $model = History::class;

    public function definition(): array
    {
        return [
            'action_time' => $this->faker->dateTimeThisYear(),
            'user_name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'name' => $this->faker->word(),
            'employee_id' => User::factory(),
            'action' => $this->faker->randomElement(['created', 'updated', 'deleted']),
            'description' => $this->faker->sentence(),
        ];
    }
}
