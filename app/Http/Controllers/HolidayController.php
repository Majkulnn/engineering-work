<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\HolidaysResource;
use App\Http\Resources\UserResource;
use App\Models\Holiday;
use App\Services\HolidaySummaryService;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Momentum\Modal\Modal;

class HolidayController extends Controller
{
    /**
     * Handle the incoming request.
     * @throws AuthorizationException
     */
    public function index(): Response
    {
        try {
            $this->authorize("manageHolidays");
            $holidays = Holiday::query()->orderBy("start_date")->get();
        } catch (AuthorizationException $e) {
            $holidays = Holiday::query()->whereIn("user_id", [auth()->user()->id])->orderBy("start_date")->get();
        }

        return Inertia::render("Holidays/Index", [
            "holidays" => HolidaysResource::collection($holidays),
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function show(int $id): Modal
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
    public function summary(Request $request, HolidaySummaryService $holidaySummaryService, UserService $userService): Response
    {
        $this->authorize("manageHolidays");

        $year = $request->get("year") ? $request->get("year") : (string)Carbon::now()->year;

        $holidays = $holidaySummaryService->getHolidays($year);
        $users = $userService->getUsers();

        return Inertia::render("Holidays/Summary", [
            "users" => UserResource::collection($users),
            "holidays" => $holidays,
        ]);
    }
}
