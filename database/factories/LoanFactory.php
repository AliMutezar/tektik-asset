<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Loan>
 */
class LoanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'loan_code' => fake()->numerify('loan-####'),
            'loan_user_id' => fake()->numberBetween(1,20),
            'signature_loan' => fake()->imageUrl(640, 480, 'animals', true),
            'admin_user_id' => fake()->numberBetween(1,3),
            'signature_admin' => fake()->imageUrl(640, 480, 'animals', true),
            'date_receipt' => fake()->dateTimeThisMonth(),
            'photo_receipt' => fake()->imageUrl(640, 480, 'people', true),
            'status' => fake()->boolean(),
            'return_code' => null
        ];
    }
}
