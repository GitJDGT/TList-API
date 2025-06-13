<?php

namespace Database\Factories;

use App\Enums\TaskStatusEnum;
use App\Models\TaskList;
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
            'description' => fake()->text(),
            'task_list_id' => TaskList::factory(),
            'image' => '/img/taskrelateimage.png',
            'status' => fake()->randomElement(TaskStatusEnum::cases())->value,
        ];
    }
}
