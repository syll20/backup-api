<?php

namespace App\Actions;

use App\Contracts\SoccerDataApiInterface;
use App\Http\Requests\StoreFixtureRequest;
use Illuminate\Support\Facades\Http;
use IntlDateFormatter;

class Fixtures extends ApiCall
{

    protected $request = null;
    protected $template = null;

    public function __construct(Template $template, StoreFixtureRequest $request)
    {
        $this->template = $template;
        $this->request = $request;
    }

    public function loadFixtures()
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
        $this->fixtures = $tmp[0];
    }
}