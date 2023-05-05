<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\HolidaysResource;
use App\Models\Holiday;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class HolidayController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index(): Response
    {
        $this->authorize("manageHolidays");

        $holidays = Holiday::all();

        return Inertia::render("Holidays/Index", [
            "holidays" => HolidaysResource::collection($holidays),
        ]);
    }
}
