<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function user_filling_out_all_fields_correctly_can_register_at_system()
    {
        $response = $this->post('/register', [
            'username' => 'test001',
            'email' => 'test001@test.test',
            'birthdate' => '2001-01-01',
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/profile');
    }
}
