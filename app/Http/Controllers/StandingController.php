<?php

namespace App\Http\Controllers;

use App\Contracts\SoccerDataApiInterface;
use App\Http\Requests\UpdateStandingRequest;
use App\Models\Standing;
use App\Enums\Location;
use App\Facades\CallServer;
use App\Models\Calendar;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class StandingController extends Controller
{
    public function index()
    {
        return view('admin.standings', [
            'homeRankings' => Standing::rankings(Location::Home),
            'awayRankings' => Standing::rankings(Location::Away)
        ]);
    }


    public function show(Location $location)
    {
        return view('admin.standings_location', [
            'rankings' => Standing::rankings($location),
            'location' => $location->value
        ]);
    }


    public function update(UpdateStandingRequest $request)
    {
        $validated = $request->validated();

        foreach($validated['ranking'] as $ranking)
        {
            Standing::
                where('id', $ranking['id'])->
                where('club_id', $ranking['club_id'])->
                update($ranking);
        }
        
        return redirect('/admin/standings')->with('success', 'Standings updated');
    }

    public function fixtures()
    {
        return view('admin.standings-fixtures', [
            'calendars' => Calendar::orderBy('kickoff', 'asc')->get()
        ]);
    }

    public function autoUpdate(Request $request, SoccerDataApiInterface $soccerDataApi)
    {
        $attributes = $request->validate([
            'fixture'      => ['required', 'integer', Rule::exists('calendars', 'fixture')]
        ]);

        $endpoint = $soccerDataApi->getFixtureById($request->fixture);
            
        $data = CallServer::handle($endpoint, $soccerDataApi);
        $fixture = $data[0];

        // get all games for that round - getFixturesByMixedFilters()
        $endpoint = $soccerDataApi->getFixturesByMixedFilters([
            'league' => $fixture->league->id,
            'season' => $fixture->league->season,
            'round' => $fixture->league->round
        ]);

        $roundFixtures = CallServer::handle($endpoint, $soccerDataApi);

        foreach($roundFixtures as $roundFixture)
        {
            $this->updateTeamStats($roundFixture, Location::Home, Location::Away);
            $this->updateTeamStats($roundFixture, Location::Away, Location::Home); 
        }

        // Now let's take care of the 1-20 ranking
        $this->updateTeamRank(Location::Home);
        $this->updateTeamRank(Location::Away);

        return redirect('/admin/standings')->with('success', 'Standings updated');
    }

    protected function updateTeamRank(Location $location)
    {
        $teams = Standing::where('location', '=', $location->value)
            ->orderBy('points', 'desc')
            ->orderBy('goals_diff', 'desc')
            ->orderBy('win', 'desc')
            ->orderBy('goals_for', 'desc')
            ->get();

        $rank = 0;

        foreach($teams as $team)
        {
            $team->rank = ++$rank;
            $team->save();
        }
    }

    protected function updateTeamStats($roundFixture, Location $teamLocation, Location $opponentLocation)
    {
        $team = Standing::where('club_id', '=', $roundFixture->teams->{$teamLocation->value}->id)
            ->where('location', '=', $teamLocation->value)
            ->first();

        $team->played += 1;

        if($roundFixture->teams->{$teamLocation->value}->winner === true){
            $team->points += 3;
            $team->win += 1;
            $team->last5 = $this->updateLast5($team, 'W');//Str::padLeft($team->last5, 6, 'W' );

        }else if($roundFixture->teams->{$teamLocation->value}->winner === false){
            $team->lose += 1;
            $team->last5 = $this->updateLast5($team, 'L'); //Str::padLeft($team->last5, 6, 'L' );

        }else{
            $team->points += 1;
            $team->draw += 1;
            $team->last5 = $this->updateLast5($team, 'D'); //Str::padLeft($team->last5, 6, 'D' );
        }

        $team->goals_for += $roundFixture->goals->{$teamLocation->value};
        $team->goals_against += $roundFixture->goals->{$opponentLocation->value};
        $team->goals_diff = $team->goals_for - $team->goals_against;
        //$team->last5 = Str::substr($team->last5, 0, 5);

        //dd($team);
         $team->save();
    }

    /**
     * Pad lastResult letter in the left 
     *  then keep only the 5 first letters (remove the 6th and oldest one)
     */
    protected function updateLast5($team, $lastResult)
    {
        $nb = $team->played >= 5? 5 : $team->played;

        return Str::substr(
            Str::padLeft(
                $team->last5, ($nb+1), $lastResult
            ), 
            0, $nb
        );
    }
}
