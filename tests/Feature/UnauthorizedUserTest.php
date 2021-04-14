<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UnauthorizedUserTest extends TestCase
{
   public function test_not_registered_user_cannot_reach_profile_page()
    {
       $response = $this->get('/user/profile/1');

       $response->assertRedirect('/login');
    }

    
   
}
