<?php

declare(strict_types=1);

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\HolidayRequestController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkRequestController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

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

Route::get("/")->middleware("auth")->name("home");

// })->name("home")->middleware("auth");

Route::get("/login", [LoginController::class, "index"])->name("login")->middleware("guest");
Route::post("/login", [LoginController::class, "store"])->name("login.post");

Route::middleware("auth")->group(function (): void {
    Route::post("/logout", LogoutController::class)->name("logout");

    Route::get("/dashboard", [DashboardController::class, "dashboard"])->name("dashboard");

    Route::resource("/users", UserController::class);

    Route::resource("/holiday/request", HolidayRequestController::class)->only(["index", "create", "store"])->names("holidayRequest");
    Route::put("/holiday/request/{holidayRequest_id}/accept", [HolidayRequestController::class, "acceptRequest"])->name("holidayRequest.accept");
    Route::put("/holiday/request/{holidayRequest_id}/reject", [HolidayRequestController::class, "rejectRequest"])->name("holidayRequest.reject");
    Route::get("/holidays", [HolidayController::class, "index"])->name("holidays.index");
    Route::resource("/work/request", WorkRequestController::class)->only(["index", "create", "store"])->names("workRequest");
});
