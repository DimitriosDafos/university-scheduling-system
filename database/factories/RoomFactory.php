<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room> */
class RoomFactory extends Factory
{
    public function definition()
    {
        $f = \Faker\Factory::create();
        return [
            'name' => strtoupper($f->bothify('R-??###')),
            'location' => $f->streetName(),
            'capacity' => $f->numberBetween(10, 200),
            'features' => $f->randomElements(['beamer','whiteboard','video','ac'], 2),
            'active' => true,
        ];
    }
}
