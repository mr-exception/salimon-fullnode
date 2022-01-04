<?php

use App\Http\Controllers\PacketsController;
use Illuminate\Support\Facades\Route;

Route::prefix("/packets")
  ->name("packets.")
  ->group(function () {
    Route::get("/fetch", [PacketsController::class, "fetch"])->name("fetch");
    Route::post("/send", [PacketsController::class, "send"])->name("send");
  });
