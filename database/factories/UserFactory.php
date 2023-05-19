<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'nik' => fake()->nik(),
            'division_id' => fake()->numberBetween(1,3),
            'role' => fake()->randomElement(['admin', 'staff']),
            'name' => fake()->name(),
            'position' => fake()->randomElement(['Backend Developer', 'Frontend Developer', 'System Analyst', 'QA Enggineer', 'Busines Analyst', 'Project Manager', 'Technical Lead']),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'email_verified_at' => now(),
            'password' =>  bcrypt('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
