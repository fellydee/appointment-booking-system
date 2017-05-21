<?php

namespace Tests\Unit;

use App\Service;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ServiceTest extends TestCase
{
    use DatabaseMigrations;

    protected $service;

    protected $data;

    protected function setUp()
    {
        parent::setUp();

        $this->service = factory('App\Service')->create();

        $this->data = [
            'business_id' => 1,
            'title' => 'title',
            'description' => 'description',
            'duration' => 30,
            'price' => 50
        ];
    }

    public function test_it_is_saved_to_database_successfully()
    {
        $this->assertDatabaseHas('services', [
            'title' => $this->service->title
        ]);
    }

    public function test_it_formats_price_correctly()
    {
        $this->assertContains('$', $this->service->priceFormatted());
    }

    public function test_it_has_employees()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection',
            $this->service->employees
        );
    }

    public function test_it_has_a_business()
    {
        $business = factory('App\Business')->create();
        $business->employees()->save($this->service);
        $this->assertInstanceOf('App\Business', $this->service->business);
    }

    public function test_it_has_bookings()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection',
            $this->service->bookings
        );
    }

    public function test_it_saves_with_a_valid_title()
    {
        $service = new Service();

        if ($service->validate($this->data)) {
            $service->fill($this->data);
            $service->save();
        }

        $this->assertDatabaseHas('services', [
            'title' => $service->title
        ]);
    }

    public function test_it_does_not_save_with_a_zero_length_title()
    {
        $this->data['title'] = '';

        $service = new Service();

        if ($service->validate($this->data)) {
            $service->fill($this->data);
            $service->save();
        }

        $this->assertDatabaseMissing('services', [
            'title' => $service->title
        ]);
    }

    public function test_it_saves_with_a_valid_description()
    {
        $service = new Service();

        if ($service->validate($this->data)) {
            $service->fill($this->data);
            $service->save();
        }

        $this->assertDatabaseHas('services', [
            'description' => $service->description
        ]);
    }

    public function test_it_does_not_save_with_a_zero_length_description()
    {
        $this->data['description'] = '';

        $service = new Service();

        if ($service->validate($this->data)) {
            $service->fill($this->data);
            $service->save();
        }

        $this->assertDatabaseMissing('services', [
            'description' => $service->description
        ]);
    }

    public function test_it_saves_with_a_valid_duration()
    {
        $service = new Service();

        if ($service->validate($this->data)) {
            $service->fill($this->data);
            $service->save();
        }

        $this->assertDatabaseHas('services', [
            'duration' => $service->duration
        ]);
    }

    public function test_it_does_not_save_with_non_numeric_duration()
    {
        $this->data['duration'] = 'wqef';

        $service = new Service();

        if ($service->validate($this->data)) {
            $service->fill($this->data);
            $service->save();
        }

        $this->assertDatabaseMissing('services', [
            'duration' => $service->duration
        ]);
    }

    public function test_it_saves_with_a_valid_price()
    {
        $service = new Service();

        if ($service->validate($this->data)) {
            $service->fill($this->data);
            $service->save();
        }

        $this->assertDatabaseHas('services', [
            'price' => $service->price
        ]);
    }

    public function test_it_does_not_save_with_a_non_numeric_price()
    {
        $this->data['price'] = 'fegsdfg';

        $service = new Service();

        if ($service->validate($this->data)) {
            $service->fill($this->data);
            $service->save();
        }

        $this->assertDatabaseMissing('services', [
            'price' => $service->price
        ]);
    }
}
