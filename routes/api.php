<?php

use App\Http\Controllers\PlacesController;
use Illuminate\Support\Facades\Route;

Route::post("/places", [PlacesController::class, "store"]);
Route::get("/places", [PlacesController::class, "get"]);
Route::get("/places/{id}", [PlacesController::class, "retrieve"]);
Route::patch("/places/{id}", [PlacesController::class, "update"]);
Route::delete("/places/{id}", [PlacesController::class, "destroy"]);