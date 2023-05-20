<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\HolidaysResource;
use App\Http\Resources\UserResource;
use App\Models\Holiday;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class HolidayController extends Controller
{
    /**
     * Handle the incoming request.
     * @throws AuthorizationException
     */
    public function index(): Response
    {
        $this->authorize("manageHolidays");

        $holidays = Holiday::all();

        return Inertia::render("Holidays/Index", [
            "holidays" => HolidaysResource::collection($holidays),
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function show(int $id): \Momentum\Modal\Modal
    {
        $this->authorize("manageHolidays");

        $holiday = Holiday::query()->find($id);

        return Inertia::dialog("Holidays/ShowHolidayModal", [
            "holiday" => new HolidaysResource($holiday),
        ])->baseRoute("holidays.index");
    }

    /**
     * @throws AuthorizationException
     */
    public function summary(Request $request): Response
    {
        $this->authorize("manageHolidays");

        $year = $request->get("year") ? $request->get("year") : "2023";
        $holidays = Holiday::query()
            ->select("user_id")
            ->selectRaw('SUM("days_count") as total_days')
            ->where("start_date", "like", $year . "%")
            ->groupBy("user_id")
            ->get();
        $users = User::query()
            ->orderBy(Profile::query()->select("last_name")->whereColumn("users.id", "profiles.user_id"))
            ->paginate()
            ->withQueryString();

        return Inertia::render("Holidays/Summary", [
            "users" => UserResource::collection($users),
            "holidays" => $holidays,
        ]);
    }
}
