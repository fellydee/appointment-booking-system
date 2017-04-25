<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class BusinessHourTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_user_add_business_hours()
    {
        $user = factory(User::class)->create(['role' => 0]);

        $this->browse(function ($browser) use ($user) {
            $browser->loginAs(User::find(1))
                ->visit('/hours')
                ->select('monday_start','9:00 AM')
                ->select('monday_end','4:00 PM')
                ->select('tuesday_start','9:00 AM')
                ->select('tuesday_end','4:00 PM')
                ->press('Save')
                ->assertPathIs('/admin');
        });
    }
}
