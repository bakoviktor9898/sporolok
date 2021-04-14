<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Country;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $country = Country::whereName('Hungary')->first();

        DB::table('states')->insert([
            [
                'name'          => 'Budapest',
                'country_id'    => $country->id
            ],
            [
                'name'          => 'Hajdú-Bihar',
                'country_id'    => $country->id
            ]
        ]);
    }
}
