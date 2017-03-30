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
            ->type('first_name', 'Aiden')
            ->type('last_name','Garipoli')
            ->type('email', 'email@gmail.com')
            ->type('phone','0411122200')
            ->type('address','124 La Trobe St')
            ->type('city','Melbourne')
            ->type('state','VIC')
            ->type('post_code','3000')
            ->type('password', 'password')
            ->type('password_confirmation', 'password')
            ->press('Register')
            ->assertPathIs('/home');
        });
    }
}