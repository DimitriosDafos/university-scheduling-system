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
        $f = \Faker\Factory::create();
        $start = $f->dateTimeBetween('-1 week', '+2 weeks');
        $durationMinutes = $f->randomElement([45, 60, 90, 120]);
        $end = (clone $start)->modify("+{$durationMinutes} minutes");

        return [
            'title' => $f->sentence(3),
            'description' => $f->optional()->paragraph(),
            'room_id' => Room::inRandomOrder()->first()?->id ?? Room::factory(),
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'start_datetime' => Carbon::instance($start),
            'end_datetime' => Carbon::instance($end),
            'category' => $f->randomElement(['lecture','exam','event','other']),
            'all_day' => false,
            'color' => $f->optional()->hexColor(),
            'recurrence_rule' => null,
        ];
    }
}
