<?php

namespace App\Services;

use App\Models\Place;
use Illuminate\Support\Str;

class PlacesService
{
    public function store(array $data): Place
    {
        $data['slug'] = Str::slug($data['slug']);
        return Place::create($data);
    }
}
