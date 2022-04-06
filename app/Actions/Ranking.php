<?php

namespace App\Actions;

use App\Facades\CallServer;
use Illuminate\Support\Facades\DB;

class Ranking
{
    protected $standings;
    protected $fixtures;


    public function generalGoalaverage($location)
    {
        return sprintf("%+d", $this->standings($location, 'goalsDiff'));
    }


    public function teamWdl($location)
    {
        $games = $this->standings($location, $location);

        return sprintf("%dV- %dN - %dD", $games->win, $games->draw, $games->lose);
    }


    public function teamPoints($location)
    {
        $games = $this->standings($location, $location);

        return  ($games->win *3 + $games->draw);
    }


    public function teamGoalaverage($location)
    {
        $games = $this->standings($location, $location);

        return  sprintf("%+d", $games->goals->for - $games->goals->against);
    }


    public function teamRanking($location)
    {
        return $this->standingsDB($location, 'rank');
    }

    
    public function teamLast5($location)
    {
        return str_replace(
            ['W', 'D', 'L'],
            ['V', 'N', 'D'],
            $this->standingsDB($location, 'last5')
        );
    }


    public function standingsDB($where, $field)
    {  
        return DB::table('standings')->where([
            ['club_id', '=', $this->fixtures->teams->$where->id],
            ['location', '=', $where]
        ])->value($field);
    }


    public function standings($where, $field)
    {
        

        foreach($this->standings as $standing)
        {
            if($standing->team->id == $this->fixtures->teams->$where->id)
            {
                return  $standing->$field;
            }
        }
        return "-";
    }

    public function loadStandings($fixtures, $soccerDataApi)
    {
        if(isset($this->standings)){
            return;
        }

        if(! isset($this->fixtures)){
            $this->fixtures = $fixtures;
        }

        $endpoint = $soccerDataApi->getStandingsByLeagueAndSeason(
            $fixtures->league->id, 
            $fixtures->league->season
        );

        $tmp = CallServer::handle($endpoint, $soccerDataApi);

        $this->standings = $tmp[0]->league->standings[0];
    }
}