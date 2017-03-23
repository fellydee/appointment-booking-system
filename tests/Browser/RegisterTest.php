<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegisterTest extends DuskTestCase
{

    use DatabaseMigrations;

    public function test_user_successful_registration()
    {
        $this->browse(function ($browser) {
            $browser->visit('/register')
                    ->type('name', 'Tyler Watkins')
                    ->type('email', 'tjwato@gmail.com')
                    ->type('password', 'password')
                    ->type('password_confirmation', 'password')
                    ->press('Register')
                    ->assertPathIs('/home');
        });
    }
}
