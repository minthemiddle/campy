<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserRegistrationTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRegistration()
    {
        $this->visit('/')
             ->click('Register')
             ->type('test1', 'username')
             ->type('test@test.dev', 'email')
             ->type('secret', 'password')
             ->type('secret', 'password_confirmation')
             ->press('submit')
             ->seePageIs('/home')
             ->see('Deine Daten');
    }
}
