<?php

namespace Tests\Unit\Services\Places;

use App\Models\Place;
use App\Services\PlacesService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Exceptions\AppError;

class GetPlaceTest extends TestCase
{
    use RefreshDatabase;

    protected PlacesService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new PlacesService();
    }

    /** @test */
    public function it_can_return_all_places(): void
    {
        Place::factory()->count(3)->create();
        $collection = $this->service->get();
        $this->assertCount(expectedCount: 3, haystack: $collection);
    }

    /** @test */
    public function it_can_retrieve_a_place_by_id(): void
    {
        $place = Place::create([
            'name' => 'Place Name',
            'slug' => 'place-name',
            'city' => 'City',
            'state' => 'ST',
        ]);

        $resource = $this->service->retrieve(id: $place->id);
        $this->assertEquals(expected: 'Place Name', actual: $resource->resource->name);
    }

    /** @test */
    public function it_throws_error_when_retrieving_nonexistent_place(): void
    {
        $this->expectException(exception: AppError::class);
        $this->expectExceptionMessage(message: 'Place not found.');
        $this->service->retrieve(id: 999);
    }
}
