<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Role;
use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WorkRequest>
 */
class WorkRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $from = CarbonImmutable::create(fake()->time("H:i:s"));
        return [
            "creator_id" => User::query()->whereIn("role", [Role::Employee, Role::Manager])->get()->random(),
            "date" => fake()->unique()->dateTimeThisMonth,
            "from" => $from,
            "to" => $from->addHours(7),
        ];
    }
}
