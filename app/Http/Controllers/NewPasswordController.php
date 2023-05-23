<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewPasswordRequest;
use App\Services\StoreNewPasswordService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class NewPasswordController extends Controller
{
    public function create(Request $request): Response
    {
        return Inertia::render("Auth/ResetPassword", [
            "email" => $request->email,
            "token" => $request->route("token"),
        ]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(StoreNewPasswordRequest $request, StoreNewPasswordService $service): RedirectResponse
    {
        $status = $service->storeNewPassword($request->validated());

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route("login")->with("status", __($status));
        }

        throw ValidationException::withMessages([
            "email" => [trans($status)],
        ]);
    }
}
