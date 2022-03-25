<?php

namespace App\Http\Controllers;

use App\Contracts\SoccerDataApiInterface;
use App\Models\Club;
use App\Servers\CallServer;

class clubController extends Controller
{
    public function index()
    {

        return view('admin.club-list', [
            'clubs' => Club::orderBy('name', 'ASC')->get()
        ]);
    }

    public function create()
    {
        // temp
        return view('admin.club-list');
    }

    public function import(SoccerDataApiInterface $soccerDataApi, CallServer $callServer)
    {
        $league = $soccerDataApi->league;
        $season = $soccerDataApi->season;
    
        $endpoint = $soccerDataApi->getTeamsByLeagueAndSeason(
            $league, 
            $season
        );

        $teams = $callServer->handle($endpoint);

        foreach($teams as $team)
        {
            if(Club::find($team->team->id) === null)
            {
                $club = new Club();
                $club->id = $team->team->id;
                $club->name = $team->team->name;
                $club->founded = $team->team->founded;
                $club->logo = $team->team->logo;
                $club->venue = $team->venue->name;
                $club->venue_logo = $team->venue->image;
                $club->save();
            }
        }

        return redirect('/admin/clubs');
    }
    
}
