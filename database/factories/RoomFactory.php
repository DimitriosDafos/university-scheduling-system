<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room> */
class RoomFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => strtoupper($this->faker->bothify('R-??###')),
            'location' => $this->faker->streetName(),
            'capacity' => $this->faker->numberBetween(10, 200),
            'features' => $this->faker->randomElements(['beamer','whiteboard','video','ac'], 2),
            'active' => true,
        ];
    }
}
