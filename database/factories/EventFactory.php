<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;

/** @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event> */
class EventFactory extends Factory
{
    public function definition()
    {
        $start = $this->faker->dateTimeBetween('-1 week', '+2 weeks');
        $durationMinutes = $this->faker->randomElement([45, 60, 90, 120]);
        $end = (clone $start)->modify("+{$durationMinutes} minutes");

        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->optional()->paragraph(),
            'room_id' => Room::inRandomOrder()->first()?->id ?? Room::factory(),
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'start_datetime' => Carbon::instance($start),
            'end_datetime' => Carbon::instance($end),
            'category' => $this->faker->randomElement(['lecture','exam','event','other']),
            'all_day' => false,
            'color' => $this->faker->optional()->hexColor(),
            'recurrence_rule' => null,
        ];
    }
}
