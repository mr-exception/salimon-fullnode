<?php

use App\Http\Controllers\ContractsController;
use App\Http\Controllers\PacketsController;
use App\Http\Controllers\SubscriptionsController;
use Illuminate\Support\Facades\Route;

Route::middleware("strToLower")->group(function () {
  Route::prefix("/packets")
    ->name("packets.")
    ->group(function () {
      Route::get("/fetch", [PacketsController::class, "fetch"])->name("fetch");
      Route::post("/send", [PacketsController::class, "send"])
        ->middleware("checkSubscription")
        ->name("send");
    });
  Route::prefix("/subscriptions")
    ->name("subscriptions.")
    ->group(function () {
      Route::get("/balance", [SubscriptionsController::class, "checkWallet"])->name("checkWallet");
    });

  Route::prefix("/contracts")
    ->name("contracts.")
    ->group(function () {
      Route::post("/create", [ContractsController::class, "create"])->name("create");
      Route::get("/list", [ContractsController::class, "list"])->name("list");
    });
});
