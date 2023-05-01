<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\FeatureTestCase;

class AuthenticationTest extends FeatureTestCase
{
    use DatabaseMigrations;

    public function testGuestIsRedirected(): void
    {
        $this->get("/")
            ->assertRedirect();
    }

    public function testUserCanAuthenticateUsingTheLoginScreen(): void
    {
        $user = User::factory()->create();

        $response = $this->post("/login", [
            "email" => $user->email,
            "password" => "password",
        ]);

        $this->assertAuthenticated();
        $response->assertRedirectToRoute("dashboard");
    }

    public function testUsersCanNotAuthenticateWithInvalidPassword(): void
    {
        $user = User::factory()->create();

        $this->post("/login", [
            "email" => $user->email,
            "password" => "wrong-password",
        ]);

        $this->assertGuest();
    }

    public function testUserCanLogout(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $this->assertAuthenticated();

        $this->post("/logout")
            ->assertRedirect();

        $this->assertGuest();
    }
}
