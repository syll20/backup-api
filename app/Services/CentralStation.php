<?php

namespace App\Services;

use App\Contracts\SoccerDataApiInterface;
use App\Exceptions\GameDateException;
use App\Http\Controllers\FixtureController;
use App\Http\Requests\StoreFixtureRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use IntlDateFormatter;
use App\Models\Scorer;
use ErrorException;
use Exception;
use Illuminate\Support\Facades\Redirect;

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
    protected $template = null;
    protected $templateScorer = null;

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
        if($this->loadFixtures() === null)
        {
            return null;
        }

        $this->template = $this->getTemplate();

        foreach($this->placeholders as $placeholder)
        {
            $functionName = Str::camel($placeholder);

            if (method_exists($this, $functionName)) {
                $this->template = str_replace("%".$placeholder, $this->$functionName(), $this->template);
            }
        }
        return $this->template;
    }


    /**
     * COMPETITION
     */
    protected function competition()
    {
        //$this->loadFixtures();

        return $this->fixtures->league->name;
    }

    protected function round()
    {
        $this->loadFixtures();

        $tmp = explode('-', $this->fixtures->league->round);
        return trim($tmp[1]) . "e journée";
    }

    /**
     * DATE
     */
    protected function dateTime()
    {
        //$this->loadFixtures();

        return (new IntlDateFormatter(
            "fr_FR" ,
            IntlDateFormatter::FULL, 
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
        //$this->loadFixtures();
        return $this->fixtures->fixture->venue->name;
    }

    /**
     * TEAMS LOGOS
     */
    protected function homeTeamLogo($where = 'home')
    {
        //$this->loadFixtures();
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
        //$this->loadFixtures();
        return $this->fixtures->fixture->referee;
    }

    /**
     * SIDELINED
     */
    protected function homeTeamInjuries($where = 'home')
    {
        $this->loadInjuries();
        //$this->loadFixtures();

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
        //return $this->injuries->teamInjuries('home');
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
        return $this->standings($where, 'rank'); 
    }

    protected function generalAwayRanking()
    {
        return $this->generalHomeRanking('away');
    }

    protected function generalHomePoints($where = 'home')
    {
        return $this->standings($where, 'points'); 
    }

    protected function generalAwayPoints()
    {
        return $this->generalHomePoints('away');
    }

    protected function generalHomeGoalaverage($where = 'home')
    {
        return sprintf("%+d", $this->standings($where, 'goalsDiff'));
    }

    protected function generalAwayGoalaverage()
    {
        return $this->generalHomeGoalaverage('away');
    }

    protected function homeTeamWdl($where = 'home')
    {
        $games = $this->standings($where, $where);

        return sprintf("%dV- %dN - %dD", $games->win, $games->draw, $games->lose);
    }
    
    protected function awayTeamWdl($where = 'away')
    {
        return $this->homeTeamWDL('away');
    }

    protected function homeTeamPoints($where = 'home')
    {
        $games = $this->standings($where, $where);

        return  ($games->win *3 + $games->draw);
    }

    protected function awayTeamPoints()
    {
        return $this->homeTeamPoints('away');
    }
    

    protected function homeTeamGoalaverage($where = 'home')
    {
        $games = $this->standings($where, $where);

        return  sprintf("%+d", $games->goals->for - $games->goals->against);
    }

    protected function awayTeamGoalaverage()
    {
        return $this->homeTeamGoalaverage('away');
    }

    protected function homeTeamRanking($where = 'home')
    {
        return $this->standingsDB($where, 'rank');
    }

    protected function awayTeamRanking()
    {
        return $this->homeTeamRanking('away');
    }

    protected function homeTeamLast5($where = 'home')
    {
        return $this->standingsDB($where, 'last5');
    }

    protected function awayTeamLast5()
    {
        return $this->homeTeamLast5('away');
    }


    /**
     * 
     * %home_photo_scorer | %away_photo_scorer
     * %home_name_scorer (%home_goal_scorer) | %away_name_scorer (%away_goal_scorer)
     */
    protected function bestScorers()
    {
        //$this->loadFixtures();
        $this->getTemplateScorer();

        $this->setTemplateScorer(Scorer::best('home', $this->fixtures), 'home');
        $this->setTemplateScorer(Scorer::best('away', $this->fixtures), 'away');

        return $this->templateScorer;
    }

    protected function setTemplateScorer($scorers, $location)
    {
        $photos = [];
        $names = [];
        $goals = "";

        foreach($scorers as $scorer)
        {
            $photos[] = "[img]".$scorer->photo."[/img]";
            $names[] =  $scorer->first_name . " " . strtoupper($scorer->last_name);
            $goals = $scorer->$location;
        }

        $this->templateScorer = str_replace("%{$location}_photo_scorer", implode(' ', $photos), $this->templateScorer);
        $this->templateScorer = str_replace("%{$location}_name_scorer", implode(', ', $names), $this->templateScorer);
        $this->templateScorer = str_replace("%{$location}_goal_scorer", $goals, $this->templateScorer);
    }
    

    protected function standingsDB($where, $field)
    {
        //$this->loadFixtures();
       
        return $data = DB::table('standings')->where([
            ['club_id', '=', $this->fixtures->teams->$where->id],
            ['location', '=', $where]
        ])->value($field);
    }


    protected function standings($where, $field)
    {
        $this->loadStandings();
        //$this->loadFixtures();

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

        $this->injuries = $this->callServer();
    }

    private function loadStandings()
    {
        if(isset($this->standings)){
            return;
        }

        $this->endpoint = $this->soccerDataApi->getStandingsByLeagueAndSeason(
            $this->fixtures->league->id, 
            $this->fixtures->league->season
        );

        $tmp = $this->callServer();

        $this->standings = $tmp[0]->league->standings[0];
    }


    
    private function loadFixtures()
    {        
        if(isset($this->fixtures)){
            return;
        }

        foreach($this->soccerDataApi->fixtures_mixed_filters as $field => $null)
        {
            if(isset($this->request->$field))
            {
                $filters[$field] = $this->request->$field;
            }
        }

        $this->endpoint = $this->soccerDataApi->getFixturesByMixedFilters($filters);
        
        $tmp = $this->callServer();

        try{
            $this->fixtures = $tmp[0];
        }catch(ErrorException $e){
            return null;
        }

        return true;
    }


    private function callServer()
    {
        if (cache::has($this->endpoint))
        {
            return cache::get($this->endpoint);
        }

        $url = filter_var($this->soccerDataApi->baseUrl . $this->endpoint, FILTER_SANITIZE_URL);

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

    private function getTemplateScorer()
    {
        $this->templateScorer = " 
            %home_photo_scorer | %away_photo_scorer
            %home_name_scorer (%home_goal_scorer) | %away_name_scorer (%away_goal_scorer)";
    }

}