<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Product;
use App\Models\Manufacturer;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $alfoldi = Manufacturer::whereShortName('Alföldi')->first();
        $mizo = Manufacturer::whereShortName('Mizo')->first();

        $category = Category::whereName('Hűtést igénylő tejek')->first();

        Product::create([
            'name'              => 'Mizo UHT félzsíros tej 2,8% 1 l',
            'manufacturer_id'   => $mizo?->id,
            'category_id'       => $category?->id
        ]);
        Product::create([
            'name'              => 'Magyar Tej ESL tej 2,8% 1 l',
            'manufacturer_id'   => $alfoldi?->id,
            'category_id'       => $category?->id
        ]);
    }
}
