<?php

namespace Tests\Feature;

use App\Models\Place;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RetrievePlaceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_retrieve_place_by_id(): void
    {
        $place = Place::create([
            'name' => 'Place Name',
            'slug' => 'Place Name',
            'city' => 'City',
            'state' => 'ST',
        ]);

        $response = $this->getJson("/api/places/{$place->id}");

        $response->assertOk()->assertJsonFragment(data: ['name' => 'Place Name']);
    }
}
