<?php

namespace App\Services;


use App\Contracts\SoccerDataApiInterface;
use App\Http\Requests\StoreFixtureRequest;
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
                $this->template = str_replace("%".$placeholder, $this->$functionName(), $this->template);
            }
        }

        dd($this->template);
    }


    /**
     * COMPETITION
     */
    private function competition()
    {
        var_dump("Dans function competition<br>");
        $this->loadFixtures();
        //dd($this->fixtures);

        return $this->fixtures->league->name;
    }

    private function round()
    {
        var_dump("Dans function round<br>");
        $this->loadFixtures();

        $tmp = explode('-', $this->fixtures->league->round);
        return trim($tmp[1]) . "e journée";
    }

    /**
     * DATE
     */
    private function dateTime()
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
    private function venue()
    {
        var_dump("Dans function venue<br>");
        $this->loadFixtures();
        return $this->fixtures->fixture->venue->name;
    }

    /**
     * TEAMS LOGOS
     */
    private function homeTeamLogo($where = 'home')
    {
        $this->loadFixtures();
        return $this->fixtures->teams->$where->logo;
    }

    private function awayTeamLogo()
    {
        return $this->homeTeamLogo('away');
    }

    /**
     * REFEREES
     */
    private function referee()
    {
        var_dump("Dans function referee<br>");
        $this->loadFixtures();
        return $this->fixtures->fixture->referee;
    }

    /**
     * SIDELINED
     */
    private function homeTeamInjuries($where = 'home')
    {
        var_dump("Dans function homeTeamInjuries<br>");

        $this->loadInjuries();
        $this->loadFixtures();

        $list = [];

        foreach($this->injuries as $injurie)
        {
            if($injurie->team->id == $this->fixtures->teams->$where->id)
            {
                $list[] = $injurie->player->name;
            }
         }
        return implode(", ", $list); 
    }

    private function awayTeamInjuries()
    {
        return $this->homeTeamInjuries('away');
    }

    /**
     * STANDINGS
     */
    private function generalHomeRanking($where = 'home')
    {
        var_dump("Dans function generalHomeRanking<br>");
        return $this->standings($where, 'rank'); 
    }

    private function generalAwayRanking()
    {
        return $this->generalHomeRanking('away');
    }

    private function generalHomePoints($where = 'home')
    {
        var_dump("Dans function generalHomePoints<br>");
        return $this->standings($where, 'points'); 
    }

    private function generalAwayPoints()
    {
        return $this->generalHomePoints('away');
    }

    private function generalHomeGoalaverage($where = 'home')
    {
        var_dump("Dans function generalHomeGoalaverage<br>");
        return sprintf("%+d", $this->standings($where, 'goalsDiff'));
    }

    private function generalAwayGoalaverage()
    {
        return $this->generalHomeGoalaverage('away');
    }


    private function homeTeamRanking($where = 'home')
    {
        //$tmp = $this->standings($where, $where);
        // return $tmp['']

        /**
         * Boucle sur $this->standings
         * 
         *      Enregistre pour chaque équipe le classement
         *          
         *          À domicile
         *          À l'extérieur
         * 
         *                      Win
         *                      Draw
         *                      Lose
         *                      Goals
         *                          For
         *                          Against
         * 
         *  Puis trier
         * Et déterminer le classement de team_home + team_away
         * 
         *          Peut-être besoin d'un loadAllStandings()
         *          Avec:
         *              https://v3.football.api-sports.io/standings?season=2021&league=61
         */
    }

    private function awayTeamRanking()
    {
        return $this->awayTeamRanking('away');
    }

    private function standings($where, $field)
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
        $url = filter_var($this->soccerDataApi->base_url . $this->endpoint, FILTER_SANITIZE_URL);

        if (filter_var($url, FILTER_VALIDATE_URL) !== false) {
            print "URL OK on appel l'api avec " . $url;
            $data = Http::acceptJson()
                ->withHeaders($this->soccerDataApi->getAuthKeys())
                ->get($url);
        }
        $data = json_decode(json_encode($data['response']), FALSE);

        return $data;
    }

    private function getTemplate()
    {
        return Storage::get('public/template.bb');
    }

}