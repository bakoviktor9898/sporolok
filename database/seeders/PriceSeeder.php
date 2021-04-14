<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Price;
use App\Models\Currency;
use Illuminate\Support\Carbon;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currency = Currency::whereName('Ft')->first();

        Price::create([
            'price'         => '309',
            'currency_id'   => $currency->id,
            'quantity'      => '1',
            'per'           => 'liter',
            'added_at'      => Carbon::now()
        ]);

        Price::create([
            'price'         => '319',
            'currency_id'   => $currency->id,
            'quantity'      => '1',
            'per'           => 'liter',
            'added_at'      => Carbon::now()
        ]);
    }
}
