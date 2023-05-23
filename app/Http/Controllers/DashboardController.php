<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function dashboard(DashboardService $service): Response
    {
        $data = $service->getDataToDashboard();

        return Inertia::render("Dashboard", [
            "nextWork" => $data["work"],
            "nextHoliday" => $data["holiday"],
        ]);
    }
}
