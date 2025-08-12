<?php

namespace Database\Factories;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Task;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->sentence(4),
            'priority' => $this->faker->randomElement(TaskPriority::cases()),
            'status' => $this->faker->randomElement(TaskStatus::cases()),
            'completion_date' => $this->faker->optional()->dateTimeBetween('-1 month', '+1 month'),
            'description' => $this->faker->optional()->paragraph(),
        ];
    }
}
