<?php

namespace Tests\Feature;

use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

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
             ->click('Registrieren')
             ->type('test1', 'username')
             ->type('test@test.dev', 'email')
             ->type('secret', 'password')
             ->type('secret', 'password_confirmation')
             ->press('submit')
             ->seePageIs('/home')
             ->see('Deine Daten');
    }

    // make sure you cannot register for a camp without giving details
    public function testRegisterWithoutDetailsNotPossible()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
        ->visit('/camps')
        ->see('vervollstätigen');
    }

}
