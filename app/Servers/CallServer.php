<?php

namespace App\Servers;

use App\Contracts\SoccerDataApiInterface;
use Illuminate\Support\Facades\Http;

/**
 * Setup the query for api-football.com API
 */
class CallServer
{

    public function __construct(SoccerDataApiInterface $soccerDataApi)
    {
        $this->soccerDataApi = $soccerDataApi;
    }

    public function handle(string $endpoint)
    {
        $url = filter_var($this->soccerDataApi->baseUrl . $endpoint, FILTER_SANITIZE_URL);

        $data = Http::acceptJson()
            ->withHeaders($this->soccerDataApi->getAuthKeys())
            ->get($url);
   
        $data = json_decode(json_encode($data['response']), FALSE);

        return $data;
    }
}