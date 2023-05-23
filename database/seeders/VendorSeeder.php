<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendor = [
            [
                'company_name' => 'PT. Citra Pesona',
                'website' => 'www.citrapesona.com',
                'pic' => 'Muhamad Alryan',
                'phone' => '08956052986008',
                'address' => 'PT. Citra Pesona',
                'province_code' => 31,
                'city_code' => 3173,
                'district_code' => 317308,
                'village_code' => 3173081006,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        Vendor::insert($vendor);
        Vendor::factory(10)->create();
    }
}
