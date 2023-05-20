<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Enums\HolidaysType;
use App\Models\Holiday;
use App\Models\HolidaysRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Inertia\Testing\AssertableInertia;
use Tests\FeatureTestCase;

class HolidaysTest extends FeatureTestCase
{
    use DatabaseMigrations;

    public function testAdminCanSeeHolidaysList(): void
    {
        Holiday::factory(10)->create();
        $admin = User::factory()->admin()->create();

        $this->assertDatabaseCount("holidays", 10);

        $this->actingAs($admin)
            ->get("/holidays")
            ->assertInertia(
                fn(AssertableInertia $page) => $page
                    ->component("Holidays/Index")
                    ->has("holidays", 10),
            );
    }

    public function testEmployeeCanSeeHisHolidaysRequestsList(): void
    {
        $user = User::factory()->create();
        Holiday::factory(10)->create();
        $userHolidays = Holiday::factory(5)->for($user)->create();

        $this->assertDatabaseCount("holidays", 15);
        $this->assertDatabaseHas("holidays", ["user_id" => $user->id]);

        $this->actingAs($user)
            ->get("/holidays")
            ->assertInertia(
                fn(AssertableInertia $page) => $page
                    ->component("Holidays/Index")
                    ->has("holidays", 5),
            );
    }

    public function testAdminCanSeeHolidaysSummary(): void
    {
        $date = Carbon::now()->toDateString();
        User::factory(10)->hasHolidays(['start_date' => $date])->create();
        $admin = User::factory()->admin()->create();

        $this->assertDatabaseCount("holidays", 10);
        $this->assertDatabaseCount("users", 11);

        $this->actingAs($admin)
            ->get("/holiday/summary")
            ->assertInertia(
                fn(AssertableInertia $page) => $page
                    ->component("Holidays/Summary")
                    ->has('users.data', 11)
                    ->has('holidays', 10),
            );
    }
}
