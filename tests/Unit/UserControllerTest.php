<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    /** @test */
    public function a_user_with_incomplete_profile_cannot_sign_up_for_a_camp()
    {    
        $userA = factory(User::class)->make();;
        $response = $this->get('/camps');
        $response->assertSee('fertigstellen');
    }
}
