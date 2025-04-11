<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlacesRequest;
use App\Services\PlacesService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PlacesController
{
    protected PlacesService $placesService;

    public function __construct(PlacesService $placesService)
    {
        $this->placesService = $placesService;
    }

    public function store(PlacesRequest $request): JsonResponse
    {
        return response()->json($this->placesService->store($request->all()), 201);
    }

    public function get(): JsonResponse
    {
        return response()->json($this->placesService->get(), 200);
    }

    public function getPlaceByName(Request $request): JsonResponse
    {
        $name = $request->query('name');
        return response()->json($this->placesService->getPlaceByName($name), 200);
    }

    public function retrieve(int $id): JsonResponse
    {
        return response()->json($this->placesService->retrieve($id), 200);
    }

    public function update(int $id, PlacesRequest $request): JsonResponse
    {
        return response()->json($this->placesService->update($id, $request->all()), 200);
    }

    public function destroy(int $id): Response
    {
        $this->placesService->destroy($id);

        return response()->noContent();
    }
}
