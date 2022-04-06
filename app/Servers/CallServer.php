<?php

namespace App\Servers;

use App\Contracts\SoccerDataApiInterface;
use ErrorException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class CallServer
{
    public function handle(string $endpoint, SoccerDataApiInterface $soccerDataApi)
    {
        $url = filter_var($soccerDataApi->baseUrl . $endpoint, FILTER_SANITIZE_URL);

        $data = Http::acceptJson()
            ->withHeaders($soccerDataApi->getAuthKeys())
            ->get($url);

        try{
            $data = json_decode(json_encode($data['response']), FALSE);
        } catch (ErrorException $e) {
            $today = date('Y-m-d');
            Storage::append('logs/'.$today, $url);
            Storage::append('logs/'.$today, dump($data));
            Storage::append('logs/'.$today, dump($e));
            dd("something went wrong, please try again later ($today)");
        }
        return $data;
    }
}
