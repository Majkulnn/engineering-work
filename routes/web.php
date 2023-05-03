<?php

declare(strict_types=1);

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HolidayRequestController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UserController;
use App\Models\HolidaysRequest;
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

    Route::resource('/holiday/request', HolidayRequestController::class)->only(['index','create','store']);
});
