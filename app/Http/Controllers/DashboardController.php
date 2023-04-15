<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function employee(): Response
    {
        return Inertia::render("Employees/Dashboard");
    }

    public function manager(): Response
    {
        return Inertia::render("Managers/Dashboard");
    }

    public function admin(): Response
    {
        return Inertia::render("Admin/Dashboard");
    }
}
