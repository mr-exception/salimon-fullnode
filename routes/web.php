<?php

use App\Http\Controllers\Panel\AuthController;
use App\Http\Controllers\Panel\ConfigsController;
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

Route::get("/", function () {
  return view("welcome");
})->name("welcome");

Route::prefix("/configs")
  ->name("configs.")
  ->group(function () {
    Route::get("/", [ConfigsController::class, "Show"])->name("show");
    Route::post("/", [ConfigsController::class, "update"])->name("update");
  });

Route::prefix("/login")
  ->name("login.")
  ->group(function () {
    Route::get("/", [AuthController::class, "loginGet"])->name("get");
    Route::post("/", [AuthController::class, "loginSubmit"])->name("submit");
  });
