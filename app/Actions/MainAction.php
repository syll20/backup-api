<?php

namespace App\Actions;

use App\Contracts\SoccerDataApiInterface;
use App\Http\Requests\StoreFixtureRequest;
use App\Services\Api;

class MainAction 
{

    protected $api = null;
    public $template = null;

    public function __construct(
        SoccerDataApiInterface $api, 
        StoreFixtureRequest $request,
        Api $service,
        Fixtures $fixtures,
        Standings $standings
    )
    {
        $this->api = $api;
        $this->request = $request;
        $this->service = $service;
        $this->actions = [
            'fixtures' => $fixtures,
            'standings' => $standings
        ];

        //$this->template = $this->baseTemplate();
    }
    /*
    public function handle(string $what)
    {
        if(isset($this->actions[$what]))
        {
            $this->actions[$what]->handle($this->api);
        }
    }
    */

    public function handle()
    {
        
        $template = $this->fixtures->handle($this->api);

        //$this->actions['injuries']->handle($this->api);
        
        //$this->actions['fixtures.last11']->handle($this->api);
        //$this->actions['standings']->handle($this->api);
        //$this->actions['squad']->handle($this->api);
        //$this->actions['h2h']->handle($this->api);
    }

}