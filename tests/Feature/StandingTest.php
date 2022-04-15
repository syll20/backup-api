<?php

namespace Tests\Feature;

use App\Enums\Location;
use App\Models\Standing;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StandingTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_not_access_admin_standing_page_if_not_connected()
    {
        $response = $this->get('/admin/standings');
        $response->assertStatus(302);
    }

    
    public function test_auth_user_can_access_admin_standing()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response = $this->get('/admin/standings');
        $response->assertStatus(200);
    }


    public function test_auth_user_can_access_admin_standing_home()
    {
        $this->auth_user_can_access_admin_standing_by_location(Location::Home);
    }


    public function test_auth_user_can_access_admin_standing_away()
    {
        $this->auth_user_can_access_admin_standing_by_location(Location::Away);
    }


    /*public function test_auth_user_can_access_admin_standing_total()
    {
        $this->auth_user_can_access_admin_standing_by_location(Location::Total);
    }*/


    protected function auth_user_can_access_admin_standing_by_location(Location $location)
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response = $this->get('/admin/standings/' . $location->value);
        $response->assertSeeText("Standings {$location->value}");
    }


    protected function update_goals($location)
    { 
    
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        for($i = 0; $i <= 19; $i++){
            $standing = Standing::factory()->create();
        }

        $points = $standing->points;

        $response = $this->actingAs($user)
            ->patch('/admin/standings', [
                'id' => $scorer->id,
                'player_id' => $scorer->player_id,
                'goal' => ($goals +1),
                'location' => $location->value
        ]);

        $this->assertDatabaseHas('scorers', [
            'id' => $scorer->id,
            $location->value => ($goals +1)
        ]);
    }
}
