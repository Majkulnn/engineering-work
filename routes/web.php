<?php

declare(strict_types=1);

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/", function () {
    return Inertia::render("Welcome", [
        "laravelVersion" => Application::VERSION,
        "phpVersion" => PHP_VERSION,
    ]);
})->name("home")->middleware("auth");

Route::get("/login", [LoginController::class, "index"])->name("login")->middleware("guest");
Route::post("/login", [LoginController::class, "store"])->name("login.post");

Route::middleware("auth")->group(function (): void {
    Route::post("/logout", LogoutController::class)->name("logout");

    Route::get("/employee/dashboard", [DashboardController::class, "employee"])->name("employee.dashboard");
    Route::get("/manager/dashboard", [DashboardController::class, "manager"])->name("manager.dashboard");
    Route::get("/admin/dashboard", [DashboardController::class, "admin"])->name("admin.dashboard");
});
