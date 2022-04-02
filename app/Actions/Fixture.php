<?php

namespace App\Actions;

use App\Facades\CallServer;
use ErrorException;
use IntlDateFormatter;
use Illuminate\Support\Str;

class Fixture
{
    protected $fixtures = null;


    public function loadFixtures($request, $soccerDataApi)
    {        
        if($this->fixtures !== null){
            return $this->fixtures;
        }

        foreach($soccerDataApi->fixtures_mixed_filters as $field => $null)
        {
            if(isset($request->$field))
            {
                $filters[$field] = $request->$field;
            }
        }

        $endpoint = $soccerDataApi->getFixturesByMixedFilters($filters);

        $tmp = CallServer::handle($endpoint, $soccerDataApi);

        try{
            $this->fixtures = $tmp[0];
        }catch(ErrorException $e){
            return null;
        }

        return $this->fixtures;
    }



    public function competition()
    {
        return $this->fixtures->league->name;
    }

    public function round()
    {
        $tmp = explode('-', $this->fixtures->league->round);
        return trim($tmp[1]) . "e journée";
    }

    public function dateTime()
    {
        return (new IntlDateFormatter(
            "fr_FR" ,
            IntlDateFormatter::FULL, 
            IntlDateFormatter::SHORT, 
            'Europe/Paris',
            IntlDateFormatter::GREGORIAN
        ))->format($this->fixtures->fixture->timestamp);
    }

    public function venue()
    {
        return $this->fixtures->fixture->venue->name;
    }

    public function teamLogo($location = 'home')
    {
        return $this->fixtures->teams->$location->logo;
    }

    public function mainReferee()
    {
        return $this->fixtures->fixture->referee;
    }

    public function tv()
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

}