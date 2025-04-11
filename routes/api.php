<?php

use App\Http\Controllers\PlacesController;
use Illuminate\Support\Facades\Route;

Route::post("/places", [PlacesController::class, "store"]);
Route::get("/places", [PlacesController::class, "get"]);
Route::patch("/places/{id}", [PlacesController::class, "update"]);
