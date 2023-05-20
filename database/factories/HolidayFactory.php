<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\HolidaysType;
use App\Models\Holiday;
use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;

class HolidayFactory extends Factory
{
    protected $model = Holiday::class;

    public function definition(): array
    {
        $from = CarbonImmutable::create(fake()->dateTimeThisYear);
        return [
            "user_id" => User::factory(),
            "start_date" => $from,
            "end_date" => $from->addDays(15),
            "type" => fake()->randomElement(HolidaysType::cases()),
            "days_count" => date_diff($from, $from->addDays(15))->days,
        ];
    }
}
