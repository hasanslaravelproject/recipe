<?php

namespace Database\Factories;

use App\Models\BusCategory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class BusCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BusCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'total seat' => $this->faker->randomNumber(0),
            'seatnumbers' => $this->faker->text(255),
        ];
    }
}
