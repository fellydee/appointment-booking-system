<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class BookingTest extends TestCase
{
    use DatabaseMigrations;

    protected $booking;

    protected function setUp()
    {
        parent::setUp();

        $this->booking = factory('App\Booking')->create();
    }

    public function test_it_is_saved_to_database_successfully()
    {
        $this->assertDatabaseHas('bookings', [
            'id' => $this->booking->id
        ]);
    }

    public function test_it_has_an_employe()
    {
        $employee = factory('App\Employee')->create();
        $employee->bookings()->save($this->booking);
        $this->assertInstanceOf('App\Employee', $this->booking->employee);
    }

    public function test_it_has_a_business()
    {
        $business = factory('App\Business')->create();
        $business->employees()->save($this->booking);
        $this->assertInstanceOf('App\Business', $this->booking->business);
    }

    public function test_it_has_a_service()
    {
        $service = factory('App\Service')->create();
        $service->bookings()->save($this->booking);
        $this->assertInstanceOf('App\Service', $this->booking->service);
    }

    public function test_it_correctly_formats_start_date_time()
    {

    }

    public function test_it_correctly_formats_end_date_time()
    {

    }
}
