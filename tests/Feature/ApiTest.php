<?php

namespace Tests\Feature;

use App\User;
use App\Booking;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiTest extends TestCase
{

    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_api_mybookings_avaliable_when_user_is_not_authenticated()
    {
        $user = factory(User::class)->create();

        $respone = $this->actingAs($user)
            ->get('/api/myBookings');

        $respone->assertStatus(200);
    }

    public function test_api_mybookings_redirect_when_user_is_not_authenticated()
    {
        $respone = $this->get('/api/myBookings')
            ->assertRedirect('/login');
    }

}
