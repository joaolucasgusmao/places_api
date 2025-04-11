<?php

use App\Http\Controllers\PlacesController;
use Illuminate\Support\Facades\Route;

Route::post("/places", [PlacesController::class, "store"]);
