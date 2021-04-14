<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\County;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $budapest = County::whereName('Budapest')->first();
        $debrecen = County::whereName('Debreceni Járás')->first();

        DB::table('cities')->insert([
            [
                'name'      => 'Budapest',
                'county_id' => $budapest->id
            ],
            [
                'name'      => 'Debrecen',
                'county_id' => $debrecen->id
            ]
        ]);
    }
}
