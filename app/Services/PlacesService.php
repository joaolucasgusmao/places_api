<?php

namespace App\Services;

use App\Exceptions\AppError;
use App\Models\Place;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PlacesService
{
    public function store(array $data): Place
    {
        $data['slug'] = Str::slug($data['slug']);
        return Place::create($data);
    }

    public function get(): Collection
    {
        return Place::get();
    }

    public function getPlaceByName(string $name): Collection
    {
        $place = Place::whereRaw('unaccent(name) ILIKE unaccent(?)', ["%$name%"])->get();

        if ($place->isEmpty()) {
            throw new AppError("No Places found", 404);
        }

        return $place;
    }

    public function retrieve(int $id): Place
    {
        $place = Place::find($id);

        if (!$place) {
            throw new AppError("Place not found.", 404);
        }

        return $place;
    }

    public function update(int $id, array $data): Place
    {
        $place = Place::find($id);

        if (!$place) {
            throw new AppError("Place not found.", 404);
        }

        if (isset($data['slug'])) {
            $data['slug'] = Str::slug($data['slug']);
        }

        $place->update($data);
        return $place;
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
