<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\EmploymentForm;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    protected $model = Profile::class;

    public function definition(): array
    {
        return [
            "user_id" => User::factory(),
            "first_name" => fake()->firstName(),
            "last_name" => fake()->lastName(),
            "employment_form" => fake()->randomElement(EmploymentForm::cases()),
            "position" => fake()->jobTitle(),
            "employment_date" => fake()->date("Y-m-d", "now"),
        ];
    }
}
