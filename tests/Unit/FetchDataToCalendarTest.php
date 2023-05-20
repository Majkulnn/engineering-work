<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class FetchDataToCalendarTest extends TestCase
{
    use DatabaseMigrations;

    public function testGetWorkTimeData(): void
    {
        User::factory(10)->hasWorkTimes()->create();

        $this->assertDatabaseCount("work_times", 10);
        $this->assertDatabaseCount("users", 10);

        $this->json("get", "/api/workTimes")
            ->assertStatus(200)
            ->assertJsonCount(10);
    }

    public function testGetWorkRequestData(): void
    {
        User::factory(10)->hasWorkRequests(2)->create();

        $this->assertDatabaseCount("work_requests", 20);
        $this->assertDatabaseCount("users", 10);

        $this->json("get", "/api/workRequests")
            ->assertStatus(200)
            ->assertJsonCount(20);
    }

    public function testGetHolidaysData(): void
    {
        User::factory(10)->hasHolidays(5)->create();

        $this->assertDatabaseCount("holidays", 50);
        $this->assertDatabaseCount("users", 10);

        $this->json("get", "/api/holidays")
            ->assertStatus(200)
            ->assertJsonCount(50);
    }
}
