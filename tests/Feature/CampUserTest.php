<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\CampUser;
use App\Camp;
use App\User;

class CampUserTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_register_for_camp()
    {
        $user = factory('App\User')->create();
        $camp = factory('App\Camp')->create();
        $response = $this->register_for_camp($user,$camp);
        $response->assertLocation('/mycamps');
        $this->assertDatabaseHas("camp_user", [
            'user_id' => $user->id,
            'camp_id' => $camp->id,
        ]);
    }

    /** @test */
    public function user_can_not_double_register_for_camp() {
        $user = factory('App\User')->create();
        $camp = factory('App\Camp')->create();
        $response = $this->register_for_camp($user,$camp);
        $response->assertLocation('/mycamps');
        $count = CampUser::where('user_id', $user->id)->where('camp_id', $camp->id)->count();
        $this->assertTrue($count == 1);
    }

    public function register_for_camp($user, $camp) {
        return $this->actingAs($user)->post('/mycamps/', [
            'tos' => '1',
            'consent' => '1',
            'laptop' => 'own',
            'contribution' => 'payer',
            'camp' => $camp->id,
        ]);
    }
}
