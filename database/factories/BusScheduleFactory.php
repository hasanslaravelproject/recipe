<?php

namespace Database\Factories;

use App\Models\BusSchedule;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class BusScheduleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BusSchedule::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => $this->faker->dateTime,
            'bus_id' => \App\Models\Bus::factory(),
            'bus_route_id' => \App\Models\BusRoute::factory(),
        ];
    }
}
