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

    public function handle(SoccerDataApiInterface $api)
    {
        

        

        /**
         *          FIN COMMUN
         */
    
        // SESSION ?
        $fixture_id = $data->fixture->id;
        $home_id = $data->teams->home->id;
        $away_id = $data->teams->away->id;
        
        $template = $this->template->getTemplate();
        $template = str_replace([
            ':COMPETITION',
            ':ROUND',
            ':DATE_TIME',
            ':VENUE',
            ':HOME_TEAM_LOGO',
            ':AWAY_TEAM_LOGO',
            ':REFEREE'],
            [
            $data->league->name,
            $this->round($data->league->round),
            $this->datetime($data->fixture->timestamp),
            $data->fixture->venue->name,
            $data->teams->home->logo,
            $data->teams->away->logo,
            $data->fixture->referee],

            $template
        );

        dd($template);

        $this->template->setTemplate($template);
    }


    private function round($value)
    {
        $x = explode('-', $value);
        return trim($x[1]) . "e journée";
    }

    private function datetime($value)
    {
        return (new IntlDateFormatter(
            "fr_FR" ,
            IntlDateFormatter::LONG, 
            IntlDateFormatter::SHORT, 
            'Europe/Paris',
            IntlDateFormatter::GREGORIAN
        ))->format($value);
    }

    private function endpoint()
    {
        return $api->getFixturesByMixedFilters([
            'team' => 94,
            'season' => 2021,
            'date' => $this->request['game_date']
        ]);
    }

}