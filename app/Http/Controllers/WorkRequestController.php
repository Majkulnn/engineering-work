<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\WorkRequestStoreRequest;
use App\Http\Requests\WorkRequestUpdateRequest;
use App\Models\WorkRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class WorkRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): void
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render("WorkRequests/Create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WorkRequestStoreRequest $request): RedirectResponse
    {
        WorkRequest::create([
            "creator_id" => auth()->user()->id,
            "date" => $request->date,
            "from" => $request->from,
            "to" => $request->to,
        ]);

        return redirect()->route("dashboard");
    }

    /**
     * Display the specified resource.
     */
    public function show(WorkRequest $workRequest): void
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WorkRequest $workRequest): void
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WorkRequestUpdateRequest $request, WorkRequest $workRequest): void
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WorkRequest $workRequest): void
    {
    }
}
