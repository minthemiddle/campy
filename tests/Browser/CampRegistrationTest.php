<?php

namespace Tests\Browser;

use App\Camp;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CampRegistrationTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function users_can_not_register_with_incomplete_profile()
    {

        $user = factory(User::class)->create([
            'firstname' => '',
            'lastname' => '',
            'zip' => '',
            'mobile' => '',
        ]);
        $camp = factory(Camp::class)->create();



        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/camps')
                    ->assertSee('Profil vervollständigen');
        });
    }

    /** @test */
    public function users_can_access_camps_registration_after_completing_profile()
    {
        $user = factory(User::class)->create([
            'firstname' => '',
            'lastname' => '',
            'zip' => '',
            'mobile' => '',
        ]);
        $camp = factory(Camp::class)->create();

        $this->browse(function (Browser $browser) {
            $browser->visit('/home')
                    ->type('input[name=firstname]', 'grace')
                    ->type('input[name=lastname]', 'grace')
                    ->type('input[name=mobile]', '32168')
                    ->type('input[name=zip]', '10115')
                    ->type('input[name=guardian_firstname]', 'Walter')
                    ->type('input[name=guardian_lastname]', 'Murray')
                    ->type('input[name=guardian_email]', 'walter@murray.com')
                    ->type('input[name=guardian_phone]', '32168')
                    ->click('input[name=submit')
                    ->visit('/camps')
                    ->assertDontSee('Profil vervollständigen');

        });

    }
}
