<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\EmploymentForm;
use App\Enums\Role;
use App\Models\HolidaysRequest;
use App\Models\User;
use App\Models\WorkRequest;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory([
            "email" => "admin@example.com",
            "password" => Hash::make("administrator"),
            "role" => Role::Administrator,
        ])->hasProfile([
            "first_name" => "Admin",
            "last_name" => "Admin",
            "position" => "IT Specialist",
            "employment_form" => EmploymentForm::EmploymentContract,
            "employment_date" => today(),
        ])->create();

        User::factory([
            "email" => "JohnDoe@example.com",
            "password" => Hash::make("employee"),
            "role" => Role::Employee,
        ])->hasProfile([
            "first_name" => "John",
            "last_name" => "Doe",
            "position" => "Social Worker",
            "employment_form" => EmploymentForm::MandateContract,
            "employment_date" => today(),
        ])->create();

        User::factory([
            "email" => "JonDeer@example.com",
            "password" => Hash::make("manager"),
            "role" => Role::Manager,
        ])->hasProfile([
            "first_name" => "Jon",
            "last_name" => "Deer",
            "position" => "HR Manager",
            "employment_form" => EmploymentForm::EmploymentContract,
            "employment_date" => today(),
        ])->create();

        HolidaysRequest::factory(17)->create();
        WorkRequest::factory(15)->create();
    }
}
