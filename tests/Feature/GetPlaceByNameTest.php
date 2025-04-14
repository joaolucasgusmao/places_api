<?php

namespace Tests\Feature;

use App\Models\Place;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetPlaceByNameTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_find_place_by_name(): void
    {
        Place::create([
            'name' => 'Place Name',
            'slug' => 'Place Name',
            'city' => 'City',
            'state' => 'ST',
        ]);

        $response = $this->getJson('/api/places/name?name=Place');

        $response->assertOk()->assertJsonFragment(data: ['name' => 'Place Name']);
    }
}
