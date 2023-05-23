<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\HolidayRequestStatus;
use App\Models\Holiday;
use App\Models\HolidaysRequest;

class AcceptedHolidayRequestService
{
    public function accept(int $id): void
    {
        $holidaysRequest = HolidaysRequest::query()->find($id);

        Holiday::create([
            "user_id" => $holidaysRequest->creator_id,
            "start_date" => $holidaysRequest->start_date,
            "end_date" => $holidaysRequest->end_date,
            "type" => $holidaysRequest->type,
            "days_count" => date_diff($holidaysRequest->start_date, $holidaysRequest->end_date)->days + 1,
        ]);
        $holidaysRequest->update(
            [
                "status" => HolidayRequestStatus::Accepted,
            ],
        );
    }
}
