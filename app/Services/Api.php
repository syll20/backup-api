<?php
/*
namespace App\Services;

use App\Actions\Fixtures;
use App\Actions\Standings;
use App\Contracts\SoccerDataApiInterface;
use Illuminate\Support\Facades\Http;

class Api 
{
    protected $api = null;
    protected ?string $action = null;
    protected ?array $actions_list = null;

    public function __construct(
        SoccerDataApiInterface $api,
        Fixtures $fixtures,
        Standings $standings
        )
    {
        $this->api = $api;
        $this->actions = [
            'fixtures' => $fixtures,
            'standings' => $standings
        ];
    }

    private function execute()
    {
        if(isset($this->actions[$this->action]))
        {
            return $this->call($this->actions[$this->action]->handle($this->api));
        }
    }

    private function call($url)
    {
        return Http::acceptJson()->withHeaders([
            $this->auth['key_name'] => $this->auth['key_value']
        ])->get($url)->json();
    }

    public function fixtures(){
        
        $this->action = "fixtures";
        $json = $this->execute();
    }

    public function standings(){
        
        $this->action = "standings";
        $json = $this->execute();
    }


}*/
