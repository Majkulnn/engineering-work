<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): RedirectResponse
    {
        Auth()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route("login");
    }
}
