<?php

namespace Tests\Feature\PlacesController;

use App\Models\Place;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdatePlaceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_update_place(): void
    {
        $place = Place::create([
            'name' => 'Old Name',
            'slug' => 'Old Name',
            'city' => 'Old City',
            'state' => 'ST',
        ]);

        $response = $this->patchJson("/api/places/{$place->id}", data: [
            'name' => 'New Name',
            'slug' => 'New Name',
            'city' => 'New City',
        ]);

        $response->assertOk()->assertJsonFragment(data: ['name' => 'New Name']);

        $this->assertDatabaseHas(table: 'places', data: ['slug' => 'new-name']);
    }
}
