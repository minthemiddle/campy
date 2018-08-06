<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /** @test */
    public function non_registered_cannot_view_admin_dashboard()
    {
        $response = $this->get('/admin');
        $response->assertStatus(302);
        $response->assertLocation('/login');
    }

    /** @test */
    public function non_admin_cannot_view_admin_dashboard()
    {
        $user = factory('App\User')->make();
        $response = $this->actingAs($user)->get('/admin');
        $response->assertStatus(403);
    }

    /** @test */
    public function admin_can_view_admin_dashboard()
    {
        $user = factory('App\User')->states('admin')->create();
        $response = $this->actingAs($user)->get('/admin');
        $response->assertStatus(200);
    }
}
