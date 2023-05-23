<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Collection;

class UserService
{
    public function getUsers(): Collection
    {
        return User::query()
            ->whereNot("role", "administrator")
            ->orderBy(Profile::query()->select("last_name")
                ->whereColumn("users.id", "profiles.user_id"))
            ->get();
    }
}
