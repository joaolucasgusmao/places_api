<?php

namespace Tests\Unit;

use App\Services\PlacesService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StorePlaceTest extends TestCase
{
    use RefreshDatabase;

    protected PlacesService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new PlacesService();
    }

    /** @test */
    public function it_can_store_a_place(): void
    {
        $data = [
            'name' => 'Place Name',
            'slug' => 'Place Name',
            'city' => 'City',
            'state' => 'ST',
        ];

        $resource = $this->service->store(data: $data);

        $this->assertDatabaseHas(table: 'places', data: [
            'name' => 'Place Name',
            'slug' => 'place-name',
            'city' => 'City',
            'state' => 'ST',
        ]);

        $this->assertEquals(expected: 'Place Name', actual: $resource->resource->name);
        $this->assertEquals(expected: 'place-name', actual: $resource->resource->slug);
    }
}
