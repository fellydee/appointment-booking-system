<?php

namespace Tests\Feature;

use App\Business;
use App\Employee;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class EmployeeTest extends TestCase
{
    use DatabaseMigrations;

    protected $employee;

    protected $business_owner;

    protected $user;

    protected $business;

    protected function setUp()
    {
        parent::setUp();

        $this->employee = factory(Employee::class)->create();
        $this->business_owner = factory(User::class)->create(['role' => 0]);
        $this->user = factory(User::class)->create(['role' => 1]);
        $this->bussiness = factory(Business::class)->create();
    }

    public function test_employee_create_page_accessible_by_business_owner()
    {
        $respone = $this->actingAs($this->business_owner)
            ->get('/employees/create');

        $respone->assertStatus(200);
    }

    public function test_employee_index_page_accessible_by_business_owner()
    {
        $response = $this->actingAs($this->business_owner)
            ->get('/employees');

        $response->assertStatus(200);
    }

    public function test_employee_show_page_accessible_by_business_owner()
    {
        $response = $this->actingAs($this->business_owner)
            ->get('/employees/' . $this->employee->id);

        $response->assertStatus(200);
    }

    public function test_employee_edit_page_accessible_by_business_owner()
    {
        $response = $this->actingAs($this->business_owner)
            ->get('/employees/' . $this->employee->id . '/edit');

        $response->assertStatus(200);
    }

    public function test_customer_cannot_access_employee_create_page()
    {
        $response = $this->actingAs($this->user)
            ->get('/employees/create');

        $response->assertStatus(302);
    }

    public function test_customer_cannot_access_employee_index_page()
    {
        $response = $this->actingAs($this->user)
            ->get('/employees');

        $response->assertStatus(302);
    }

    public function test_customer_cannot_access_employee_show_page()
    {
        $response = $this->actingAs($this->user)
            ->get('/employees/' . $this->employee->id);

        $response->assertStatus(302);
    }

    public function test_customer_cannot_access_employee_edit_page()
    {
        $response = $this->actingAs($this->user)
            ->get('/employees/' . $this->employee->id . '/edit');

        $response->assertStatus(302);
    }



//    public function test_employee_add_fails_phone_length_too_short()
//    {
//        $user = factory(User::class)->create(['role' => 0]);
//
//        $this->actingAs($user)
//            ->post('/employees', [
//                'first_name' => 'John',
//                'last_name' => 'Doe',
//                'email' => 'johnny@gmail.com',
//                'phone' => '123',
//                'address' => '123 example st example'
//            ]);
//
//        $this->assertDatabaseMissing('employees', [
//            'first_name' => 'John'
//        ]);
//    }
//
//    public function test_employee_add_fails_phone_length_too_long()
//    {
//        $user = factory(User::class)->create(['role' => 0]);
//
//        $this->actingAs($user)
//            ->post('/employees', [
//                'first_name' => 'John',
//                'last_name' => 'Doe',
//                'email' => 'johnny@gmail.com',
//                'phone' => '213453245346347',
//                'address' => '123 example st example'
//            ]);
//
//        $this->assertDatabaseMissing('employees', [
//            'first_name' => 'John'
//        ]);
//    }
//
//    public function test_employee_add_passes_phone_length_correct()
//    {
//        $user = factory(User::class)->create(['role' => 0, 'business_id' => 1]);
//
//        $response = $this->actingAs($user)
//            ->post('/employees', [
//                'first_name' => 'Daniel',
//                'last_name' => 'Stephenson',
//                'email' => 'danny@gmail.com',
//                'phone' => '1234567890',
//                'address' => '123 example st example'
//            ]);
//
//        $response->assertStatus(302);
//
//        $this->assertDatabaseHas('employees', [
//            'first_name' => 'Daniel'
//        ]);
//    }
}
