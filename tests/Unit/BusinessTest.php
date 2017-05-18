<?php

namespace Tests\Unit;

use App\Business;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class BusinessTest extends TestCase
{
    use DatabaseMigrations;

    protected $business;

    protected $data;

    protected function setUp()
    {
        parent::setUp();

        $this->business = factory('App\Business')->create();

        $this->data = [
            'name' => 'hairdresser',
            'address' => '123 example st somewhere',
            'phone' => '0123456789',
            'email' => 'dressers@gmail.com'
        ];
    }

    public function test_it_is_saved_to_database_correctly()
    {
        $this->assertDatabaseHas('businesses', [
            'name' => $this->business->name
        ]);
    }

    public function test_it_has_employees()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection',
            $this->business->employees
        );
    }

    public function test_it_has_business_hours()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection',
            $this->business->businessHours
        );
    }

    public function test_it_has_services()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection',
            $this->business->services
        );
    }

    public function test_it_saves_with_valid_name()
    {
        $business = new Business();

        if ($business->validate($this->data)) {
            $business->fill($this->data);
            $business->save();
        }

        $this->assertDatabaseHas('businesses', [
            'name' => $business->name
        ]);
    }

    public function test_it_does_not_save_with_invalid_name()
    {
        $this->data['name'] = '';

        $business = new Business();

        if ($business->validate($this->data)) {
            $business->fill($this->data);
            $business->save();
        }

        $this->assertDatabaseMissing('businesses', [
            'name' => $business->name
        ]);
    }

    public function test_it_saves_with_valid_address()
    {
        $business = new Business();

        if ($business->validate($this->data)) {
            $business->fill($this->data);
            $business->save();
        }

        $this->assertDatabaseHas('businesses', [
            'address' => $business->address
        ]);
    }

    public function test_it_does_not_save_with_invalid_address()
    {
        $this->data['address'] = '';

        $business = new Business();

        if ($business->validate($this->data)) {
            $business->fill($this->data);
            $business->save();
        }

        $this->assertDatabaseMissing('businesses', [
            'address' => $business->address
        ]);
    }

    public function test_it_saves_with_valid_phone()
    {
        $business = new Business();

        if ($business->validate($this->data)) {
            $business->fill($this->data);
            $business->save();
        }

        $this->assertDatabaseHas('businesses', [
            'phone' => $business->phone
        ]);
    }

    public function test_it_does_not_save_with_invalid_phone()
    {
        $this->data['phone'] = 'dasf';

        $business = new Business();

        if ($business->validate($this->data)) {
            $business->fill($this->data);
            $business->save();
        }

        $this->assertDatabaseMissing('businesses', [
            'phone' => $business->phone
        ]);
    }

    public function test_it_saves_with_valid_email()
    {
        $business = new Business();

        if ($business->validate($this->data)) {
            $business->fill($this->data);
            $business->save();
        }

        $this->assertDatabaseHas('businesses', [
            'email' => $business->email
        ]);
    }

    public function test_it_does_not_save_with_invalid_email()
    {
        $this->data['email'] = 'weqr';

        $business = new Business();

        if ($business->validate($this->data)) {
            $business->fill($this->data);
            $business->save();
        }

        $this->assertDatabaseMissing('businesses', [
            'email' => $business->email
        ]);
    }
}
