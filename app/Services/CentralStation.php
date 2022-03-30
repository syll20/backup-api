<?php

namespace App\Services;

use App\Contracts\SoccerDataApiInterface;
use App\Facades\Fixture;
use App\Facades\H2h;
use App\Facades\Injury;
use App\Facades\Ranking;
use App\Facades\Scorer;
use App\Http\Requests\StoreFixtureRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CentralStation
{
    protected $placeholders = null;
    protected $fixtures = null;
    protected $template = null;
 
    public function __construct(StoreFixtureRequest $request, SoccerDataApiInterface $soccerDataApi)
    {
        $this->request = $request;
        $this->request['season'] = $soccerDataApi->season;
        $this->placeholders = $request['placeholders'];
        $this->soccerDataApi = $soccerDataApi;
    }

    public function handle()
    {
        if( ($this->fixtures = Fixture::loadFixtures($this->request, $this->soccerDataApi)) === null){
            return null;
        }

        Ranking::loadStandings($this->fixtures, $this->soccerDataApi);
        Injury::loadInjuries($this->fixtures, $this->soccerDataApi);

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


    /****************************************************************************************************
     * 
     * CALL PLACEHOLDERS FUNCTIONS
     * 
     */

    protected function competition()
    {
        return Fixture::competition(); 
    }

    protected function round()
    {
       return Fixture::round();
    }

    protected function dateTime()
    {
        return Fixture::dateTime();
    }

    protected function venue()
    {
        return Fixture::venue();
    }

    protected function homeTeamLogo()
    {
        return Fixture::teamLogo('home'); 
    }

    protected function awayTeamLogo()
    {
        return Fixture::teamLogo('away');
    }

    protected function mainReferee()
    {
        return Fixture::mainReferee();
    }

    protected function tv()
    {
        return Fixture::tv();
    }

    protected function homeTeamInjuries()
    {
        return Injury::teamInjuries('home');
    }

    protected function awayTeamInjuries()
    {
        return Injury::teamInjuries('away');
    }

    protected function bestScorers()
    {
        return Scorer::bestScorers($this->fixtures);
    }

    protected function statsH2h()
    {
        return H2h::stats($this->fixtures);
    }

    protected function last5Games()
    {
        return H2h::last5Games($this->fixtures);
    }

    protected function generalHomeRanking()
    {
        return Ranking::standings('home', 'rank'); 
    }

    protected function generalAwayRanking()
    {
        return Ranking::standings('away', 'rank');
    }

    protected function generalHomePoints()
    {
        return Ranking::standings('home', 'points'); 
    }

    protected function generalAwayPoints()
    {
        return Ranking::standings('away', 'points');
    }

    protected function generalHomeGoalaverage()
    {
        return Ranking::generalGoalAverage('home');
    }

    protected function generalAwayGoalaverage()
    {
        return Ranking::generalGoalAverage('away');
    }

    protected function homeTeamWdl()
    {
        return Ranking::teamWdl('home');
    }
    
    protected function awayTeamWdl()
    {
        return Ranking::teamWdl('away');
    }

    protected function homeTeamPoints()
    {
        return Ranking::teamPoints('home');
    }

    protected function awayTeamPoints()
    {
        return Ranking::teamPoints('away');
    }
    
    protected function homeTeamGoalaverage()
    {
        return Ranking::teamGoalaverage('home');
    }

    protected function awayTeamGoalaverage()
    {
        return Ranking::teamGoalaverage('away');
    }

    protected function homeTeamRanking()
    {
        return Ranking::teamRanking('home');
    }

    protected function awayTeamRanking()
    {
        return Ranking::teamRanking('away');
    }

    protected function homeTeamLast5()
    {
        return Ranking::teamLast5('home');
    }

    protected function awayTeamLast5()
    {
        return Ranking::teamLast5('away');
    }

    private function getTemplate()
    {
        return Storage::get('public/template.bb');
    }
}