<?php

namespace App\Services;


use App\Contracts\SoccerDataApiInterface;
use App\Http\Requests\StoreFixtureRequest;
use App\Models\Standing;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use IntlDateFormatter;

class CentralStation
{
    protected $date = null;
    protected $team_id = null;
    protected $ficture_id = null;
    protected $placeholders = null;
    protected $presentation = null;
    protected $endpoint = null;

    protected $fixtures = null;
    protected $standings = null;
    protected $injuries = null;

    public function __construct(StoreFixtureRequest $request, SoccerDataApiInterface $soccerDataApi)
    {
        $this->request = $request;
        $this->request['season'] = '2021';
        $this->date = $request['date'];
        $this->team_id = $request['team'];
        $this->placeholders = $request['placeholders'];
        $this->presentation = $request['presentation'];
        $this->soccerDataApi = $soccerDataApi;
    }

    public function handle()
    {
        $this->template = $this->getTemplate();

        foreach($this->placeholders as $placeholder)
        {
            $functionName = Str::camel($placeholder);

            if (method_exists($this, $functionName)) {
                var_dump($placeholder . ": ". $functionName ."<br>");
                $this->template = str_replace("%".$placeholder, $this->$functionName(), $this->template);
            }
        }
        dd($this->template);

        
    }


    /**
     * COMPETITION
     */
    protected function competition()
    {
        var_dump("Dans function competition<br>");
        $this->loadFixtures();

        return $this->fixtures->league->name;
    }

    protected function round()
    {
        var_dump("Dans function round<br>");
        $this->loadFixtures();

        $tmp = explode('-', $this->fixtures->league->round);
        return trim($tmp[1]) . "e journée";
    }

    /**
     * DATE
     */
    protected function dateTime()
    {
        var_dump("Dans function dateTime<br>");
        $this->loadFixtures();

        return (new IntlDateFormatter(
            "fr_FR" ,
            IntlDateFormatter::LONG, 
            IntlDateFormatter::SHORT, 
            'Europe/Paris',
            IntlDateFormatter::GREGORIAN
        ))->format($this->fixtures->fixture->timestamp);
    }

    /**
     * VENUES
     */
    protected function venue()
    {
        var_dump("Dans function venue<br>");
        $this->loadFixtures();
        return $this->fixtures->fixture->venue->name;
    }

    /**
     * TEAMS LOGOS
     */
    protected function homeTeamLogo($where = 'home')
    {
        $this->loadFixtures();
        return $this->fixtures->teams->$where->logo;
    }

    protected function awayTeamLogo()
    {
        return $this->homeTeamLogo('away');
    }

    /**
     * REFEREES
     */
    protected function mainReferee()
    {
        var_dump("Dans function referee<br>");
        $this->loadFixtures();
        return $this->fixtures->fixture->referee;
    }

    /**
     * SIDELINED
     */
    protected function homeTeamInjuries($where = 'home')
    {
        var_dump("Dans function homeTeamInjuries<br>");

        $this->loadInjuries();
        $this->loadFixtures();

        $list = [];

        if(!isset($this->injuries)){
            return "";
        }

        foreach($this->injuries as $injurie)
        {
            if($injurie->team->id == $this->fixtures->teams->$where->id)
            {
                $list[] = $injurie->player->name;
            }
         }
        return implode(", ", $list); 
    }

    protected function awayTeamInjuries()
    {
        return $this->homeTeamInjuries('away');
    }

    /**
     * STANDINGS
     */
    protected function generalHomeRanking($where = 'home')
    {
        var_dump("Dans function generalHomeRanking<br>");
        return $this->standings($where, 'rank'); 
    }

    protected function generalAwayRanking()
    {
        return $this->generalHomeRanking('away');
    }

    protected function generalHomePoints($where = 'home')
    {
        var_dump("Dans function generalHomePoints<br>");
        return $this->standings($where, 'points'); 
    }

    protected function generalAwayPoints()
    {
        return $this->generalHomePoints('away');
    }

    protected function generalHomeGoalaverage($where = 'home')
    {
        var_dump("Dans function generalHomeGoalaverage<br>");
        return sprintf("%+d", $this->standings($where, 'goalsDiff'));
    }

    protected function generalAwayGoalaverage()
    {
        return $this->generalHomeGoalaverage('away');
    }


    protected function homeTeamWdl($where = 'home')
    {
        var_dump("Dans function homeTeamWdl<br>");
        $games = $this->standings($where, $where);
        //dd(sprintf("%dV- %dN - %dD", $games->win, $games->draw, $games->lose));
        return sprintf("%dV- %dN - %dD", $games->win, $games->draw, $games->lose);
    }
    
    protected function awayTeamWdl($where = 'away')
    {
        var_dump("Dans function awayTeamWdl<br>");
        return $this->homeTeamWDL('away');

        //dd($tmp);
    }

