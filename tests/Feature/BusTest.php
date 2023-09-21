<?php

namespace Tests\Feature;

use App\Models\Bus;
use App\Models\Seat;
use App\Models\Station;
use App\Models\Trip;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BusTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_available_seats()
    {
        // we create specific stations according to task example
        $cairo = Station::factory()->create(['name' => 'Cairo']);
        $fayoum = Station::factory()->create(['name' => 'AlFayyum']);
        $alminya = Station::factory()->create(['name' => 'AlMinya']);
        $asyut = Station::factory()->create(['name' => 'Asyut']);

        $bus = Bus::factory()->create();

        $activeSeat = Seat::factory()->create([
            'bus_id' => $bus->id,
            'start_station_id' => Station::inRandomOrder()->take(1)->first()->id,
            'end_station_id' => Station::inRandomOrder()->take(1)->first()->id,
            'is_available' => true
        ]);

        $deActiveSeat = Seat::factory()->create([
            'bus_id' => $bus->id,
            'start_station_id' =>  Station::inRandomOrder()->take(1)->first()->id,
            'end_station_id' =>  Station::inRandomOrder()->take(1)->first()->id,
            'is_available' => false
        ]);

        $cairoAsyutTrip = Trip::factory()->create([
            'departure_time' => now(),
            'arrival_time' => Carbon::now()->addHours(3),
            'bus_id' => $bus->id,
        ]);

        //assign stations to the trip by order
        $cairoAsyutTrip->stations()->attach([$cairo->id, $fayoum->id , $alminya->id , $asyut->id]);

        $response = $this->json('GET', '/api/bus/available-seats', [
            'start_station_id' => $cairo->id,
            'end_station_id' => $asyut->id,
        ]);

        $response->assertStatus(200);
        $this->assertEquals($response->json()['data'][0]['id'], $activeSeat->id);
        $this->assertNotEquals($response->json()['data'][0]['id'], $deActiveSeat->id);
        $response ->assertJsonStructure([
        'data' => [
            '*' => [
                'id',
                'seat_no',
                'is_available',
                'bus_id',
                'bus_name',
            ],
        ],
    ]);

    }

    public function test_user_can_book_a_seat_success()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $bus = Bus::factory()->create();

        $seat = Seat::factory()->create([
            'bus_id' => $bus->id,
            'start_station_id' => Station::factory()->create()->first()->id,
            'end_station_id' => Station::factory()->create()->first()->id,
            'is_available' => true
        ]);

        $trip = Trip::factory()->create([
            'departure_time' => now(),
            'arrival_time' => Carbon::now()->addHours(3),
            'bus_id' => $bus->id,
        ]);

        $response = $this->json('POST', '/api/bus/book-seat', [
            'seat_id' => $seat->id,
            'trip_id' => $trip->id
        ]);

       // dd($response);
        $response->assertStatus(201);
    }

    public function test_user_can_book_a_seat_fail() {
        $user = User::factory()->create();
        $this->actingAs($user);

        $bus = Bus::factory()->create();

        $seat = Seat::factory()->create([
            'bus_id' => $bus->id,
            'start_station_id' => Station::factory()->create()->first()->id,
            'end_station_id' => Station::factory()->create()->first()->id,
            'is_available' => false
        ]);

        $trip = Trip::factory()->create([
            'departure_time' => now(),
            'arrival_time' => Carbon::now()->addHours(3),
            'bus_id' => $bus->id,
        ]);
        $response = $this->json('POST', '/api/bus/book-seat', [
            'seat_id' => $seat->id,
            'trip_id' => $trip->id
        ]);

      //  dd($response);

        $response->assertStatus(400);
        $response->assertExactJson(['error' => 'Seat is Not Available']);

    }
}
