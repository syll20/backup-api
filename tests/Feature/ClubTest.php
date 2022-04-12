<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClubTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_not_access_clubs_page_if_not_connected()
    {
        $response = $this->get('/admin/clubs');
        $response->assertStatus(302);
    }


    public function test_auth_user_can_access_clubs_page()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response = $this->get('/admin/clubs');
        $response->assertStatus(200);
    }


    public function test_auth_user_can_import_clubs()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response = $this->get('/admin/clubs/import');
        //$response->assertStatus(200);

        $response->assertSeeText('Roazhon Park');
    }
}
