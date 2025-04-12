<?php

namespace App\Services;

use App\Exceptions\AppError;
use App\Http\Resources\PlacesResource;
use App\Models\Place;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class PlacesService
{
    public function store(array $data): JsonResource
    {
        $data['slug'] = Str::slug($data['slug']);
        return new PlacesResource(Place::create($data));
    }

    public function get(): AnonymousResourceCollection
    {
        return PlacesResource::collection(Place::all());
    }

    public function getPlaceByName(string $name): AnonymousResourceCollection
    {
        $place = Place::whereRaw('unaccent(name) ILIKE unaccent(?)', ["%$name%"])->get();

        if ($place->isEmpty()) {
            throw new AppError("No Places found", 404);
        }

        return PlacesResource::collection($place);
    }

    public function retrieve(int $id): JsonResource
    {
        $place = Place::find($id);

        if (!$place) {
            throw new AppError("Place not found.", 404);
        }

        return new PlacesResource($place);
    }

    public function update(int $id, array $data): JsonResource
    {
        $place = Place::find($id);

        if (!$place) {
            throw new AppError("Place not found.", 404);
        }

        if (isset($data['slug'])) {
            $data['slug'] = Str::slug($data['slug']);
        }

        $place->update($data);

        return new PlacesResource($place);
    }

    public function destroy(int $id): void
    {
        $place = Place::find($id);

        if (!$place) {
            throw new AppError("Place not found.", 404);
        }

        $place->delete();
    }
}
