<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class LoginController extends Controller
{
    public function index(): Response
    {
        return Inertia::render("Login");
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        if (auth()->user()->role === Role::Employee) {
            return redirect()->route("employee.dashboard");
        }
        if (auth()->user()->role === Role::Manager) {
            return redirect()->route("manager.dashboard");
        }
        if (auth()->user()->role === Role::Administrator) {
            return redirect()->route("admin.dashboard");
        }
        return redirect()->route("home");
    }
}
