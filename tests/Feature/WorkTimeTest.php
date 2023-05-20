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

    public function testAdminCanSeeWorkTimeCalendar(): void
    {
        User::factory(10)->hasWorkTimes()->create();
        $admin = User::factory()->admin()->create();

        $this->assertDatabaseCount("work_times", 10);
        $this->assertDatabaseCount("users", 11);

        $this->actingAs($admin)
            ->get("/workTime/create")
            ->assertInertia(
                fn(AssertableInertia $page) => $page
                    ->component("WorkTime/Create")
                    ->has("users", 10),
            );
    }

    public function testManagerCanSeeWorkTimeCalendar(): void
    {
        User::factory(10)->hasWorkTimes()->create();
        $manager = User::factory()->manager()->hasWorkTimes()->create();

        $this->assertDatabaseCount("work_times", 11);
        $this->assertDatabaseCount("users", 11);

        $this->actingAs($manager)
            ->get("/workTime/create")
            ->assertInertia(
                fn(AssertableInertia $page) => $page
                    ->component("WorkTime/Create")
                    ->has("users", 11),
            );
    }

    public function testEmployeeCanNotManageWorkTimeCalendar(): void
    {
        User::factory(10)->hasWorkTimes()->create();
        $employee = User::factory()->hasWorkTimes()->create();

        $this->assertDatabaseCount("users", 11);
        $this->assertDatabaseCount("work_times", 11);

        $this->actingAs($employee)
            ->get("/workTime/create")
            ->assertRedirectToRoute("dashboard");
    }

    public function testEmployeeCanSeeHisWorkTimeCalendar(): void
    {
        User::factory(10)->hasWorkTimes()->create();
        $employee = User::factory()->hasWorkTimes(5)->create();

        $this->assertDatabaseCount("work_times", 15);
        $this->assertDatabaseCount("users", 11);

        $this->actingAs($employee)
            ->get("/workTime")
            ->assertInertia(
                fn(AssertableInertia $page) => $page
                    ->component("WorkTime/Index")
                    ->has("workTimes", 5),
            );
    }

}
