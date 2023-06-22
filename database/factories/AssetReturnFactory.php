<?php

namespace Database\Factories;

use App\Models\Loan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\asset_return>
 */
class AssetReturnFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'return_code' => fake()->numerify('return-####'),
            'loan_id' => Loan::pluck('id')->random(),
            'signature_returner' => fake()->imageUrl(640, 480, 'animals', true),
            'admin_user_id' => fake()->numberBetween(1, 3),
            'signature_admin' => fake()->imageUrl(640, 480, 'animals', true),
            'date_returned' => fake()->dateTimeThisMonth(),
            'photo_returned' => fake()->imageUrl(640, 480, 'people', true),
        ];
    }
}
