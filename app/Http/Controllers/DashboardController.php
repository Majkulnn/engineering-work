<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\HolidaysResource;
use App\Http\Resources\WorkTimeDashboardResource;
use App\Models\Holiday;
use App\Models\WorkTime;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function dashboard(): Response
    {
        $now = now();
        $workData = null;
        $holidayData = null;
        $work = WorkTime::query()->where("user_id", auth()->user()->id)
            ->where("start", ">", $now)
            ->orderBy("start")
            ->first();
        if ($work) {
            $workData = new WorkTimeDashboardResource($work);
        }
        $holiday = Holiday::query()->where("user_id", auth()->user()->id)
            ->where("start_date", ">", $now)
            ->first();
        if ($holiday) {
            $holidayData = new HolidaysResource($holiday);
        }
        return Inertia::render("Dashboard", [
            "nextWork" => $workData,
            "nextHoliday" => $holidayData,
        ]);
    }
}
