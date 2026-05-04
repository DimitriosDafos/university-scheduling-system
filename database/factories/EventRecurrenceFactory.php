<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Event;

/** @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EventRecurrence> */
class EventRecurrenceFactory extends Factory
{
    public function definition()
    {
        return [
            'event_id' => Event::inRandomOrder()->first()?->id ?? Event::factory(),
            'rrule' => 'FREQ=WEEKLY;BYDAY=MO,WE,FR',
            'until' => $this->faker->dateTimeBetween('+1 month', '+6 months'),
            'count' => null,
            'exdates' => null,
        ];
    }
}
