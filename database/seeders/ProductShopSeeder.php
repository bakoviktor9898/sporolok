<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Product;
use App\Models\Shop;
use App\Models\Price;
use App\Models\ProductShop;
use Illuminate\Database\Eloquent\Builder;

class ProductShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mizo = Product::whereName('Mizo UHT félzsíros tej 2,8% 1 l')->first();
        $magyar = Product::whereName('Magyar Tej ESL tej 2,8% 1 l')->first();

        $sparBudapest = Shop::whereHas('address.postalCode.city', function (Builder $query) {
            return $query->where('cities.name', 'Budapest');
        })->whereHas('name', function (Builder $query) {
            return $query->where('shop_names.name', 'Spar');
        })->first();

        $mizoAr = Price::wherePrice(319)->first();
        $magyarAr = Price::wherePrice(309)->first();

        ProductShop::create([
            'product_id'    => $mizo->id,
            'shop_id'       => $sparBudapest->id,
            'price_id'      => $mizoAr->id
        ]);

        ProductShop::create([
            'product_id'    => $magyar->id,
            'shop_id'       => $sparBudapest->id,
            'price_id'      => $magyarAr->id
        ]);

    }
}
