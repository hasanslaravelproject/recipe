<?php

namespace Database\Factories;

use App\Models\SeatClass;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class SeatClassFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SeatClass::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'unit_seat_price' => $this->faker->randomNumber(2),
        ];
    }
}
