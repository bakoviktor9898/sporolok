<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\PostalCode;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $budapest = PostalCode::whereCode('1071')->first();
        $debrecen = PostalCode::whereCode('4225')->first();

        DB::table('addresses')->insert([
            [
                'street'            => 'Ötvenhatosok tere',
                'house'             => '6',
                'postal_code_id'    => $debrecen->id,
                'lat'               => 47.54768,
                'lng'               => 21.6106
            ],
            [
                'street'            => 'Damjanich utca',
                'house'             => '11',
                'postal_code_id'    => $budapest->id,
                'lat'               => 47.50638,
                'lng'               => 19.07588
            ]
        ]);
    }
}
