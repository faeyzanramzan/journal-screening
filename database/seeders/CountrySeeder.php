<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $countries = [
            'Malaysia',
            'Indonesia',
            'Singapore',
            'India',
            'United States',
            'United Kingdom',
            'Others'
        ];

        foreach ($countries as $country) {

            Country::create([
                'name' => $country
            ]);

        }
    }
}
