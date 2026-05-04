<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomsTableSeeder extends Seeder
{
    public function run(): void
    {
        $rooms = [
            ['name' => 'A101', 'location' => 'Building A', 'capacity' => 120, 'features' => ['beamer','whiteboard','ac'], 'active' => true],
            ['name' => 'A102', 'location' => 'Building A', 'capacity' => 80,  'features' => ['beamer','whiteboard'], 'active' => true],
            ['name' => 'A201', 'location' => 'Building A', 'capacity' => 40,  'features' => ['whiteboard'], 'active' => true],
            ['name' => 'B101', 'location' => 'Building B', 'capacity' => 200, 'features' => ['beamer','video','ac'], 'active' => true],
            ['name' => 'B202', 'location' => 'Building B', 'capacity' => 60,  'features' => ['beamer'], 'active' => true],
            ['name' => 'C010', 'location' => 'Building C', 'capacity' => 25,  'features' => ['whiteboard','video'], 'active' => true],
            ['name' => 'C011', 'location' => 'Building C', 'capacity' => 25,  'features' => ['whiteboard'], 'active' => true],
            ['name' => 'LAB1', 'location' => 'Lab Wing',   'capacity' => 30,  'features' => ['beamer','whiteboard','ac'], 'active' => true],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}
