<?php

namespace App\Http\Controllers;

use App\Services\PlacesService;

class PlacesController
{
    protected PlacesService $placesService;

    public function __construct(PlacesService $placesService)
    {
        $this->placesService = $placesService;
    }
}
