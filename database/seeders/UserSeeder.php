<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $availableCountries = Country::pluck('id')->toArray();

        for ($userIndex = 1; $userIndex <= 10; $userIndex++) {
            User::create([
                'name' => "User {$userIndex}",
                'email' => "user{$userIndex}@example.com",
                'password' => Hash::make(str_repeat('1', 12)),
                'is_active' => true,
                'country_id' => $availableCountries[array_rand($availableCountries)],
            ]);
        }
    }
}
