<?php

namespace Tests\Feature\PlacesController;

use App\Models\Place;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetPlacesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_get_all_places(): void
    {
        Place::factory()->count(2)->create();

        $response = $this->getJson('/api/places');

        $response->assertOk()->assertJsonCount(count: 2);
    }
}
