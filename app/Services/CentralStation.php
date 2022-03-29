<?php

namespace App\Services;

use App\Contracts\SoccerDataApiInterface;
use App\Http\Requests\StoreFixtureRequest;
use App\Models\Head2head;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use IntlDateFormatter;
use App\Models\Scorer;
use ErrorException;
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
        return $this->fixtures->fixture->venue->name;
    }

    /**
     * TEAMS LOGOS
     */
    protected function homeTeamLogo($where = 'home')
    {
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
        return $this->fixtures->fixture->referee;
    }

    /**
     * SIDELINED
     */
    protected function homeTeamInjuries($where = 'home')
    {
        $this->loadInjuries();

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

    protected function statsH2h()
    {
        $template = "";
        $templateStats = $this->getTemplateStatsH2h();
        $location = $this->fixtures->teams->home->id == 94 ? 'away' : 'home';
        
        $games = Head2head::byLocation($this->fixtures->teams->$location->id, $location);

        $home = 0;
        $draw = 0;
        $away = 0;

        foreach($games as $game)
        {         
            if($game->home_goals > $game->away_goals){
                ++$home;
            }else if($game->home_goals < $game->away_goals){
                ++$away;
            }else{
                ++$draw;
            }
        }

        return str_replace(
            [
                '%stats_home_win',
                '%stats_draw', 
                '%stats_away_win'
            ], 
            [   
                $home,
                $draw,
                $away
            ], 
            $templateStats);
    }

    protected function last5Games()
    {
        $template = "";
        $last5 = $this->getTemplateLast5Games();
        $location = $this->fixtures->teams->home->id == 94 ? 'away' : 'home';
        
        $games = Head2head::byLocation($this->fixtures->teams->$location->id, $location, 5);

        foreach($games as $game)
        {         
            /**
             * Home team vs Away team
             */
            if($game->location == 'home'){
                $homeTeam = $game->name;
                $awayTeam = 'Rennes';
            }else{
                $homeTeam = 'Rennes';
                $awayTeam = $game->name;
            }

            /**
             * Result: home goals - away goals
             */
            $win = null;

            if($game->home_goals > $game->away_goals)
            {
                $win = 'home';
            }else if($game->away_goals > $game->home_goals)
            {
                $win = 'away';
            }

            if(! $win)
            {
                $color = '807F7F';
            }else 

            if( ($homeTeam == 'Rennes' & $win == 'home') 
                || ($awayTeam == 'Rennes' & $win == 'away') )
            {
                $color = '0050fe';
            }else{
                $color = 'FE0500';
            }

            $template .= str_replace(
                [
                    '%color',
                    '%date_game', 
                    '%home_team', 
                    '%result', 
                    '%away_team', 
                    '%competition'
                ], 
                [   
                    $color,
                    date_format(date_create($game->played_at), 'd-m-Y'),
                    $homeTeam,
                    $game->home_goals . ' - ' . $game->away_goals,
                    $awayTeam,
                    $game->competition
                ], 
                $last5);
        }

        return $template;
    }

    protected function tv()
    {
        $dateTime = $this->dateTime();

        if( Str::containsAll($dateTime, ['Samedi', '21'])
            || Str::containsAll($dateTime, ['Dimanche', '17']) )
        {
            return 'https://www.ligue1.fr/-/media/Project/LFP/shared/Images/Broadcasters/Canal_Sport.png';
        }
        else
        {
            return 'https://www.ligue1.fr/-/media/Project/LFP/shared/Images/Broadcasters/Prime_Video.png';
        }
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
        $this->templateScorer = Storage::get('public/template-scorers.bb');
    }

    private function getTemplateLast5Games()
    {
        return Storage::get('public/template-last-5-games.bb');
    }

    private function getTemplateStatsH2h()
    {
        return Storage::get('public/template-stats-h2h.bb');
    }

}