<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function index(): Response
    {
        $this->authorize("manageUsers");

        $users = User::where("role", "!=", "administrator")->get();
        if (auth()->user()->role === Role::Administrator) {
            $users = User::all();
        }

        return Inertia::render("User/List", [
            "users" => $users,
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function create(): Response
    {
        $this->authorize("manageUsers");

        return Inertia::render("User/Create");
    }

    /**
     * @throws AuthorizationException
     */
    public function store(UserStoreRequest $request): \Illuminate\Http\RedirectResponse
    {
        $this->authorize("manageUsers");

        User::create([
            "email" => $request->email,
            "password" => Str::password(),
            "role" => Role::Employee,
        ]);

        return redirect()->route("users.index");
    }

    /**
     * @throws \Throwable
     * @throws AuthorizationException
     */
    public function destroy(User $user): \Illuminate\Http\RedirectResponse
    {
        $this->authorize("manageUsers");

        $user->deleteOrFail();

        return redirect()->route("users.index");
    }
}
