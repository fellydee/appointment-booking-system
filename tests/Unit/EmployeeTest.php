<?php

namespace Tests\Unit;

use App\Booking;
use App\Employee;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class EmployeeTest extends TestCase
{
    use DatabaseMigrations;

    protected $employee;

    protected $data;

    protected function setUp()
    {
        parent::setUp();

        $this->employee = factory(Employee::class)->create();

        $this->data = [
            'business_id' => 1,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'johndoe@gmail.com',
            'phone' => '0123456789',
            'address' => '123 example st somewhere'
        ];
    }

    public function test_it_is_saved_to_database_successfully()
    {
        $this->assertDatabaseHas('employees', [
            'email' => $this->employee->email
        ]);
    }

    public function test_it_generates_correct_full_name()
    {
        $this->assertEquals(
            $this->employee->first_name . ' ' . $this->employee->last_name,
            $this->employee->fullName()
        );
    }

    public function test_it_has_a_business()
    {
        $business = factory('App\Business')->create();
        $business->employees()->save($this->employee);
        $this->assertInstanceOf('App\Business', $this->employee->business);
    }

    public function test_it_has_timeslots()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection',
            $this->employee->timeslots
        );
    }

    public function test_it_has_services()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection',
            $this->employee->services
        );
    }

    public function test_it_has_bookings()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection',
                $this->employee->bookings
        );
    }

    public function test_it_is_working_on_assigned_date()
    {
        $date = Carbon::now()->startOfWeek();
        $timeslot = factory('App\Timeslot')->create([
            'day' => 0
        ]);
        $this->employee->timeslots()->save($timeslot);
        $this->assertTrue($this->employee->isWorking($date));
    }

    public function test_it_is_not_working_on_assigned_date()
    {
        $date = Carbon::now()->startOfWeek();
        $this->assertFalse($this->employee->isWorking($date));
    }

    public function test_it_saves_with_correct_phone_format()
    {
        $employee = new Employee();

        if ($employee->validate($this->data)) {
            $employee->fill($this->data);
            $employee->save();
        }

        $this->assertDatabaseHas('employees', [
            'phone' => $employee->phone
        ]);
    }

    public function test_it_does_not_save_with_too_short_phone()
    {
        $this->data['phone'] = '123';

        $employee = new Employee();

        if ($employee->validate($this->data)) {
            $employee->fill($this->data);
            $employee->save();
        }

        $this->assertDatabaseMissing('employees', [
            'phone' => $employee->phone
        ]);
    }

    public function test_it_does_not_save_with_too_long_phone()
    {
        $this->data['phone'] = '12321425324534523';

        $employee = new Employee();

        if ($employee->validate($this->data)) {
            $employee->fill($this->data);
            $employee->save();
        }

        $this->assertDatabaseMissing('employees', [
            'phone' => $employee->phone
        ]);
    }

    public function test_it_saves_with_alpha_first_name()
    {
        $employee = new Employee();

        if ($employee->validate($this->data)) {
            $employee->fill($this->data);
            $employee->save();
        }

        $this->assertDatabaseHas('employees', [
            'first_name' => $employee->first_name
        ]);
    }

    public function test_it_does_not_save_with_non_alpha_first_name()
    {
        $this->data['first_name'] = 'werd2343245dsaf!!';

        $employee = new Employee();

        if ($employee->validate($this->data)) {
            $employee->fill($this->data);
            $employee->save();
        }

        $this->assertDatabaseMissing('employees', [
            'first_name' => $employee->first_name
        ]);
    }

    public function test_it_saves_with_alpha_last_name()
    {
        $employee = new Employee();

        if ($employee->validate($this->data)) {
            $employee->fill($this->data);
            $employee->save();
        }

        $this->assertDatabaseHas('employees', [
            'last_name' => $employee->last_name
        ]);
    }

    public function test_it_does_not_save_with_non_alpha_last_name()
    {
        $this->data['last_name'] = 'sdfgfdg3425!!';

        $employee = new Employee();

        if ($employee->validate($this->data)) {
            $employee->fill($this->data);
            $employee->save();
        }

        $this->assertDatabaseMissing('employees', [
            'last_name' => $employee->last_name
        ]);
    }

    public function test_it_does_not_save_with_zero_length_first_name()
    {
        $this->data['first_name'] = '';

        $employee = new Employee();

        if ($employee->validate($this->data)) {
            $employee->fill($this->data);
            $employee->save();
        }

        $this->assertDatabaseMissing('employees', [
            'first_name' => $employee->first_name
        ]);
    }

    public function test_it_does_not_save_with_zero_length_last_name()
    {
        $this->data['last_name'] = '';

        $employee = new Employee();

        if ($employee->validate($this->data)) {
            $employee->fill($this->data);
            $employee->save();
        }

        $this->assertDatabaseMissing('employees', [
            'last_name' => $employee->last_name
        ]);
    }

    public function test_it_saves_with_valid_address()
    {
        $employee = new Employee();

        if ($employee->validate($this->data)) {
            $employee->fill($this->data);
            $employee->save();
        }

        $this->assertDatabaseHas('employees', [
            'address' => $employee->address
        ]);
    }

    public function test_it_does_not_save_with_zero_length_address()
    {
        $this->data['address'] = '';

        $employee = new Employee();

        if ($employee->validate($this->data)) {
            $employee->fill($this->data);
            $employee->save();
        }

        $this->assertDatabaseMissing('employees', [
            'address' => $employee->address
        ]);
    }

    public function test_it_saves_with_valid_email()
    {
        $employee = new Employee();

        if ($employee->validate($this->data)) {
            $employee->fill($this->data);
            $employee->save();
        }

        $this->assertDatabaseHas('employees', [
            'email' => $employee->email
        ]);
    }

    public function test_it_does_not_save_with_non_unique_email()
    {
        $this->data['email'] = $this->employee->email;

        $employee = new Employee();

        if ($employee->validate($this->data)) {
            $employee->fill($this->data);
            $employee->save();
        }

        $this->assertDatabaseMissing('employees', [
            'email' => $employee->email
        ]);
    }
}
