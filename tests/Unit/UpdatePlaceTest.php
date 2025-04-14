<?php

namespace Tests\Unit;

use App\Models\Place;
use App\Services\PlacesService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Exceptions\AppError;

class UpdatePlaceTest extends TestCase
{
    use RefreshDatabase;

    protected PlacesService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new PlacesService();
    }

    /** @test */
    public function it_can_update_a_place(): void
    {
        $place = Place::create([
            'name' => 'Old Name',
            'slug' => 'Old Name',
            'city' => 'City',
            'state' => 'ST',
        ]);

        $updated = $this->service->update(id: $place->id, data: [
            'name' => 'New Name',
            'slug' => 'New Name'
        ]);

        $this->assertEquals(expected: 'New Name', actual: $updated->resource->name);
        $this->assertEquals(expected: 'new-name', actual: $updated->resource->slug);
    }

    /** @test */
    public function it_throws_error_when_updating_nonexistent_place(): void
    {
        $this->expectException(exception: AppError::class);
        $this->expectExceptionMessage(message: 'Place not found.');

        $this->service->update(id: 999, data: [
            'name' => 'Name'
        ]);
    }
}
