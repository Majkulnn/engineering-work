<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\HolidayRequestStatus;
use App\Enums\HolidaysType;
use App\Http\Requests\HolidaysRequestStoreRequest;
use App\Http\Resources\HolidaysRequestResource;
use App\Models\HolidaysRequest;
use App\Services\AcceptedHolidayRequestService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Momentum\Modal\Modal;

class HolidayRequestController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index(): Response
    {
        try {
            $this->authorize("manageHolidays");
            $holidaysRequests = HolidaysRequest::query()->orderBy("start_date")->get();
        } catch (AuthorizationException $e) {
            $holidaysRequests = HolidaysRequest::query()->whereIn("creator_id", [auth()->user()->id])->orderBy("start_date")->get();
        }

        return Inertia::render("Holidays/Request/Index", [
            "holidaysRequests" => HolidaysRequestResource::collection($holidaysRequests),
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

    /**
     * @throws AuthorizationException
     */
    public function edit(int $id): Modal
    {
        $this->authorize("manageHolidays");
        $holidayRequest = HolidaysRequest::query()->find($id);

        return Inertia::modal("Holidays/Request/EditModal", [
            "holidayRequest" => new HolidaysRequestResource($holidayRequest),
        ])->baseRoute("holidayRequest.index");
    }

    /**
     * @throws AuthorizationException
     */
    public function acceptRequest(int $id, AcceptedHolidayRequestService $service): RedirectResponse
    {
        $this->authorize("manageHolidays");

        $service->accept($id);

        return redirect()->route("holidayRequest.index");
    }

    /**
     * @throws AuthorizationException
     */
    public function rejectRequest(int $id): RedirectResponse
    {
        $this->authorize("manageHolidays");
        $holidaysRequest = HolidaysRequest::query()->find($id);
        $holidaysRequest->update(
            [
                "status" => HolidayRequestStatus::Rejected,
            ],
        );

        return redirect()->route("holidayRequest.index");
    }
}
