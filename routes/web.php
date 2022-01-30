<?php

use App\Http\Controllers\Panel\AuthController;
use App\Http\Controllers\Panel\ConfigsController;
use App\Http\Controllers\PublicPagesController;
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

Route::middleware("strToLower")->group(function () {
  Route::get("/balance/{address}", [PublicPagesController::class, "balance"])->name("balance");
  Route::prefix("/contracts")
    ->name("contracts.")
    ->group(function () {
      Route::get("/list", [PublicPagesController::class, "contractsList"])->name("list");
      Route::get("/{contract}", [PublicPagesController::class, "contractDetails"])->name("details");
    });
});
Route::middleware("auth")->group(function () {
  Route::prefix("/configs")
    ->name("configs.")
    ->group(function () {
      Route::get("/", [ConfigsController::class, "Show"])->name("show");
      Route::post("/", [ConfigsController::class, "update"])->name("update");
    });
});

Route::prefix("/login")
  ->name("login.")
  ->group(function () {
    Route::get("/", [AuthController::class, "loginGet"])->name("get");
    Route::post("/", [AuthController::class, "loginSubmit"])->name("submit");
  });

Route::prefix("/auth")
  ->name("auth.")
  ->group(function () {
    Route::prefix("/change-password")
      ->name("change_password.")
      ->group(function () {
        Route::get("/", [AuthController::class, "changePasswordGet"])->name("get");
        Route::post("/", [AuthController::class, "changePasswordSubmit"])->name("submit");
      });
    Route::get("/logout", [AuthController::class, "logout"])->name("logout");
  });
