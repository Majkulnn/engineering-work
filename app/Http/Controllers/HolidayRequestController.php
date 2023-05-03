<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\HolidayRequestStatus;
use App\Enums\HolidaysType;
use App\Http\Requests\HolidaysRequestStoreRequest;
use App\Models\HolidaysRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class HolidayRequestController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index(): Response
    {
        $this->authorize("manageHolidays");

        $holidaysRequests = HolidaysRequest::query()->orderBy('start_date')->paginate();

        return Inertia::render("Holidays/Requests/Index",[
            'holidays' => $holidaysRequests
        ]);
    }

    public function create(): Response
    {
        return Inertia::render("Holidays/Requests/Create",[
            "holiday_type" => HolidaysType::casesToSelect()
        ]);
    }

    public function store(HolidaysRequestStoreRequest $request): RedirectResponse
    {
        HolidaysRequest::create([
            "creator_id" => auth()->user()->id,
                "start_date" => $request->start_date,
                "end_date" => $request->end_date,
                "type" => $request->type,
                "reason" => $request?->reason,
                "status" => HolidayRequestStatus::Pending
            ]
        );

        return redirect()->route("dashboard");
    }
}
