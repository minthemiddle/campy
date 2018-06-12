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
}
