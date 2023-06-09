<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = "app";

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $user = $request->user();
        return array_merge(parent::share($request), [
            "auth" => [
                "user" => $user,
                "can" => [
                    "manageUsers" => $user ? $user->can("manageUsers") : false,
                    "manageUsersRoles" => $user ? $user->can("manageUsersRoles") : false,
                    "manageHolidays" => $user ? $user->can("manageHolidays") : false,
                    "manageWorkTimes" => $user ? $user->can("manageWorkTimes") : false,
                ],
            ],
        ]);
    }
}
