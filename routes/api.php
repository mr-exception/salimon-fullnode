<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\ContractsController;
use App\Http\Controllers\PacketsController;
use App\Http\Controllers\SignaturesController;
use App\Http\Controllers\SubscriptionsController;
use Illuminate\Support\Facades\Route;

Route::middleware("strToLower")->group(function () {
  Route::get("/heart-beat", function () {
    return [
      "name" => env("APP_NAME"),
      "commission_fee" => env("CONTRACT_COMMISSION"),
      "subscription_fee" => env("SUBSCRIPTION_FEE"),
      "time" => time(),
      "paid_subscription" => env("PAID_SUBSCRIPTION"),
    ];
  });
  Route::prefix("/packets")
    ->name("packets.")
    ->group(function () {
      Route::get("/fetch", [PacketsController::class, "fetch"])->name("fetch");
      Route::post("/send", [PacketsController::class, "send"])
        ->middleware(["checkSubscription", "secretAuth"])
        ->name("send");
    });
  Route::prefix("/subscriptions")
    ->name("subscriptions.")
    ->group(function () {
      Route::get("/balance", [SubscriptionsController::class, "checkWallet"])->name("checkWallet");
      Route::post("/submit", [SubscriptionsController::class, "submit"])
        ->name("submit")
        ->middleware("secretAuth");
    });

  Route::prefix("/contracts")
    ->name("contracts.")
    ->group(function () {
      Route::post("/create", [ContractsController::class, "create"])
        ->name("create")
        ->middleware("secretAuth");
      Route::get("/list", [ContractsController::class, "list"])->name("list");
      Route::post("/submit-result", [ContractsController::class, "submitResult"])
        ->name("submit_result")
        ->middleware("throttle:1,1");
    });
  Route::prefix("/signatures")
    ->name("signatures.")
    ->group(function () {
      Route::post("/create", [SignaturesController::class, "create"])->name("create");
      Route::post("/update", [SignaturesController::class, "update"])->name("update");
      Route::post("/destroy", [SignaturesController::class, "destroy"])->name("destroy");
    });
  Route::prefix("/addresses")
    ->name("addresses.")
    ->group(function () {
      Route::get("/check-list", [AddressController::class, "checkAddressList"])->name("checkAddressList");
    });
});
