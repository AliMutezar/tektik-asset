<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vendor>
 */
class VendorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_name' => fake()->company(),
            'website' => fake()->url(),
            'pic' => fake()->name(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'province_code' => fake()->numberBetween(11, 19),
            'city_code' => fake()->numberBetween(1101, 1109),
            'district_code' => fake()->numberBetween(110101, 110110),
            'village_code' => fake()->numberBetween(1101012001, 1101012004),
        ];
    }
}
