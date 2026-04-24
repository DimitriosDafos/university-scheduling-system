<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        // Admin account
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make('secret123'),
            'auth_provider' => 'local',
            'role' => 'admin',
        ]);

        // Beispielbenutzer
        User::factory()->count(10)->create();
    }
}
