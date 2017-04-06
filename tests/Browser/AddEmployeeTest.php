<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AddEmployeeTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $user = factory(User::class)->create(['role' => 0]);

        $this->browse(function ($browser) use ($user) {
            $browser->loginAs(User::find(1))
                ->assertSee('Dashboard');
//                ->visit('/employee/create')
//                ->assertSee('Add Employee');
//                ->type('first_name', 'Employee')
//                ->type('last_name', 'One')
//                ->type('email', 'employeeone@gmail.com')
//                ->type('phone', '123456789')
//                ->type('address', '1 One Road')
//                ->press('Add Employee')
//                ->assertPathIs('/employee');
        });
    }
}
