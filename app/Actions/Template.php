<?php

namespace App\Actions;

class Template 
{

    private $template = null;

    public function __construct()
    {
        
    }

    public function getTemplate()
    {
        return $this->template;
    }

    public function setTemplate(string $template)
    {
        $this->template = $template;
    }

    public function baseTemplate()
    {
        $this->template = "[center][b]:COMPETITION - :ROUND[/b][/center]

        [center][b](:DATE_TIME) - (:VENUE)[/b][/center] 
        
        [center][img]:HOME_TEAM_LOGO[/img] | [img]:AWAY_TEAM_LOGO[/img][/center]
        
        [center][b](Classement)[/b] | [b](Classement)[/b][/center] 
        [center][b]xx pts[/b] | [b]xx pts[/b][/center] (nbre points)
        [center][b]+/-xx[/b] | [b]+/-xx[/b][/center] (différence de buts)
        
        
        [center](Présentation du match, si vous le souhaitez)[/center]";
    }


}