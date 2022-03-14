<?php

namespace App\Actions;

use App\Contracts\SoccerDataApiInterface;

class ApiCall 
{

    protected $api = null;
/*
    public function __construct(SoccerDataApiInterface $api)
    {
        $this->api = $api;
    }
*/
    public function execute(SoccerDataApiInterface $api){

      
       /**
        *           COMMUN
        */
        $url = $api->base_url . $endpoint;

        // Remove all illegal characters from a url
        $url = filter_var($url, FILTER_SANITIZE_URL);

        // Validate url
        if (filter_var($url, FILTER_VALIDATE_URL) !== false) {
            print "URL OK on appel l'api avec " . $url;
            $data_array = Http::acceptJson()->withHeaders($api->getAuthKeys())->get($url);
        }
        $data = json_decode(json_encode($data_array['response'][0]), FALSE);
        
    }
}