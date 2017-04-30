<?php

namespace Tests\Browser;

use App\Business;
use App\Employee;
use App\Service;
use App\Timeslot;
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
            $browser->loginAs($user)
                ->visit('/booking')
                ->assertPathIs('/booking');
        });
    }

    /**
     * @group booking
     */
    public function test_booking_page_not_reachable_when_not_authed()
    {
        $this->browse(function ($browser) {
            $browser->visit('/booking')
                ->assertPathIs('/login');
        });
    }

    /**
     * @group booking
     */
    public function test_booking_page_for_service_can_be_reached()
    {
        $user = factory(User::class)->create();
        $business = factory(Business::class)->create();
        $service = factory(Service::class)->create(['business_id' => $business->id]);

        $this->browse(function ($browser) use ($user,$service) {
            $browser->loginAs($user)
                ->visit('/booking/service/' . $service->id)
                ->assertPathIs('/booking/service/' . $service->id);
        });
    }

    /**
     * @group booking
     */
    public function test_booking_page_for_service_employee_is_visable()
    {
        $user = factory(User::class)->create();
        $business = factory(Business::class)->create();
        $service = factory(Service::class)->create(['business_id' => $business->id]);
        $employee = factory(Employee::class)->create(['business_id' => $business->id]);

        $employee->services()->attach($service);

        $this->browse(function ($browser) use ($user,$service,$employee) {
            $browser->loginAs($user)
                ->visit('/booking/service/' . $service->id)
                ->assertSee($employee->fullName());
        });
    }

    /**
     * @group booking
     */
    public function test_booking_page_when_service_employee_is_selected()
    {
        $user = factory(User::class)->create();
        $business = factory(Business::class)->create();
        $service = factory(Service::class)->create(['business_id' => $business->id]);
        $employee = factory(Employee::class)->create(['business_id' => $business->id]);

        $employee->services()->attach($service);

        $this->browse(function ($browser) use ($user,$service,$employee) {
            $browser->loginAs($user)
                ->visit('/booking/service/' . $service->id . '/employee/' . $employee->id)
                ->assertSee($employee->fullName());
        });
    }

    /**
     * @group booking
     */
    public function test_booking_page_when_service_employee_is_selected_hours()
    {
        $user = factory(User::class)->create();
        $business = factory(Business::class)->create();
        $service = factory(Service::class)->create(['business_id' => $business->id]);
        $employee = factory(Employee::class)->create(['business_id' => $business->id]);
        $timeslot = factory(Timeslot::class)->create(['employee_id'=>$employee->id]);

        $employee->services()->attach($service);

        $this->browse(function ($browser) use ($user,$service,$employee,$timeslot) {
            $browser->loginAs($user)
                ->visit('/booking/service/' . $service->id . '/employee/' . $employee->id)
                ->assertSee($timeslot->start_time);
        });
    }
}