<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\HolidaysType;
use App\Models\Holiday;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class HolidaysFactory extends Factory
{
    protected $model = Holiday::class;

    public function definition(): array
    {
        return [
            "user_id" => User::factory(),
            "start_date" => fake()->dateTimeThisMonth,
            "end_date" => fake()->dateTimeThisMonth,
            "type" => fake()->randomElement(HolidaysType::cases()),
        ];
    }
}
