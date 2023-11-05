<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\RiderLocation;

class RiderLocationApiTest extends TestCase
{
    use RefreshDatabase;

    public function testStoreRiderLocation()
    {
        $data = [
            'rider_id' => 1,
            'service_name' => 'food_delivery',
            'lat' => 40.7128,
            'lng' => -74.0060,
            'capture_time' => now(),
        ];

        $response = $this->json('POST', '/api/rider-locations', $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('rider_locations', $data);
    }

    public function testFindNearbyRiders()
    {
        // Assuming you have some rider locations in your test database
        RiderLocation::create([
            'rider_id' => 2,
            'service_name' => 'food_delivery',
            'lat' => 40.7127,
            'lng' => -74.0059,
            'capture_time' => now(),
        ]);

        $restaurantId = 1;
        $restaurantLocation = [
            'restaurant_lat' => 40.7128,
            'restaurant_lng' => -74.0060,
        ];

        $response = $this->json('GET', "/api/restaurant/$restaurantId/nearby-riders", $restaurantLocation);

        $response->assertStatus(200);
        $response->assertJsonCount(1); // Check if one nearby rider is found
    }
}
