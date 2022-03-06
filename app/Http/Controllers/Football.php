<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Dflydev\DotAccessData\Util;
use Illuminate\Support\Facades\Http;

use App\Contracts\SoccerDataApi;
use App\SoccerApi\ApiFootball;
use GuzzleHttp\Utils;

class Football extends Controller
{
   
    public function getFixture()
    {

       $league_id = array(1, 4, 17, 28);
       print_r($league_id);
       $p = implode('-', $league_id);


        print http_build_query([
                    "live" => implode('-', $league_id)
                ])
            ;
   
       exit;

/*
        $json = Http::
            withHeaders([
                'x-apisports-key' => 'fdf1ff3c4f0ddfa001f0e3b223c9ce80'
            ])->get('https://v3.football.api-sports.io/fixtures?league=61&season=2021&team=94&next=1');

        print Utils::jsonDecode($json->body());
*/

        //$test = new SoccerDataApi(api_key: 1234);
        //$test->getLeaguesByTeamId(94);


        $json = '{"get":"fixtures","parameters":{"league":"61","season":"2021","team":"94","next":"1"},
        "errors": [],
        "results": 1,
        "paging": {
            "current": 1,
            "total": 1
        },
        "response": [
            {
                "fixture": {
                    "id": 718619,
                    "referee": "B. Millot",
                    "timezone": "UTC",
                    "date": "2022-03-06T14: 00: 00+00: 00",
                    "timestamp": 1646575200,
                    "periods": {
                        "first": null,
                        "second": null
                    },
                    "venue": {
                        "id": 680,
                        "name": "Roazhon Park",
                        "city": "Rennes"
                    },
                    "status": {
                        "long": "Not Started",
                        "short": "NS",
                        "elapsed": null
                    }
                },
                "league": {
                    "id": 61,
                    "name": "Ligue 1",
                    "country": "France",
                    "logo": "https:\/\/media.api-sports.io\/football\/leagues\/61.png",
                    "flag": "https:\/\/media.api-sports.io\/flags\/fr.svg",
                    "season": 2021,
                    "round": "Regular Season - 27"
                },
                "teams": {
                    "home": {
                        "id": 94,
                        "name": "Rennes",
                        "logo": "https:\/\/media.api-sports.io\/football\/teams\/94.png",
                        "winner": null
                    },
                    "away": {
                        "id": 77,
                        "name": "Angers",
                        "logo": "https:\/\/media.api-sports.io\/football\/teams\/77.png",
                        "winner": null
                    }
                },
                "goals": {
                    "home": null,
                    "away": null
                },
                "score": {
                    "halftime": {
                        "home": null,
                        "away": null
                    },
                    "fulltime": {
                        "home": null,
                        "away": null
                    },
                    "extratime": {
                        "home": null,
                        "away": null
                    },
                    "penalty": {
                        "home": null,
                        "away": null
                    }
                }
            }
        ]
        }';

        print "<br><br><br>";
        $decode = json_decode($json);
        print_r($decode);
        print "<br><br><br>";
        print_r($decode->response[0]->teams->home->name);
      


    }



/*
    $client = new http\Client;
    $request = new Http\Client\Request;

    $request->setRequestUrl('https://v3.football.api-sports.io/fixtures/league=61&season=2021');
    $request->setRequestMethod('GET');
    $request->setQuery(new Http\QueryString(array(
        'live' => 'all'
    )));

    $request->setHeaders(array(
        'x-rapidapi-host' => 'v3.football.api-sports.io',
        'x-rapidapi-key' => 'XxXxXxXxXxXxXxXxXxXxXxXx'
    ));

    $client->enqueue($request)->send();
    $response = $client->getResponse();

    echo $response->getBody();
*/
}