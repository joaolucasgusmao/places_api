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

    public function get(): JsonResponse
    {
        return response()->json($this->placesService->get(), 200);
    }

    public function retrieve(int $id): JsonResponse
    {
        return response()->json($this->placesService->retrieve($id), 200);
    }

    public function update(int $id, Request $request): JsonResponse
    {
        return response()->json($this->placesService->update($id, $request->all()), 200);
    }
}
