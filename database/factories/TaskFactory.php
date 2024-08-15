<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['todo', 'in_progress', 'done']),
            'assigned_to' => \App\Models\User::factory(),
            'user_id' => \App\Models\User::factory(),
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->dateTimeBetween($startDate = $this->faker->dateTimeThisMonth(), $endDate = '+1 year')->format('Y-m-d'),
            'priority' => $this->faker->randomElement(['low', 'medium', 'high']),
        ];
    }
}
