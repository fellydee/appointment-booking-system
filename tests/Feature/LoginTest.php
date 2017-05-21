<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends TestCase
{

    use DatabaseMigrations;

    public function test_login_page_satus_OK()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_user_can_view_dashboard_when_logged_in()
    {
        $user = factory(User::class)->create(['role' => 1]);

        $response = $this->actingAs($user)
            ->get('/home');

        $response->assertStatus(200);
    }

    public function test_redirect_when_user_is_not_authenticated()
    {
        $response = $this->get('/home');

        $response->assertStatus(302);

        $response->assertRedirect('/login');
    }

    public function test_redirect_when_invalid_credentials()
    {
        $response = $this->post('/login', []);

        $response->assertStatus(302);

        $response->assertRedirect('/');
    }
}
