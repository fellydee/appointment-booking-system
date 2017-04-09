<?php

namespace Tests\Feature;

use App\Employee;
use App\User;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AddEmployeeTest extends TestCase
{

    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_employee_create_page_accessible_by_business_owner()
    {
        // User with role os business owner
        $user = factory(User::class)->create(['role' => 0]);

        $respone = $this->actingAs($user)
            ->get('/employees/create');

        $respone->assertStatus(200);
    }

    public function test_employee_view_page_accessible_by_business_owner()
    {
        $user = factory(User::class)->create(['role' => 0]);

        $response = $this->actingAs($user)
            ->get('/employees');

        $response->assertStatus(200);
    }

    public function test_customer_cannot_access_employee_create_page()
    {
        $user = factory(User::class)->create(['role' => 1]);

        $response = $this->actingAs($user)
            ->get('/employees/create');

        $response->assertStatus(302);
    }

    public function test_customer_cannot_access_employee_view_page()
    {
        $user = factory(User::class)->create(['role' => 1]);

        $response = $this->actingAs($user)
            ->get('/employees');

        $response->assertStatus(302);
    }

    public function test_employees_are_visible_on_view_page()
    {
        $employee = factory(Employee::class)->create();
        $user = factory(User::class)->create(['role' => 0]);

        $response = $this->actingAs($user)
            ->get('/employees');

        $response->assertSee(Employee::first()->first_name);
    }

    public function test_employee_added_successfully()
    {
        factory(Employee::class)->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'johndoe@gmail.com',
            'phone' => '0406799838',
            'address' => '123 example st example'
        ]);

        $this->assertDatabaseHas('employees', [
            'first_name' => 'John'
        ]);
    }

    public function test_employee_add_fails_phone_length_too_short()
    {
        $user = factory(User::class)->create(['role' => 0]);

        $this->actingAs($user)
            ->post('/employees', [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'johnny@gmail.com',
                'phone' => '123',
                'address' => '123 example st example'
            ]);

        $this->assertDatabaseMissing('employees', [
            'first_name' => 'John'
        ]);
    }

    public function test_employee_add_fails_phone_length_too_long()
    {
        $user = factory(User::class)->create(['role' => 0]);

        $this->actingAs($user)
            ->post('/employees', [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'johnny@gmail.com',
                'phone' => '213453245346347',
                'address' => '123 example st example'
            ]);

        $this->assertDatabaseMissing('employees', [
            'first_name' => 'John'
        ]);
    }

    public function test_employee_add_passes_phone_length_correct()
    {
        $user = factory(User::class)->create(['role' => 0, 'business_id' => 1]);

        $response = $this->actingAs($user)
            ->post('/employees', [
                'first_name' => 'Daniel',
                'last_name' => 'Stephenson',
                'email' => 'danny@gmail.com',
                'phone' => '1234567890',
                'address' => '123 example st example'
            ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('employees', [
            'first_name' => 'Daniel'
        ]);
    }
}
