<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divions = [

            [
                'name' => 'IT',
                'created_at' => now(),
                'updated_at' => now()
            ],
    
            [
                'name' => 'Data',
                'created_at' => now(),
                'updated_at' => now()
            ],
    
            [
                'name' => 'Project',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        Division::insert($divions);
    }
}
