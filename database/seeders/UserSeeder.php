<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $user = [
            [
                'nik'  => '11223445566',
                'division_id' => 1,
                'role' => 'admin',
                'name' => 'Ahmad Ali Mutezar',
                'position' => 'Web Developer',
                'email' => 'aamutezar@gmail.com',
                'phone' => '087883864673',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now()
            ]

        ];

        User::insert($user);
        User::factory(20)->create();
    }
}