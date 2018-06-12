<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\DB;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class MyCampsTest extends DuskTestCase
{

    use DatabaseMigrations;

    /** @test */
    public function logging_in_is_successful()
    {

        $user = factory(User::class)->create();

        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/mycamps')
                    ->assertSee('Meine Camps');
        });
    }
}
