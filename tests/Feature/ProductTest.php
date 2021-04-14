<?php

namespace Tests\Feature;

use App\Models\Shop;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_add_new_shop()
    {
        $response = $this->post('/shop',[
            'here_map_id'   => 'here:pds:place:348u2rq7-0b48973e5d6f4e90a80400a100f4bea7',
            'street'        => 'Maros utca',
            'house'         => '12',
            'lat'           => 18,
            'lng'           => 19,
            'postal_code'   => 4231,
            'city_name'     => 'Kukutyin',
            'county_name'   => 'Pest',
            'state_name'    => 'Hun',
            'country_name'  => 'Hun',
            'country_code'  => 'Hun',
            'name'          => 'Kukutyin'
        ]);
        $response->assertStatus(200);
    }
   
}
