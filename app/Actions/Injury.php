<?php

namespace App\Actions;

use App\Facades\CallServer;

class Injury
{
    protected $fixtures;
    protected $injuries;

    
    public function teamInjuries($location)
    {
        if(!isset($this->injuries)){
            return "";
        }

        $list = [];

        foreach($this->injuries as $injurie)
        {
            if($injurie->team->id == $this->fixtures->teams->$location->id)
            {
                $list[] = $injurie->player->name;
            }
         }
        return implode(", ", $list); 
    }


    public function loadInjuries($fixtures, $soccerDataApi)
    {
        if(isset($this->injuries)){
            return;
        }

        if(! isset($this->fixtures)){
            $this->fixtures = $fixtures;
        }

        $endpoint = $soccerDataApi->getInjuriesByFixture($this->fixtures->fixture->id);

        $this->injuries =  CallServer::handle($endpoint, $soccerDataApi);
    }

}