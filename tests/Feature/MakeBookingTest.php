<?php

namespace Tests\Feature;

use App\Employee;
use App\User;
use App\Business;
use App\Service;
use App\Timeslot;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MakeBookingTest extends TestCase
{

    use DatabaseTransactions;

//    public function test_make_booking()
//    {
//        $business = factory(Business::class)->create();
//        $user = factory(User::class)->create();
//        $service = factory(Service::class)->create(['business_id' => $business->id]);
//        $employee = factory(Employee::class)->create(['business_id' => $business->id]);
//        $timeslot = factory(Timeslot::class)->create(['employee_id' => $employee->id]);
//
//        $employee->services()->attach($service);
//
//        $this->actingAs($user)
//            ->post('/booking', [
//                'user_id' => $user->id,
//                'business_id' => $business->id,
//                'employee_id' => $employee->id,
//                'service_id' => $service->id,
//                'date' => '2017-10-10',
//                'time' => '10:00:00'
//            ]);
//
//        $this->assertDatabaseHas('bookings', [
//            'user_id' => $user->id,
//            'business_id' => $business->id,
//            'employee_id' => $employee->id,
//            'service_id' => $service->id,
//            'date' => '2017-10-10',
//            'time' => '10:00:00'
//        ]);
//    }
}