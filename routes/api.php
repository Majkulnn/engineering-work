<?php

declare(strict_types=1);

use App\Http\Controllers\API\FetchDataToCalendarController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware("auth:sanctum")->get("/user", fn(Request $request) => $request->user());
Route::get("/workTimes", [FetchDataToCalendarController::class, "getWorkTimes"]);
Route::get("/holidays", [FetchDataToCalendarController::class, "getHolidays"]);
Route::get("/workRequests", [FetchDataToCalendarController::class, "getWorkTimeRequests"]);
