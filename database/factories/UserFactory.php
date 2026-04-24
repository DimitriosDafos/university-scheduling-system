<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    public function definition(): array
    {
        $provider = fake()->randomElement(['local', 'microsoft']);

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => $provider === 'local'
                ? Hash::make('password')
                : Hash::make(Str::random(24)),
            'microsoft_id' => $provider === 'microsoft' ? fake()->uuid() : null,
            'auth_provider' => $provider,
            'role' => fake()->randomElement(['admin', 'staff', 'viewer']),
            'remember_token' => Str::random(10),
        ];
    }
}
