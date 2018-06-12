<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegistrationTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testRegister()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->clickLink('Registrieren')
                    ->type('username', 'test1')
                    ->type('email', 'test@test.dev')
                    ->type('password', 'secret')
                    ->type('password_confirmation', 'secret')
                    ->keys('#birthdate', '01012000')
                    ->click('button[name=submit]')
                    ->assertSee('Deine Daten');
        });
    }

}