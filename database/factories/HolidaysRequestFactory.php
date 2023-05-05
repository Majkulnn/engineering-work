<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\HolidayRequestStatus;
use App\Enums\HolidaysType;
use App\Models\HolidaysRequest;
use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;

class HolidaysRequestFactory extends Factory
{
    protected $model = HolidaysRequest::class;

    public function definition(): array
    {
        $from = CarbonImmutable::create(fake()->dateTimeThisYear());
        return [
            "creator_id" => User::factory(),
            "start_date" => $from,
            "end_date" => $from->addDays(12),
            "type" => fake()->randomElement(HolidaysType::cases()),
            "status" => fake()->randomElement(HolidayRequestStatus::cases()),
            "reason" => fake()->boolean ? fake()->realText(50) : null,
        ];
    }

    public function pending()
    {
        return $this->state([
            "status" => HolidayRequestStatus::Pending,
        ]);
    }
}
