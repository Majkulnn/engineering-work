<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\User;
use App\Models\WorkTime;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkTimeFactory extends Factory
{
    protected $model = WorkTime::class;

    public function definition(): array
    {
        $from = CarbonImmutable::create(fake()->dateTimeThisMonth);
        $to = $from->addHours(5)->addRealMinutes(30);
        return [
            "user_id" => User::factory(),
            "start" => $from->toDateTime(),
            "end" => $to->toDateTime(),
            "hour_count" => $to->diff($from)->format("%H:%I:%S"),
            "position" => fake()->jobTitle,
        ];
    }
}
