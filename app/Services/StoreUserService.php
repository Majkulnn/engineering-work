<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Support\Str;

class StoreUserService
{
    public function store(array $request): User
    {
        $user = User::create([
            "email" => $request["email"],
            "password" => Str::password(),
            "role" => Role::Employee,
        ]);

        $user->profile()->create([
            "first_name" => $request["first_name"],
            "last_name" => $request["last_name"],
            "position" => $request["position"],
            "employment_form" => $request["employment_form"],
            "employment_date" => $request["employment_date"],
        ]);
        return $user;
    }
}
