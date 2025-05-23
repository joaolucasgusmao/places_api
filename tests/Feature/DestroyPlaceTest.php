<?php

namespace Tests\Feature;

use App\Models\Place;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DestroyPlaceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_delete_place(): void
    {
        $place = Place::create([
            'name' => 'To Delete',
            'slug' => 'To Delete',
            'city' => 'City',
            'state' => 'ST',
        ]);

        $response = $this->deleteJson("/api/places/{$place->id}");

        $response->assertNoContent();
        $this->assertDatabaseMissing(table: 'places', data: ['id' => $place->id]);
    }
}
