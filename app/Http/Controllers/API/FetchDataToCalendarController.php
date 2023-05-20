<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\HolidaysToCalendarResource;
use App\Http\Resources\WorkRequestToCalendarResource;
use App\Http\Resources\WorkTimeToCalendarResource;
use App\Models\Holiday;
use App\Models\WorkRequest;
use App\Models\WorkTime;

class FetchDataToCalendarController extends Controller
{
    public function getWorkTimes()
    {
        $workTimes = WorkTime::all();

        return WorkTimeToCalendarResource::collection($workTimes);
    }

    public function getHolidays()
    {
        $holidays = Holiday::all();

        return HolidaysToCalendarResource::collection($holidays);
    }

    public function getWorkTimeRequests()
    {
        $workRequests = WorkRequest::all();

        return WorkRequestToCalendarResource::collection($workRequests);
    }
}
