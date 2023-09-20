<?php

namespace Database\Factories;

use App\Models\Bus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trip>
 */
class TripFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'departure_time' => $this->faker->dateTime(),
            'arrival_time' => $this->faker->dateTime(),
            'bus_id' => Bus::inRandomOrder()->take(1)->first()->id,

        ];
    }
}
