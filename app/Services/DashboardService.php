<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Resources\HolidaysResource;
use App\Http\Resources\WorkTimeDashboardResource;
use App\Models\Holiday;
use App\Models\WorkTime;
use Carbon\Carbon;

class DashboardService
{
    public function getDataToDashboard(): array
    {
        $now = Carbon::now();
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

        return ["work" => $workData, "holiday" => $holidayData];
    }
}
