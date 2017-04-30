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
            ->type('address','124 La Trobe St, Melbourne VIC 3000')
            ->type('password', 'abcdEFGH1234')
            ->type('password_confirmation', 'abcdEFGH1234')
            ->press('Register')
            ->assertPathIs('/home');
        });
    }

    public function test_user_registration_password_mismatch()
    {
        $this->browse(function ($browser) {
            $browser->visit('/register')
            ->type('first_name', 'Aiden')
            ->type('last_name','Garipoli')
            ->type('email', 'email@gmail.com')
            ->type('phone','0411122200')
            ->type('address','124 La Trobe St, Melbourne VIC 3000')
            ->type('password', 'abcdEFGH1234')
            ->type('password_confirmation', '4321HGFEdcba')
            ->press('Register')
            ->assertPathIs('/register');
        });
    }

    public function test_user_registration_password_incorrect_format_no_uppercase()
    {
        $this->browse(function ($browser) {
            $browser->visit('/register')
                ->type('first_name', 'Aiden')
                ->type('last_name','Garipoli')
                ->type('email', 'email@gmail.com')
                ->type('phone','0411122200')
                ->type('address','124 La Trobe St, Melbourne VIC 3000')
                ->type('password', '1234asdf')
                ->type('password_confirmation', '1234asdf')
                ->press('Register')
                ->assertPathIs('/register');
        });
    }

    public function test_user_registration_password_incorrect_format_no_lowercase()
    {
        $this->browse(function ($browser) {
            $browser->visit('/register')
                ->type('first_name', 'Aiden')
                ->type('last_name','Garipoli')
                ->type('email', 'email@gmail.com')
                ->type('phone','0411122200')
                ->type('address','124 La Trobe St, Melbourne VIC 3000')
                ->type('password', '1234ASDF')
                ->type('password_confirmation', '1234ASDF')
                ->press('Register')
                ->assertPathIs('/register');
        });
    }

    public function test_user_registration_password_incorrect_format_length()
    {
        $this->browse(function ($browser) {
            $browser->visit('/register')
                ->type('first_name', 'Aiden')
                ->type('last_name','Garipoli')
                ->type('email', 'email@gmail.com')
                ->type('phone','0411122200')
                ->type('address','124 La Trobe St, Melbourne VIC 3000')
                ->type('password', '12asAD')
                ->type('password_confirmation', '12asAD')
                ->press('Register')
                ->assertPathIs('/register');
        });
    }
}