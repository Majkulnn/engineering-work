<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\HolidayRequestStatus;
use App\Enums\HolidaysType;
use App\Http\Requests\HolidaysRequestStoreRequest;
use App\Http\Resources\HolidaysRequestResource;
use App\Models\Holiday;
use App\Models\HolidaysRequest;
use Illuminate\Auth\Access\AuthorizationException;
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
        try {
            $this->authorize("manageHolidays");
            $holidaysRequests = HolidaysRequest::query()->orderBy("start_date")->paginate(20);
        } catch (AuthorizationException $e) {
            $holidaysRequests = HolidaysRequest::query()->whereIn("creator_id", [auth()->user()->id])->orderBy("start_date")->paginate(20);
        }

        return Inertia::render("Holidays/Request/Index", [
            "holidays_requests" => HolidaysRequestResource::collection($holidaysRequests),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render("Holidays/Request/Create", [
            "holiday_type" => HolidaysType::casesToSelect(),
        ]);
    }

    public function store(HolidaysRequestStoreRequest $request): RedirectResponse
    {
        HolidaysRequest::create(
            [
                "creator_id" => auth()->user()->id,
                "start_date" => $request->start_date,
                "end_date" => $request->end_date,
                "type" => $request->type,
                "reason" => $request?->reason,
                "status" => HolidayRequestStatus::Pending,
            ],
        );

        return redirect()->route("dashboard");
    }

    public function acceptRequest(int $id): RedirectResponse
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

        return redirect()->route("holidayRequest.index");
    }

    public function rejectRequest(int $id): RedirectResponse
    {
        $holidaysRequest = HolidaysRequest::query()->find($id);
        $holidaysRequest->update(
            [
                "status" => HolidayRequestStatus::Rejected,
            ],
        );

        return redirect()->route("holidayRequest.index");
    }
}
