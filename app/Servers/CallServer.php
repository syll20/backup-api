<?php

namespace App\Servers;

use App\Contracts\SoccerDataApiInterface;
use Illuminate\Support\Facades\Http;

class CallServer
{
    public function handle(string $endpoint, SoccerDataApiInterface $soccerDataApi)
    {
        $url = filter_var($soccerDataApi->baseUrl . $endpoint, FILTER_SANITIZE_URL);

        $data = Http::acceptJson()
            ->withHeaders($soccerDataApi->getAuthKeys())
            ->get($url);
   
        $data = json_decode(json_encode($data['response']), FALSE);

        return $data;
    }
}
