<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class StoreNewPasswordService
{
    public function storeNewPassword(array $request)
    {
        return Password::reset(
            $request,
            function ($user, $request): void {
                $user->forceFill([
                    "password" => Hash::make($request["password"]),
                    "remember_token" => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            },
        );
    }
}
