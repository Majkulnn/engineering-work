<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Inertia\Testing\AssertableInertia;
use Tests\FeatureTestCase;

class WorkTimeTest extends FeatureTestCase
{
    use DatabaseMigrations;

    public function testAdminCanSeeWorkTimeList(): void
    {
        User::factory(10)->has("workTime")->create();
        $admin = User::factory()->admin()->create();

        $this->assertDatabaseCount("work_time", 10);

        $this->actingAs($admin)
            ->get("/workTime")
            ->assertInertia(
                fn(AssertableInertia $page) => $page
                    ->component("WorkTime/Index")
                    ->has("users.data", 10),
            );
    }

    /**
     * @throws \JsonException
     */
    public function testUserCanCreateWorkRequest(): void
    {
        $user = User::factory()->create();
        $from = Carbon::now();
        $to = $from->addHours(random_int(3, 12));

        $response = $this->actingAs($user)
            ->post("/work/request", [
                "date" => Carbon::today()->toDateString(),
                "from" => $from->toTimeString(),
                "to" => $to->toTimeString(),
                "hour_count" => $to->diff($from)->format("%H:%I:%S"),
            ])
            ->assertSessionHasNoErrors();

        $this->assertDatabaseCount("work_requests", 1);
        $response->assertRedirectToRoute("dashboard");
    }
}
