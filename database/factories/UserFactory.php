<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'role_id' => 2,
            'google_id' => null,
            'name' => $this->faker->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('12345'),
            'image' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
        ]);
    }
}
