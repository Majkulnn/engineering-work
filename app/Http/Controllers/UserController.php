<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\EmploymentForm;
use App\Enums\Role;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\Profile;
use App\Models\User;
use App\Notifications\UserCreatedMail;
use App\Services\StoreUserService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Notification;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class UserController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function index(): Response
    {
        $this->authorize("manageUsers");

        $users = User::query()
            ->whereNot("role", "administrator")
            ->orderBy(Profile::query()->select("last_name")
                ->whereColumn("users.id", "profiles.user_id"))
            ->paginate()
            ->withQueryString();

        if (auth()->user()->role === Role::Administrator) {
            $users = User::query()
                ->orderBy(Profile::query()->select("last_name")->whereColumn("users.id", "profiles.user_id"))
                ->paginate()->withQueryString();
        }

        return Inertia::render("User/List", [
            "users" => UserResource::collection($users),
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function create(): Response
    {
        $this->authorize("manageUsers");

        return Inertia::render("User/Create", [
            "employment_forms" => EmploymentForm::casesToSelect(),
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function store(UserStoreRequest $request, StoreUserService $service): RedirectResponse
    {
        $this->authorize("manageUsers");

        $user = $service->store($request->validated());

        Notification::send($user, new UserCreatedMail());
        return redirect()->route("users.index");
    }

    /**
     * @throws AuthorizationException
     */
    public function show(User $user): Response
    {
        $this->authorize("manageUsers");

        return Inertia::render("User/Show", [
            "user" => new UserResource($user)]);
    }

    /**
     * @throws AuthorizationException
     */
    public function edit(User $user): Response
    {
        $this->authorize("manageUsers");

        return Inertia::render("User/Edit", [
            "user" => new UserResource($user),
            "employmentForms" => EmploymentForm::casesToSelect(),
            "roles" => Role::casesToSelect(),
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(User $user, UserUpdateRequest $request): RedirectResponse
    {
        $this->authorize("manageUsers");

        $user->update($request->userData());
        $user->profile()->update($request->userProfileData());

        return redirect()->route("users.show", $user->id);
    }

    /**
     * @throws Throwable
     * @throws AuthorizationException
     */
    public function destroy(User $user): RedirectResponse
    {
        $this->authorize("manageUsers");

        $user->delete();

        return redirect()->route("users.index");
    }
}
