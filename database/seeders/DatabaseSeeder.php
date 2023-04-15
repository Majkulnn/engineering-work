<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            "email" => "admin@example.com",
            "password" => Hash::make("administrator"),
            "role" => Role::Administrator,
        ]);
        User::factory()->create([
            "email" => "JohnDoe@example.com",
            "password" => Hash::make("employee"),
            "role" => Role::Employee,
        ]);
        User::factory()->create([
            "email" => "JonDeer@example.com",
            "password" => Hash::make("manager"),
            "role" => Role::Manager,
        ]);
    }
}
