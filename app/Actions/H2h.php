<?php

namespace App\Actions;

use App\Models\Head2head;
use Illuminate\Support\Facades\Storage;

class H2h
{
    protected $fixtures;

    protected function getLocation($fixtures)
    {
        return $fixtures->teams->home->id == 94 ? 'away' : 'home';
    }

    public function stats($fixtures)
    {
        $templateStats = $this->getTemplateStats();
        $location = $this->getLocation($fixtures);
        
        $games = Head2head::byLocation($fixtures->teams->$location->id, $location);

        $home = $draw = $away = 0;

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
            [ '%stats_home_win', '%stats_draw', '%stats_away_win' ], 
            [  $home, $draw, $away ], 
            $templateStats
        );
    }

    public function last5Games($fixtures)
    {
        $template = "";
        $last5 = $this->getTemplateLast5Games();
        //$location = $fixtures->teams->home->id == 94 ? 'away' : 'home';
        $location = $this->getLocation($fixtures);

        $games = Head2head::byLocation($fixtures->teams->$location->id, $location, 5);

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
             * Result: who wons^
             */
            $win = null;

            if($game->home_goals > $game->away_goals)
            {
                $win = 'home';
            }else if($game->away_goals > $game->home_goals)
            {
                $win = 'away';
            }

            /**
             * set color 
             */
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
                $last5
            );
        }

        return $template;
    }

    private function getTemplateStats()
    {
        return Storage::get('public/template-stats-h2h.bb');
    }

    private function getTemplateLast5Games()
    {
        return Storage::get('public/template-last-5-games.bb');
    }
}