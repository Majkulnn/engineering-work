<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Http\Resources\WorkTimeCoworkersResource;
use App\Http\Resources\WorkTimeResource;
use App\Http\Resources\WorkTimeToCalendarResource;
use App\Models\Profile;
use App\Models\User;
use App\Models\WorkTime;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class WorkTimeController extends Controller
{
    public function index()
    {
        $workTimes = WorkTime::query()->where("user_id", auth()->user()->id)->get();

        return Inertia::render("WorkTime/Index", [
            "workTimes" => WorkTimeToCalendarResource::collection($workTimes),
        ]);
    }

    /**
     * Handle the incoming request.
     * @throws AuthorizationException
     */
    public function create(Request $request): Response
    {
        $this->authorize("manageWorkTimes");

        $users = User::query()
            ->whereNot("role", "administrator")
            ->orderBy(Profile::query()->select("last_name")->whereColumn("users.id", "profiles.user_id"))
            ->with("workTimes")
            ->with("workRequests")
            ->get();

        return Inertia::render("WorkTime/Create", [
            "users" => UserResource::collection($users),
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $this->authorize("manageWorkTimes");

        WorkTime::create([
            "user_id" => $request->get("user_id"),
            "start" => $request->get("start"),
            "end" => $request->get("end"),
            "hour_count" => Carbon::parse($request->get("end"))->diff(Carbon::parse($request->get("start")))->format("%H:%I:%S"),
            "position" => $request->get("position"),
        ]);

        return back();
    }

    /**
     * @throws AuthorizationException
     */
    public function show(int $id): \Momentum\Modal\Modal
    {
        $this->authorize("manageWorkTimes");

        $workTime = WorkTime::query()->find($id);

        return Inertia::dialog("WorkTime/ShowWorkTimeModal", [
            "workTime" => new WorkTimeResource($workTime),
        ])->baseRoute("workTime.create");
    }

    public function coworkers(int $id): \Momentum\Modal\Modal
    {
        $workTime = WorkTime::query()->find($id);
        $coworkers = WorkTime::query()
            ->whereNot("user_id", $workTime->user_id)
            ->whereNot("start", ">", $workTime->end)
            ->whereNot("end", "<", $workTime->start)
            ->get();
        return Inertia::dialog("WorkTime/ShowCoworkersModal", [
            "coworkers" => WorkTimeCoworkersResource::collection($coworkers),
        ])->baseRoute("workTime.index");
    }

    /**
     * @throws AuthorizationException
     */
    public function update(Request $request): \Illuminate\Http\RedirectResponse
    {
        $this->authorize("manageWorkTimes");

        $oldEvent = $request->get("oldEvent");
        $newEvent = $request->get("newEvent");

        WorkTime::query()->updateOrCreate([
            "user_id" => $oldEvent["user_id"],
            "start" => $oldEvent["start"],
            "end" => $oldEvent["end"],
        ], [
            "user_id" => $newEvent["user_id"],
            "start" => $newEvent["start"],
            "end" => $newEvent["end"],
            "hour_count" => Carbon::parse($newEvent["end"])->diff(Carbon::parse($newEvent["start"]))->format("%H:%I:%S"),
            "position" => $request->get("position"),
        ]);
        return back();
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(WorkTime $workTime): \Illuminate\Http\RedirectResponse
    {
        $this->authorize("manageWorkTimes");

        $workTime->delete();

        return to_route("workTime.create");
    }

    /**
     * @throws AuthorizationException
     */
    public function summary(Request $request): Response
    {
        $this->authorize("manageWorkTimes");

        $month = $request->get("month") ? $request->get("month") : "2023-05";
        $hours = WorkTime::query()
            ->select("user_id")
            ->selectRaw('SUM("hour_count") as total_hours')
            ->where("start", "like", $month . "%")
            ->groupBy("user_id")
            ->get();
        $users = User::query()
            ->orderBy(Profile::query()->select("last_name")->whereColumn("users.id", "profiles.user_id"))
            ->paginate()
            ->withQueryString();

        return Inertia::render("WorkTime/Summary", [
            "users" => UserResource::collection($users),
            "workTime" => $hours,
        ]);
    }
}
