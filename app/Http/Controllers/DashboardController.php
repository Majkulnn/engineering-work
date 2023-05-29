<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function dashboard(DashboardService $service): Response
    {
        $data = $service->getDataToDashboard();

        return Inertia::render("Dashboard", [
            "nextWork" => $data["work"],
            "nextHoliday" => $data["holiday"],
        ]);
    }
}
