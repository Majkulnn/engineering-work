<?php

declare(strict_types=1);

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\HolidayRequestController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\NewPasswordController;
use App\Http\Controllers\NewUserLoginController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\PasswordUpdateController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkRequestController;
use App\Http\Controllers\WorkTimeController;
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

Route::get("/", fn() => redirect()->route("dashboard"))->middleware("auth")->name("home");

Route::get("/login", [LoginController::class, "index"])->name("login")->middleware("guest");
Route::post("/login", [LoginController::class, "store"])->name("login.post");
Route::get("/newLogin/{email}", [NewUserLoginController::class, "index"])->name("newLogin.index");
Route::post("/newLogin", [NewUserLoginController::class, "store"])->name("newLogin.post");

Route::get("/forgot-password", [PasswordResetController::class, "create"])->name("password.request");
Route::post("/forgot-password", [PasswordResetController::class, "store"])->name("password.email");
Route::get("/reset-password/{token}", [NewPasswordController::class, "create"])->name("password.reset");
Route::post("/reset-password", [NewPasswordController::class, "store"])->name("password.store");

Route::middleware("auth")->group(function (): void {
    Route::post("/logout", LogoutController::class)->name("logout");

    Route::get("/profile/password", [PasswordUpdateController::class, "edit"])->name("password.edit");
    Route::put("/profile/password", [PasswordUpdateController::class, "update"])->name("password.update");

    Route::get("/dashboard", [DashboardController::class, "dashboard"])->name("dashboard");

    Route::resource("/users", UserController::class);

    Route::resource("/holiday/request", HolidayRequestController::class)->only(["index", "create", "store", "edit"])->names("holidayRequest");
    Route::put("/holiday/request/{holidayRequest_id}/accept", [HolidayRequestController::class, "acceptRequest"])->name("holidayRequest.accept");
    Route::put("/holiday/request/{holidayRequest_id}/reject", [HolidayRequestController::class, "rejectRequest"])->name("holidayRequest.reject");
    Route::resource("/holidays", HolidayController::class)->only("index", "show")->names("holidays");
    Route::resource("/work/request", WorkRequestController::class)->only(["index", "create", "store"])->names("workRequest");
    Route::resource("/workTime", WorkTimeController::class)->only(["index", "create", "store", "show", "destroy"])->names("workTime");
    Route::put("/workTime/update", [WorkTimeController::class, "update"])->name("workTime.update");
    Route::get("/workTimes/summary", [WorkTimeController::class, "summary"])->name("workTime.summary");
    Route::get("/workTime/{workTime_id}/coworkers", [WorkTimeController::class, "coworkers"])->name("workTime.coworkers");
    Route::get("/holiday/summary", [HolidayController::class, "summary"])->name("holidays.summary");
});
