<?php

declare(strict_types=1);

use App\Http\Controllers\LoginController;
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
})->name("home");

Route::get("/login", fn() => Inertia::render("Login"));
Route::post("/login", [LoginController::class, "store"])->name("login.post");
