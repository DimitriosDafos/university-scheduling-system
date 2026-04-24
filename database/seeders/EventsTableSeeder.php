<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\Room;
use App\Models\User;

class EventsTableSeeder extends Seeder
{
    public function run(): void
    {
        // Stelle sicher, dass Räume und Benutzer existieren
        if (Room::count() === 0) {
            $this->call(RoomsTableSeeder::class);
        }
        if (User::count() === 0) {
            $this->call(UsersTableSeeder::class);
        }

        // Erstelle Events
        Event::factory()->count(30)->create();

        // Beispiel Event mit Wiederholung
        $room = Room::first();
        $user = User::first();

        Event::create([
            'title' => 'Mathematik Vorlesung',
            'description' => 'Einführung in Analysis',
            'room_id' => $room->id,
            'user_id' => $user->id,
            'start_datetime' => now()->next('monday')->setTime(9,0),
            'end_datetime' => now()->next('monday')->setTime(10,30),
            'category' => 'lecture',
            'all_day' => false,
            'color' => '#1E90FF',
            'recurrence_rule' => 'FREQ=WEEKLY;BYDAY=MO;COUNT=12',
        ]);
    }
}
