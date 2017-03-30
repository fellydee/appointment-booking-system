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
            ->select('state','VIC')
            ->type('post_code','3000')
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
            ->type('address','124 La Trobe St')
            ->type('city','Melbourne')
            ->select('state','VIC')
            ->type('post_code','3000')
            ->type('password', 'abcdEFGH1234')
            ->type('password_confirmation', '4321HGFEdcba')
            ->press('Register')
            ->assertPathIs('/register');
        });
    }

    public function test_user_registration_post_code_incorrect()
    {
        $this->browse(function ($browser) {
            $browser->visit('/register')
            ->type('first_name', 'Aiden')
            ->type('last_name','Garipoli')
            ->type('email', 'email@gmail.com')
            ->type('phone','0411122200')
            ->type('address','124 La Trobe St')
            ->type('city','Melbourne')
            ->select('state','VIC')
            ->type('post_code','30002')
            ->type('password', 'abcdEFGH1234')
            ->type('password_confirmation', 'abcdEFGH1234')
            ->press('Register')
            ->assertPathIs('/home');
        });
    }

    public function test_user_registration_state_not_selected()
    {
        $this->browse(function ($browser) {
            $browser->visit('/register')
            ->type('first_name', 'Aiden')
            ->type('last_name','Garipoli')
            ->type('email', 'email@gmail.com')
            ->type('phone','0411122200')
            ->type('address','124 La Trobe St')
            ->type('city','Melbourne')
            ->select('state','')
            ->type('post_code','30002')
            ->type('password', 'abcdEFGH1234')
            ->type('password_confirmation', 'abcdEFGH1234')
            ->press('Register')
            ->assertPathIs('/home');
        });
    }
}