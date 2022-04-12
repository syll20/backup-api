<?php

namespace Tests\Feature;

use App\Models\Calendar;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CalendarTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_not_access_calendar_if_not_connected()
    {
        $response = $this->get('/admin/calendars');
        $response->assertStatus(302);
    }


    public function test_auth_user_can_access_calendar()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response = $this->get('/admin/calendars');
        $response->assertStatus(200);
    }


    public function test_kickoff_has_to_be_well_formated()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $calendar = Calendar::factory()->create();

        $kickoff = $calendar->kickoff;

        $response = $this->actingAs($user)
        ->patch('/admin/calendars/', [
            'id' => $calendar->id,
            'kickoff' => '2000-07-12'
        ]);

        $this->assertDatabaseHas('calendars', [
            'id' => $calendar->id,
            'kickoff' => $kickoff
        ]);
    }


    public function test_auth_user_can_update_calendar()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $calendar = Calendar::factory()->create();

        $response = $this->actingAs($user)
        ->patch('/admin/calendars/', [
            'id' => $calendar->id,
            'kickoff' => '1998-07-12 22:22:22'
        ]);

        $this->assertDatabaseHas('calendars', [
            'id' => $calendar->id,
            'kickoff' => '1998-07-12 22:22:22'
        ]);
    }

}
