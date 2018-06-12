<?php

namespace Tests\Browser;

use App\Camp;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LegalDocsTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_access_tos()
    {

        $user = factory(User::class)->create();
        $camp = factory(Camp::class)->create();



        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/teilnahmebedingungen')
                    ->assertSee('Teilnahmebedingungen');
        });
    }

    public function user_can_access_privacy_statement()
    {
        $user = factory(User::class)->create();
        $camp = factory(Camp::class)->create();

        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/datenschutz')
                    ->assertSee('personenbezogener');
        });
    }
}
