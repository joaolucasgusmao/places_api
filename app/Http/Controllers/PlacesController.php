<?php

namespace App\Http\Controllers;

use App\Services\PlacesService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PlacesController
{
    protected PlacesService $placesService;

    public function __construct(PlacesService $placesService)
    {
        $this->placesService = $placesService;
    }

    public function store(Request $request): JsonResponse
    {
        return response()->json($this->placesService->store($request->all()), 201);
    }
}
