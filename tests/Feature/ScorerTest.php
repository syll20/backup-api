<?php

namespace Tests\Feature;

use App\Models\Scorer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ScorerTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_not_access_admin_scorer_page_if_not_connected()
    {
        $response = $this->get('/admin/standings');
        $response->assertStatus(302);
    }

    
    public function test_auth_user_can_access_admin_scorers()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response = $this->get('/admin/standings');
        $response->assertStatus(200);
    }


    public function test_auth_user_can_update_total_goals_for_a_player()
    {
        $this->update_goals('total');
    }


    public function test_auth_user_can_update_home_goals_for_a_player()
    {
        $this->update_goals('home');
    }


    public function test_auth_user_can_update_away_goals_for_a_player()
    {
        $this->update_goals('away');
    }


    protected function update_goals($location)
    { 
    
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $scorer = Scorer::factory()->create();

        $goals = $scorer->$location;

        $response = $this->actingAs($user)
        ->patch('/admin/scorer', [
            'id' => $scorer->id,
            'player_id' => $scorer->player_id,
            'goal' => ($goals +1),
            'location' => $location
        ]);

        $this->assertDatabaseHas('scorers', [
            'id' => $scorer->id,
            $location => ($goals +1)
        ]);
    }
}
