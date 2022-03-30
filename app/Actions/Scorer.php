<?php

namespace App\Actions;

use App\Models\Scorer as ModelsScorer;
use Illuminate\Support\Facades\Storage;

class Scorer
{
    protected $templateScorer;

    public function bestScorers($fixtures)
    {
        $this->getTemplateScorer();

        $this->setTemplateScorer(ModelsScorer::best('home', $fixtures), 'home');
        $this->setTemplateScorer(ModelsScorer::best('away', $fixtures), 'away');

        return $this->templateScorer;
    }

    public function setTemplateScorer($scorers, $location)
    {
        $photos = [];
        $names = [];
        $goals = "";

        foreach($scorers as $scorer)
        {
            $photos[] = "[img]".$scorer->photo."[/img]";
            $names[] =  $scorer->first_name . " " . strtoupper($scorer->last_name);
            $goals = $scorer->$location;
        }

        $this->templateScorer = str_replace(
            [
                "%{$location}_photo_scorer",
                "%{$location}_name_scorer",
                "%{$location}_goal_scorer"
            ],
            [
                implode(' ', $photos),
                implode(', ', $names),
                $goals
            ],
            $this->templateScorer
        );

    }

    private function getTemplateScorer()
    {
        $this->templateScorer = Storage::get('public/template-scorers.bb');
    }

}