<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\FeatureTestCase;

class WorkRequestsTest extends FeatureTestCase
{
    use DatabaseMigrations;

    public function testUserCanCreateWorkRequest(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->post("/work/request", [
                "date" => Carbon::today()->toDateString(),
                "from" => Carbon::now()->toTimeString(),
                "to" => Carbon::now()->addHours(1)->toTimeString(),
            ])
            ->assertSessionHasNoErrors();

        $this->assertDatabaseCount("work_requests", 1);
        $response->assertRedirectToRoute("dashboard");
    }
}
