<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()
            ->count(5)
            ->has(Task::factory()->count(10))
            ->create();
    }
}
