<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuoteController;
use Illuminate\Support\Facades\Route;

Route::get("/", function () {
    return redirect("/quotes");
});

Route::middleware("guest")->group(function () {
    Route::get("/login", [AuthController::class, "showLogin"])->name("login");
    Route::post("/login", [AuthController::class, "login"]);
});

Route::post("/logout", [AuthController::class, "logout"])->middleware("auth");

Route::get("/quotes", [QuoteController::class, "index"]);

Route::middleware("auth")->group(function () {
    Route::post("/quotes", [QuoteController::class, "store"]);
    Route::get("/quotes/{quote}/edit", [QuoteController::class, "edit"]);
    Route::put("/quotes/{quote}", [QuoteController::class, "update"]);
    Route::delete("/quotes/{quote}", [QuoteController::class, "destroy"]);
});
