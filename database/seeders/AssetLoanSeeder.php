<?php

namespace Database\Seeders;

use App\Models\AssetLoan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssetLoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AssetLoan::factory(10)->create();
    }
}
