<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Asset>
 */
class AssetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'vendor_id' => fake()->numberBetween(1, 8),
            'category_asset_id' => 1,
            'asset_name' => fake()->randomElement(['Laptop HP', 'MacBook', 'Camera', 'Drone', 'Monitor', 'Mouse']),
            'serial_number' => fake()->randomNumber(5, true),
            'condition' => fake()->randomElement(['good', 'not bad', 'bad']),
            'price_unit' => fake()->randomElement([5000000, 15000000, 7000000, 5000000, 10000000, 2000000]),
            'stock_unit' => fake()->numberBetween(1,10)
        ];
    }
}
