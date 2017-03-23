<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegisterTest extends TestCase
{

    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_register_page_status_OK()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_register_redirect_when_logged_in()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get('/register');

        $response->assertStatus(302);
    }
}
