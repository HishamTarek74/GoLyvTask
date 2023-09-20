<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Bus;
use App\Models\Seat;
use App\Models\Station;
use App\Models\Trip;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(StationSeeder::class);
        $this->call(BusSeeder::class);
        $this->call(SeatSeeder::class);
        $this->call(TripSeeder::class);

        // we create specific stations according to task example

        $cairo = Station::factory()->create(['name' => 'Cairo']);
        $fayoum = Station::factory()->create(['name' => 'AlFayyum']);
        $alminya = Station::factory()->create(['name' => 'AlMinya']);
        $asyut = Station::factory()->create(['name' => 'Asyut']);

        // also create a trip with all stations in this way
        $trip = Trip::factory()->create([
            'departure_time' => now(),
            'arrival_time' => Carbon::now()->addHours(3),
            'bus_id' => Bus::inRandomOrder()->take(1)->first()->id,
        ]);

        //assign stations to the trip by order
        $trip->stations()->attach([$cairo->id, $fayoum->id , $alminya->id , $asyut->id]);
    }
}
