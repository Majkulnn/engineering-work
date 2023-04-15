<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use DatabaseMigrations;

    public function testLoginScreenCanBeRendered(): void
    {
        $response = $this->get("/login");

        $response->assertStatus(200);
    }

    public function testEmployeeCanAuthenticateUsingTheLoginScreen(): void
    {
        $user = User::factory()->create();

        $response = $this->post("/login", [
            "email" => $user->email,
            "password" => "password",
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::Employee);
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