    protected function homeTeamPoints($where = 'home')
    {
        var_dump("Dans function homeTeamPoints<br>");
        $games = $this->standings($where, $where);

        var_dump(($games->win *3 + $games->draw));
        return  ($games->win *3 + $games->draw);
    }

    protected function awayTeamPoints()
    {
        var_dump("Dans function awayTeamPoints<br>");
        return $this->homeTeamPoints('away');
    }
    

    protected function homeTeamGoalaverage($where = 'home')
    {
        var_dump("Dans function homeTeamGoalaverage<br>");
        $games = $this->standings($where, $where);

        return  sprintf("%+d", $games->goals->for - $games->goals->against);
    }

    protected function awayTeamGoalaverage()
    {
        var_dump("Dans function awayTeamGoalaverage<br>");
        return $this->homeTeamGoalaverage('away');
    }

    protected function homeTeamRanking($where = 'home')
    {
        var_dump("POSITION DU CLUB:");  
        return $this->standingsDB($where, 'rank');
    }

    protected function awayTeamRanking()
    {
        return $this->homeTeamRanking('away');
    }

    protected function homeTeamLast5($where = 'home')
    {
        var_dump("Last 5 home");
        return $this->standingsDB($where, 'last5');
    }

    protected function awayTeamLast5()
    {
        var_dump("last 5 away");
        return $this->homeTeamLast5('away');
    }


    /**
     * [center][b]Meilleurs buteurs (Dom | Ext)[/b][/center] 
     * [center][img](lien de la photo du buteur)[/img] | [img](lien de la photo du buteur)[/img][/center]
     * [center]Prénom NOM (nbre de but) | Prénom NOM (nbre de but)[/center]
     */
    protected function bestScorers()
    {
        /**
         * 1. select max
         * 2. select where home = max
         */

        $this->loadFixtures();
       
        $homeScorers = DB::table('scorers')
            ->select('max(home)', 'first_name', 'last_name', 'photo')
            ->where('club_id', '=', $this->fixtures->teams->home->id)
            ->orderBy('home', 'DESC')
            ->get('home');

        $awayScorers = DB::table('scorers')
            ->where('club_id', '=', $this->fixtures->teams->away->id)
            ->orderBy('away', 'DESC')
            ->max('away');

        var_dump($awayScorers);
        //var_dump($awayScorers);
        // home
        $data = array();
        dd($homeScorers);

        foreach($homeScorers as $scorer)
        {
            $data[$scorer->player_id] = ['goals' => $scorer->home, 'photo' => $scorer->photo];
            dd($data);
        }





    }

    

    protected function standingsDB($where, $field)
    {
        $this->loadFixtures();
       
        $data = DB::table('standings')->where([
            ['club_id', '=', $this->fixtures->teams->$where->id],
            ['location', '=', $where]
        ])->value($field);
    }


    protected function standings($where, $field)
    {
        $this->loadStandings();
        $this->loadFixtures();

        foreach($this->standings as $standing)
        {
            if($standing->team->id == $this->fixtures->teams->$where->id)
            {
                return  $standing->$field;
            }
        }
        return "-";
    }




    private function loadInjuries()
    {
        if(isset($this->injuries)){
            return;
        }

        $this->endpoint = $this->soccerDataApi->getInjuriesByFixture($this->fixtures->fixture->id);

        return $this->callServer();
    }

    private function loadStandings()
    {
        if(isset($this->standings)){
            return;
        }
        var_dump("IL N'Y A PAS DE STANDINGS");

        $this->endpoint = $this->soccerDataApi->getStandingsByLeagueAndSeason(
            $this->fixtures->league->id, 
            $this->fixtures->league->season
        );

        $tmp = $this->callServer();
        //dd($tmp[0]->league->standings);
        $this->standings = $tmp[0]->league->standings[0];
    }



    private function loadFixtures()
    {        
        if(isset($this->fixtures)){
            return;
        }

        var_dump("DANS LOAD FIXTURES");
        foreach($this->soccerDataApi->fixtures_mixed_filters as $field => $null)
        {
            if(isset($this->request->$field))
            {
                $filters[$field] = $this->request->$field;
            }
        }

        $this->endpoint = $this->soccerDataApi->getFixturesByMixedFilters($filters);
        
        $tmp = $this->callServer();
        $this->fixtures = $tmp[0];
    }


    private function callServer()
    {
        if (cache::has($this->endpoint))
        {
            return cache::get($this->endpoint);
        }

        $url = filter_var($this->soccerDataApi->baseUrl . $this->endpoint, FILTER_SANITIZE_URL);
        print "URL OK on appel l'api avec " . $url;
        $data = Http::acceptJson()
            ->withHeaders($this->soccerDataApi->getAuthKeys())
            ->get($url);
    
        $data = json_decode(json_encode($data['response']), FALSE);

        cache($this->endpoint, $data, now()->addMinutes(10));
        
        return $data;
    }

    private function getTemplate()
    {
        return Storage::get('public/template.bb');
    }

}