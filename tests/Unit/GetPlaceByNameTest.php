<?php

namespace Tests\Unit\Services\Places;

use App\Models\Place;
use App\Services\PlacesService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Exceptions\AppError;

class GetPlaceByNameTest extends TestCase
{
    use RefreshDatabase;

    protected PlacesService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new PlacesService();
    }

    /** @test */
    public function it_can_find_place_by_partial_name_case_and_accent_insensitive(): void
    {
        Place::create([
            'name' => 'Place Name',
            'slug' => 'Place Name',
            'city' => 'City',
            'state' => 'ST',
        ]);

        $results = $this->service->getPlaceByName(name: 'Place Name');

        $this->assertCount(expectedCount: 1, haystack: $results);
        $this->assertEquals(expected: 'Place Name', actual: $results[0]->name);
    }

    /** @test */
    public function it_throws_error_when_no_place_is_found_by_name(): void
    {
        $this->expectException(exception: AppError::class);
        $this->expectExceptionMessage(message: 'No Places found');

        $this->service->getPlaceByName(name: 'Non-existent');
    }
}
