<?php

namespace App\Actions;

use App\Contracts\SoccerDataApiInterface;
use App\Services\CentralStation;

class Injuries 
{

    protected $fixtures;

    public function __construct(Fixtures $fixtures, CentralStation $centralStation)
    {
        $this->fixtures = $fixtures;
        $this->CentralStation = $centralStation;
    }
    
     /**
     * SIDELINED
     */
    public function teamInjuries($where = 'home')
    {
        $this->loadInjuries();
        $this->fixtures->loadFixtures();

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


    protected function loadInjuries()
    {
        if(isset($this->injuries)){
            return;
        }

        $this->endpoint = $this->soccerDataApi->getInjuriesByFixture($this->fixtures->fixture->id);

        $this->injuries = $this->CentralStation->callServer();
    }



}