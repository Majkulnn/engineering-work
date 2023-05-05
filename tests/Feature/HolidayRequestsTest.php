<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Enums\HolidaysType;
use App\Models\HolidaysRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Inertia\Testing\AssertableInertia;
use Tests\FeatureTestCase;

class HolidayRequestsTest extends FeatureTestCase
{
    use DatabaseMigrations;

    public function testAdminCanSeeHolidaysRequestsList(): void
    {
        HolidaysRequest::factory(10)->create();
        $admin = User::factory()->admin()->create();

        $this->assertDatabaseCount("holidays_requests", 10);

        $this->actingAs($admin)
            ->get("/holiday/request")
            ->assertInertia(
                fn(AssertableInertia $page) => $page
                    ->component("Holidays/Request/Index")
                    ->has("holidays_requests.data", 10),
            );
    }

    public function testEmployeeCanSeeHisHolidaysRequestsList(): void
    {
        $user = User::factory()->create();
        HolidaysRequest::factory(10)->create();
        $userHolidays = HolidaysRequest::factory(5)->for($user, "creator")->create();

        $this->assertDatabaseCount("holidays_requests", 15);
        $this->assertDatabaseHas("holidays_requests", ["creator_id" => $user->id]);

        $this->actingAs($user)
            ->get("/holiday/request")
            ->assertInertia(
                fn(AssertableInertia $page) => $page
                    ->component("Holidays/Request/Index")
                    ->has("holidays_requests.data", 5),
            );
    }

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

    public function testAdminCanAcceptHolidaysRequest(): void
    {
        $admin = User::factory()->admin()->create();
        $holidayRequest = HolidaysRequest::factory()->pending()->create();

        $this->assertDatabaseHas("holidays_requests", [
            "creator_id" => $holidayRequest->creator_id,
            "start_date" => $holidayRequest->start_date,
            "end_date" => $holidayRequest->end_date,
            "type" => $holidayRequest->type,
            "status" => "PENDING",
        ]);

        $this->actingAs($admin)
            ->put("/holiday/request/{$holidayRequest->id}/accept")
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas("holidays_requests", [
            "creator_id" => $holidayRequest->creator_id,
            "start_date" => $holidayRequest->start_date,
            "end_date" => $holidayRequest->end_date,
            "type" => $holidayRequest->type,
            "status" => "ACCEPTED",
        ]);
        $this->assertDatabaseHas("holidays", [
            "user_id" => $holidayRequest->creator_id,
            "start_date" => $holidayRequest->start_date,
            "end_date" => $holidayRequest->end_date,
            "type" => $holidayRequest->type,
        ]);
    }

    public function testAdminCanRejectHolidaysRequest(): void
    {
        $admin = User::factory()->admin()->create();
        $holidayRequest = HolidaysRequest::factory()->pending()->create();

        $this->assertDatabaseHas("holidays_requests", [
            "creator_id" => $holidayRequest->creator_id,
            "start_date" => $holidayRequest->start_date,
            "end_date" => $holidayRequest->end_date,
            "type" => $holidayRequest->type,
            "status" => "PENDING",
        ]);

        $this->actingAs($admin)
            ->put("/holiday/request/{$holidayRequest->id}/reject")
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas("holidays_requests", [
            "creator_id" => $holidayRequest->creator_id,
            "start_date" => $holidayRequest->start_date,
            "end_date" => $holidayRequest->end_date,
            "type" => $holidayRequest->type,
            "status" => "REJECTED",
        ]);
    }
}
