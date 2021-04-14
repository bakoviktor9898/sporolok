<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1)->create([
            'name'              => 'Kiss Janos',
            'email'             => 'kiss.janos@example.com',
            'password'          => Hash::make('password'),
            'email_verified_at' => null,
        ]);

        \App\Models\User::factory(1)->create([
            'name'              => 'Bako Viktor',
            'email'             => 'bako.viktor@test.com',
            'password'          => Hash::make('password'),
            'email_verified_at' => null,
        ]);

        DB::table('roles')->insert([
            ['name' => 'user'],
            ['name' => 'admin']
        ]);

        DB::table('user_roles')->insert([
            'user_id' => 2,
            'role_id' => 2
        ]);

        DB::table('user_roles')->insert([
            'user_id' => 1,
            'role_id' => 1
        ]);

        DB::table('countries')->insert([
            'name' => 'Hungary',
            'code' => 'HUN'
        ]);

        DB::table('states')->insert([
            [
                'name'          => 'Budapest',
                'country_id'    => '1'
            ],
            [
                'name'          => 'Hajdú-Bihar',
                'country_id'    => '1'
            ]
        ]);

        DB::table('counties')->insert([
            [
                'name'      => 'Debreceni Járás',
                'state_id'  => '2'
            ],
            [
                'name'      => 'Budapest',
                'state_id'  => '1'
            ]
        ]);

        DB::table('cities')->insert([
            [
                'name'      => 'Budapest',
                'county_id' => '2'
            ],
            [
                'name'      => 'Debrecen',
                'county_id' => '1'
            ]
        ]);

        DB::table('postal_codes')->insert([
            [
                'code'      => '1071',
                'city_id'   => '1'
            ],
            [
                'code'      => '4225',
                'city_id'   => '2'
            ]
        ]);

        DB::table('addresses')->insert([
            [
                'street'            => 'Ötvenhatosok tere',
                'house'             => '6',
                'postal_code_id'    => '2',
                'lat'               => 47.54768,
                'lng'               => 21.6106
            ],
            [
                'street'            => 'Damjanich utca',
                'house'             => '11',
                'postal_code_id'    => '1',
                'lat'               => 47.50638,
                'lng'               => 19.07588
            ]
        ]);

        DB::table('shop_names')->insert([
            'name' => 'SPAR'
        ]);

        DB::table('shops')->insert([
            [
                'address_id'    => '1',
                'shop_name_id'  => '1',
                'here_map_id'   => 'here:pds:place:348u2rq7-0b48973e5d6f4e90a80400a100f4bea7'
            ],
            [
                'address_id'    => '2',
                'shop_name_id'  => '1',
                'here_map_id'   => 'here:pds:place:348u2mw6-32c1eda60aa74ad2b9fe62427c8bfeda'
            ]
        ]);

        DB::table('manufacturers')->insert([
            [
                'name'          => 'Alföldi Tej',
                'short_name'    => 'Alföldi'
            ],
            [
                'name'          => 'Sole-Mizo',
                'short_name'    => 'Mizo'
            ]
        ]);

        DB::table('categories')->insert([
            [
                'parent_id'     => null,
                'name'          => 'Tejtermékek, tojás'
            ],
            [
                'parent_id'     => 1,
                'name'          => 'Tejek, tejitalok'
            ],
            [
                'parent_id'     => 2,
                'name'          => 'Hűtést igénylő tejek'
            ]
        ]);

        DB::table('products')->insert([
            [
                'name'              => 'Mizo UHT félzsíros tej 2,8% 1 l',
                'manufacturer_id'   => 2,
                'category_id'       => 3
            ],
            [
                'name'              => 'Magyar Tej ESL tej 2,8% 1 l',
                'manufacturer_id'   => 1,
                'category_id'       => 3
            ]
        ]);

        DB::table('currencies')->insert(['name'  => 'Ft']);

        DB::table('prices')->insert([
            [
                'price'         => '309',
                'currency_id'   => 1,
                'quantity'      => '1',
                'per'           => 'liter',
                'added_at'      => Carbon::now()
            ],
            [
                'price'         => '319',
                'currency_id'   => 1,
                'quantity'      => '1',
                'per'           => 'liter',
                'added_at'      => Carbon::now()
            ]
        ]);

        DB::table('product_shops')->insert([
            [
                'product_id'    => 1,
                'shop_id'       => 2,
                'price_id'      => 2
            ],
            [
                'product_id'    => 2,
                'shop_id'       => 2,
                'price_id'      => 1
            ]
        ]);
    }
}
