<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Event;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;

class EventsTableSeeder extends Seeder
{
    public function run(): void
    {
        if (Room::count() === 0) $this->call(RoomsTableSeeder::class);
        if (User::count() === 0) $this->call(UsersTableSeeder::class);

        $categories = [];
        foreach (['Lecture', 'Exam', 'Event', 'Other'] as $name) {
            $id = DB::table('categories')->insertGetId(['name' => $name, 'created_at' => now(), 'updated_at' => now()]);
            $categories[strtolower($name)] = $id;
        }

        $rooms = Room::all();
        $user  = User::first();
        $today = Carbon::today();

        $events = [
            ['title' => 'Mathematics Lecture',      'room' => 'A101', 'cat' => 'lecture', 'days' => 0,  'start' => '08:00', 'end' => '09:30'],
            ['title' => 'Physics Lecture',           'room' => 'B101', 'cat' => 'lecture', 'days' => 0,  'start' => '10:00', 'end' => '11:30'],
            ['title' => 'Computer Science Lab',      'room' => 'LAB1', 'cat' => 'lecture', 'days' => 0,  'start' => '13:00', 'end' => '15:00'],
            ['title' => 'Chemistry Exam',            'room' => 'B101', 'cat' => 'exam',    'days' => 1,  'start' => '09:00', 'end' => '12:00'],
            ['title' => 'Faculty Meeting',           'room' => 'C010', 'cat' => 'event',   'days' => 1,  'start' => '14:00', 'end' => '15:30'],
            ['title' => 'English Seminar',           'room' => 'A201', 'cat' => 'lecture', 'days' => 1,  'start' => '10:00', 'end' => '11:30'],
            ['title' => 'Biology Lecture',           'room' => 'A102', 'cat' => 'lecture', 'days' => 2,  'start' => '08:00', 'end' => '09:30'],
            ['title' => 'Student Council Meeting',   'room' => 'C011', 'cat' => 'event',   'days' => 2,  'start' => '12:00', 'end' => '13:00'],
            ['title' => 'Statistics Lecture',        'room' => 'A101', 'cat' => 'lecture', 'days' => 3,  'start' => '10:00', 'end' => '11:30'],
            ['title' => 'Programming Workshop',      'room' => 'LAB1', 'cat' => 'event',   'days' => 3,  'start' => '14:00', 'end' => '17:00'],
            ['title' => 'History Lecture',           'room' => 'A102', 'cat' => 'lecture', 'days' => 4,  'start' => '08:00', 'end' => '09:30'],
            ['title' => 'Mathematics Exam',          'room' => 'B101', 'cat' => 'exam',    'days' => 5,  'start' => '09:00', 'end' => '12:00'],
            ['title' => 'Open Day Presentation',     'room' => 'B101', 'cat' => 'event',   'days' => 7,  'start' => '10:00', 'end' => '16:00'],
            ['title' => 'Physics Lab',               'room' => 'LAB1', 'cat' => 'lecture', 'days' => -1, 'start' => '13:00', 'end' => '15:00'],
            ['title' => 'Alumni Networking Evening', 'room' => 'B101', 'cat' => 'event',   'days' => -2, 'start' => '18:00', 'end' => '21:00'],
        ];

        foreach ($events as $e) {
            $room = $rooms->where('name', $e['room'])->first() ?? $rooms->first();
            Event::create([
                'title'           => $e['title'],
                'room_id'         => $room->id,
                'user_id'         => $user->id,
                'category_id'     => $categories[$e['cat']],
                'start_datetime'  => $today->copy()->addDays($e['days'])->setTimeFromTimeString($e['start']),
                'end_datetime'    => $today->copy()->addDays($e['days'])->setTimeFromTimeString($e['end']),
                'all_day'         => false,
                'color'           => null,
                'recurrence_rule' => null,
            ]);
        }
    }
}
