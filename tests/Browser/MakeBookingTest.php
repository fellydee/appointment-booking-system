<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class MakeBookingTest extends DuskTestCase
{

    use DatabaseMigrations;

    /**
     * @group booking
     */
    public function test_booking_page_reachable_when_authed()
    {
        $user = factory(User::class)->create();

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/booking')
                ->assertPathIs('/booking');
        });
    }

    /**
     * @group booking
     */
    public function test_booking_page_not_reachable_when_not_authed()
    {
        $this->browse(function ($browser){
            $browser->visit('/booking')
                ->assertPathIs('/login');
        });
    }
}