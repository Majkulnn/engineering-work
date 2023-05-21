<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class NewUserLoginController extends Controller
{
    public function index(string $email): Response
    {
        return Inertia::render("Auth/NewUserLogin",[
            'email' => $email,
        ]);
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request, LoginRequest $loginRequest): RedirectResponse
    {
       $user = User::query()->where('email', $request->get('email'))->first();

       $user->update(['password' => Hash::make($request->get('password'))]);

        $loginRequest->authenticate();

        $request->session()->regenerate();

        return redirect()->route("dashboard");
    }
}
