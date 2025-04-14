<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StorePlaceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_store_a_place(): void
    {
        $response = $this->postJson('/api/places', data: [
            'name' => 'Place Name',
            'slug' => 'Place Name',
            'city' => 'City',
            'state' => 'ST',
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas(table: 'places', data: ['slug' => 'place-name']);
    }
}
