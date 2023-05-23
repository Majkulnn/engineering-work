<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class PasswordResetController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): Response
    {
        return Inertia::render("Auth/ForgotPassword", [
            "status" => session("status"),
        ]);
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(ResetPasswordRequest $request): RedirectResponse
    {
        $status = Password::sendResetLink(
            $request->validated(),
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with("status", __($status));
        }

        throw ValidationException::withMessages([
            "email" => [trans($status)],
        ]);
    }
}
