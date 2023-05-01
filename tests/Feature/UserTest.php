<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
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
                    ->has("users", 11),
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
                    ->has("users", 11),
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
                    ->has("users", 11),
            );
    }

    public function testAdminCanCreateUser(): void
    {
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)
            ->post("/users/create", [
                "email" => "testUser@test.com",
                "first_name" => "John",
                "last_name" => "Doe",
            ]);

        $response->assertRedirectToRoute("users.index");
        $this->assertDatabaseCount("users", 2);
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
}
