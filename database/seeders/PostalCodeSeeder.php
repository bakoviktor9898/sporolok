<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\City;

class PostalCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $budapest = City::whereName('Budapest')->first();
        $debrecen = City::whereName('Debrecen')->first();

        DB::table('postal_codes')->insert([
            [
                'code'      => '1071',
                'city_id'   => $budapest->id
            ],
            [
                'code'      => '4225',
                'city_id'   => $debrecen->id
            ]
        ]);
    }
}
