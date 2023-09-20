<?php

namespace Database\Factories;

use App\Models\Bus;
use App\Models\Station;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seat>
 */
class SeatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'seat_no' => $this->faker->unique()->randomNumber(),
            'is_available' => $this->faker->boolean(),
            'bus_id' => Bus::inRandomOrder()->take(1)->first()->id,
            'start_station_id' => Station::inRandomOrder()->take(1)->first()->id,
            'end_station_id' => Station::inRandomOrder()->take(1)->first()->id,
        ];
    }
}
