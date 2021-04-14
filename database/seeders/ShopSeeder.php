<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Address;
use App\Models\ShopName;
use Illuminate\Database\Eloquent\Builder;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $debrecen = Address::whereHas('postalCode.city', function (Builder $query) {
            return $query->whereName('Debrecen');
        })->first();

        $budapest = Address::whereHas('postalCode.city', function (Builder $query) {
            return $query->whereName('Budapest');
        })->first();

        $spar = ShopName::whereName('SPAR')->first();

        DB::table('shops')->insert([
            [
                'address_id'    => $debrecen->id,
                'shop_name_id'  => $spar->id,
                'here_map_id'   => 'here:pds:place:348u2rq7-0b48973e5d6f4e90a80400a100f4bea7'
            ],
            [
                'address_id'    => $budapest->id,
                'shop_name_id'  => $spar->id,
                'here_map_id'   => 'here:pds:place:348u2mw6-32c1eda60aa74ad2b9fe62427c8bfeda'
            ]
        ]);
    }
}
