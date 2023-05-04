<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Enums\HolidaysType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\FeatureTestCase;

class HolidayRequestsTest extends FeatureTestCase
{
    use DatabaseMigrations;

    public function testUserCanCreateHolidayRequest(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->post("/holiday/request", [
                "start_date" => Carbon::today()->toDateString(),
                "end_date" => Carbon::today()->toDateString(),
                "type" => HolidaysType::Unpaid->value,
            ])
            ->assertSessionHasNoErrors();

        $this->assertDatabaseCount("holidays_requests", 1);
        $response->assertRedirectToRoute("dashboard");
    }
}
