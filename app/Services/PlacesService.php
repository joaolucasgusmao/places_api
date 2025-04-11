<?php

namespace App\Services;

use App\Exceptions\AppError;
use App\Models\Place;
use Illuminate\Database\Eloquent\Collection;
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

        $data['slug'] = Str::slug($data['slug']);

        $place->update($data);
        return $place;
    }
}
