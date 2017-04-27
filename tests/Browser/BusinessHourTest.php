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

    public function test_user_add_business_hours_page_access()
    {
        $user = factory(User::class)->create(['role' => 0]);

        $this->browse(function ($browser) use ($user) {
            $browser->loginAs(User::find(1))
                ->visit('/hours')
                ->assertPathIs('/hours');
        });
    }

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

    public function test_user_add_business_hours_non_owner()
    {
        $user = factory(User::class)->create();

        $this->browse(function ($browser) use ($user) {
            $browser->loginAs(User::find(1))
                ->visit('/hours')
                ->assertPathIs('/home');
        });
    }

    public function test_user_add_business_hours_no_end_time_given()
    {
        $user = factory(User::class)->create(['role' => 0]);

        $this->browse(function ($browser) use ($user) {
            $browser->loginAs(User::find(1))
                ->visit('/hours')
                ->select('monday_start','9:00 AM')
                ->select('monday_end','4:00 PM')
                ->select('tuesday_start','9:00 AM')
                ->press('Save')
                ->assertPathIs('/hours');
        });
    }

    public function test_user_add_business_hours_end_before_start_time()
    {
        $user = factory(User::class)->create(['role' => 0]);

        $this->browse(function ($browser) use ($user) {
            $browser->loginAs(User::find(1))
                ->visit('/hours')
                ->select('monday_start','4:00 PM')
                ->select('monday_end','9:00 AM')
                ->press('Save')
                ->assertPathIs('/hours');
        });
    }
}
