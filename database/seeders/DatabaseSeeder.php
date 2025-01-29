<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Bob',
            'email' => 'bob@gmail.com',
            'password' => 'bob123'
        ]);

        User::factory()->create([
            'name' => 'John',
            'email' => 'john@gmail.com',
            'password' => 'john123'
        ]);


        Task::query()->insert([
            [
                'user_id' => $user->id,
                'name' => 'Task 1',
                'description' => 'Task 1 description',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $user->id,
                'name' => 'Task 2',
                'description' => 'Task 2 description',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $user->id,
                'name' => 'Task 3',
                'description' => 'Task 3 description',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}
