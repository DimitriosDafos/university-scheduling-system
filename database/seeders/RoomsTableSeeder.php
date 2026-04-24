<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomsTableSeeder extends Seeder
{
    public function run(): void
    {
        Room::factory()->count(8)->create();

        // Beispielräume mit festen Namen
        Room::create(['name' => 'A101', 'location' => 'Gebäude A', 'capacity' => 120, 'features' => ['beamer','whiteboard'], 'active' => true]);
        Room::create(['name' => 'B202', 'location' => 'Gebäude B', 'capacity' => 60, 'features' => ['beamer'], 'active' => true]);
    }
}
