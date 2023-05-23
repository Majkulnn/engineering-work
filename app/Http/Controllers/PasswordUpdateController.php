<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;
use Inertia\Response;

class PasswordUpdateController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function edit(): Response
    {
        return Inertia::render("Auth/EditPassword");
    }

    public function update(Request $request, UpdatePasswordRequest $passwordRequest): RedirectResponse
    {
        $validated = $passwordRequest->validated();

        $request->user()->update([
            "password" => Hash::make($validated["password"]),
        ]);

        return back();
    }
}
