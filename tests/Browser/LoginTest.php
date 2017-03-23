<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{

    use DatabaseMigrations;

    public function test_user_successful_login()
    {
        $user = factory(App\User::class)->create();

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                    ->assertSee('Login')
                    ->type('email', $user->email)
                    ->type('password', 'secret')
                    ->press('Login')
                    ->assertPathIs('/home');
        });
    }
}
