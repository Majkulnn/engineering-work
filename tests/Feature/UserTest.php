<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Enums\EmploymentForm;
use App\Enums\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Inertia\Testing\AssertableInertia;
use Tests\FeatureTestCase;

class UserTest extends FeatureTestCase
{
    use DatabaseMigrations;

    public function testEmployeeCanNotSeeUsersList(): void
    {
        User::factory(10)->create();
        $admin = User::factory()->create();

        $this->assertDatabaseCount("users", 11);

        $this->actingAs($admin)
            ->get("/users")
            ->assertRedirectToRoute("dashboard");
    }

    public function testAdminCanSeeUsersList(): void
    {
        User::factory(10)->create();
        $admin = User::factory()->admin()->create();

        $this->assertDatabaseCount("users", 11);

        $this->actingAs($admin)
            ->get("/users")
            ->assertInertia(
                fn(AssertableInertia $page) => $page
                    ->component("User/List")
                    ->has("users.data", 11),
            );
    }

    public function testManagerCanSeeUsersList(): void
    {
        User::factory(10)->create();
        $manager = User::factory()->manager()->create();

        $this->assertDatabaseCount("users", 11);

        $this->actingAs($manager)
            ->get("/users")
            ->assertInertia(
                fn(AssertableInertia $page) => $page
                    ->component("User/List")
                    ->has("users.data", 11),
            );
    }

    public function testManagerCanNotSeeAdminInUsersList(): void
    {
        User::factory(10)->create();
        User::factory()->admin()->create();
        $manager = User::factory()->manager()->create();

        $this->assertDatabaseCount("users", 12);

        $this->actingAs($manager)
            ->get("/users")
            ->assertInertia(
                fn(AssertableInertia $page) => $page
                    ->component("User/List")
                    ->has("users.data", 11),
            );
    }

    public function testAdminCanCreateUser(): void
    {
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)
            ->post("/users", [
                "email" => "testUser@test.com",
                "first_name" => "John",
                "last_name" => "Doe",
                "position" => "Office Worker",
                "employment_form" => EmploymentForm::EmploymentContract->value,
                "employment_date" => Carbon::now()->toDateString(),
            ])
            ->assertSessionHasNoErrors();

        $this->assertDatabaseCount("users", 2);
        $response->assertRedirectToRoute("users.index");
    }

    public function testAdminCanDestroyUser(): void
    {
        $admin = User::factory()->admin()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($admin)
            ->delete("/users/{$user->id}");

        $response->assertRedirectToRoute("users.index");
        $this->assertSoftDeleted($user);
    }

    public function testAdminCanEditUser(): void
    {
        Carbon::setTestNow();
        $admin = User::factory()->admin()->create();

        $user = User::factory()->create();

        $this->assertDatabaseHas("profiles", [
            "user_id" => $user->id,
            "first_name" => $user->profile->first_name,
            "last_name" => $user->profile->last_name,
            "employment_form" => $user->profile->employment_form->value,
            "employment_date" => $user->profile->employment_date->toDateString(),
        ]);

        $this->actingAs($admin)
            ->put("/users/{$user->id}", [
                "first_name" => "John",
                "last_name" => "Doe",
                "email" => "john.doe@example.com",
                "role" => Role::Manager->value,
                "position" => "Test position",
                "employment_form" => EmploymentForm::MandateContract->value,
                "employment_date" => Carbon::now()->toDateString(),
            ])
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas("users", [
            "id" => $user->id,
            "email" => "john.doe@example.com",
            "role" => Role::Manager->value,
        ]);

        $this->assertDatabaseHas("profiles", [
            "user_id" => $user->id,
            "first_name" => "John",
            "last_name" => "Doe",
            "position" => "Test position",
            "employment_form" => EmploymentForm::MandateContract->value,
            "employment_date" => Carbon::now()->toDateString(),
        ]);
    }
}
