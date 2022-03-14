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

        /*if(! isset($this->fixtures))
        {
            var_dump("IL N'Y A PAS DE FIXTURE");
            $this->fixtures = $this->loadFixtures();
        }*/
        $this->loadFixtures();
        //dd($this->fixtures);
        return $this->fixtures->league->name;
    }

    private function round()
    {
        var_dump("Dans function round<br>");

        /*if(! isset($this->fixtures))
        {
            var_dump("IL N'Y A PAS DE FIXTURE");
           $this->fixtures = $this->loadFixtures();
        }*/
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

        /*if(! isset($this->fixtures))
        {
            var_dump("IL N'Y A PAS DE FIXTURE");
           $this->fixtures = $this->loadFixtures();
        }*/
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

        /*if(! isset($this->fixtures))
        {
            var_dump("IL N'Y A PAS DE FIXTURE");
            $this->fixtures = $this->loadFixtures();
        }*/
        $this->loadFixtures();
        //dd($this->fixtures->league->name);
        return $this->fixtures->fixture->venue->name;
    }

    /**
     * TEAMS LOGOS
     */
    private function homeTeamLogo($where = 'home')
    {
        /*if(! isset($this->fixtures))
        {
            $this->fixtures = $this->loadFixtures();
        }*/
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

        /*if(! isset($this->fixtures))
        {
            var_dump("IL N'Y A PAS DE FIXTURE");
            $this->fixtures = $this->loadFixtures();
        }*/

        $this->loadFixtures();

        //dd($this->fixtures->league->name);
        return $this->fixtures->fixture->referee;
    }

    /**
     * SIDELINED
     */
    private function homeTeamInjuries($where = 'home')
    {
        var_dump("Dans function homeTeamInjuries<br>");

        if(! isset($this->injuries))
        {
            var_dump("IL N'Y A PAS DE INJURIES");
            $this->injuries = $this->loadInjuries();
        }
        if(! isset($this->fixtures))
        {
            var_dump("IL N'Y A PAS DE FIXTURE");
            $this->fixtures = $this->loadFixtures();
        }

        $tmp = [];

        foreach($this->injuries as $injurie)
        {
            if($injurie->team->id == $this->fixtures->teams->$where->id)
            {
                $tmp[] = $injurie->player->name;
            }
         }
        return implode(", ", $tmp); 
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

        if(! isset($this->standings))
        {
            var_dump("IL N'Y A PAS DE STANDINGS");
            $this->standings = $this->loadStandings();
        }
        if(! isset($this->fixtures))
        {
            var_dump("IL N'Y A PAS DE FIXTURE");
            $this->fixtures = $this->loadFixtures();
        }

        foreach($this->standings as $key => $standing)
        {
            dd($standing['team']->name);
            if($standing[$key]['team']->id == $this->fixtures->teams->$where->id)
            {
                return  $standing[$key]->rank;
            }
        }
        //dd($this->fixtures->league->name);
        //return $this->standinggs->fixture->referee;
        return "?";
    } 


    private function generalAwayRanking()
    {
        return $this->generalHomeRanking('away');
    } 




    private function loadInjuries()
    {
        $this->endpoint = $this->soccerDataApi->getInjuriesByFixture($this->fixtures->fixture->id);

        return $this->callServer();
    }

    private function loadStandings()
    {
        $this->endpoint = $this->soccerDataApi->getStandingsByLeagueAndSeason(
            $this->fixtures->league->id, 
            $this->fixtures->league->season
        );

        $tmp = $this->callServer();
        //dd($tmp[0]->league->standings);
        return $tmp[0]->league->standings;
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