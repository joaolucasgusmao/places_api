<?php

namespace Tests\Unit;

use App\Models\Place;
use App\Services\PlacesService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Exceptions\AppError;

class DestroyPlaceTest extends TestCase
{
    use RefreshDatabase;

    protected PlacesService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new PlacesService();
    }

    /** @test */
    public function it_can_delete_a_place(): void
    {
        $place = Place::create([
            'name' => 'To Delete',
            'slug' => 'To Delete',
            'city' => 'Somewhere',
            'state' => 'XX',
        ]);

        $this->service->destroy(id: $place->id);

        $this->assertDatabaseMissing(table: 'places', data: ['id' => $place->id]);
    }

    /** @test */
    public function it_throws_error_when_deleting_nonexistent_place(): void
    {
        $this->expectException(exception: AppError::class);
        $this->expectExceptionMessage(message: 'Place not found.');

        $this->service->destroy(id: 12345);
    }
}
