<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Holiday;
use Illuminate\Database\Eloquent\Collection;

class HolidaySummaryService
{
    public function getHolidays(string $year): Collection
    {
        return Holiday::query()
            ->select("user_id")
            ->selectRaw('SUM("days_count") as total_days')
            ->where("start_date", "like", $year . "%")
            ->groupBy("user_id")
            ->get();
    }
}
