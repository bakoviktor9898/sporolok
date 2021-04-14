<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LocationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_cannot_reach_home_without_position()
    {
        $response = $this->get('/home');

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    public function test_user_can_reach_home_with_position_set()
    {
        session()->put(
            'position', [
                'lat' => 47.8908901,
                'lng' => 19.1238901
            ]
        );

        $response = $this->get('/home');
        $response->assertStatus(200);
    }

    public function test_user_cannot_reach_landing_page_when_location_set()
    {
        session()->put(
            'position', [
                'lat' => 47.8908901,
                'lng' => 19.1238901
            ]
        );

        $response = $this->get('/');
        $response->assertStatus(302);
        $response->assertRedirect('/home');
    }
}
