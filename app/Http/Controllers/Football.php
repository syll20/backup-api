<?php

namespace App\Http\Controllers;

use App\Contracts\SoccerDataApiInterface;
use App\SoccerDataApi;
use App\Http\Controllers\Controller;
use DateTime;
//use App\SoccerDataApi\SoccerDataApiManager;
use Dflydev\DotAccessData\Util;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Utils;
use Illuminate\Support\Facades\Cache;
use IntlDateFormatter;

class Football extends Controller
{
        /**
     * @var \Illuminate\Foundation\Application
     */
    protected $auth;


    function __construct(SoccerDataApiInterface $s)
    {
        $this->s = $s;
    }
   
    public function getNextGames()
    {

/*
        1. VERIFIER SI L'INFO EST EN BD

        2. SI NON, HTTP::api.... 

            2.1. ENREGISTRER DANS LA DB (si config ok pour enregistrer)
 */       
        if($this->auth = $this->s->getAuthKeys())
        {
                $dt = date_create("2022-03-08 23:59:00");
                // dd($dt);
                $json = Cache::remember('next1', 30, function () {
                    print "CLOSURE";
                    $x =  Http::
                        withHeaders([
                            $this->auth['key_name'] => $this->auth['key_value']
                        ])->get('https://v3.football.api-sports.io/fixtures?league=61&season=2021&team=94&next=1');

                    dd($x);
                    
                    return $x;
                });

               // print_r( Utils::jsonDecode($json->body()));
        
        }
                //$test = new SoccerDataApi(api_key: 1234);
                //$test->getLeaguesByTeamId(94);


        //$this->app->make('SoccerDataApi');
        //dd($this->app['SoccerDataApi']);

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


        $fmt = new IntlDateFormatter( "fr_FR" ,IntlDateFormatter::LONG, IntlDateFormatter::SHORT, 
            'Europe/Paris',IntlDateFormatter::GREGORIAN  );


        print "<br><br><br>";
        $decode = json_decode($json);
        $data = $decode->response[0];
        print "<br><br><br>";
        print '<img src="'.$data->teams->home->logo.'"  />';
        print_r($data->teams->home->name);
        print " vs ";
        print_r($decode->response[0]->teams->away->name);
        print '<img src="'.$decode->response[0]->teams->away->logo.'" width="40" />';
        print "<br>";
        print $fmt->format($data->fixture->timestamp);
        print "<br>";
        //print $date = date('j F Y, H:i', $data->fixture->timestamp);

        print $this->s->getCountries();
        print "<br>";
        print "[center][b]Ligue 1 - xxe journée[/b][/center]

        [center][b](Date et heure du match) - (Nom du stade)[/b][/center] (https://www.ligue1.fr/ cliquer sur le match en question)
        
        [center][img](lien logo équipe domicile)[/img] | [img](lien logo équipe extérieure)[/img][/center] (https://www.ligue1.fr/ idem qu'au dessus, clic droit copier lien de l'image)
        
        [center][b](Classement)[/b] | [b](Classement)[/b][/center] (https://www.lequipe.fr/Football/ligue-1/page-classement-equipes/general)
        [center][b]xx pts[/b] | [b]xx pts[/b][/center] (nbre points)
        [center][b]+/-xx[/b] | [b]+/-xx[/b][/center] (différence de buts)
        
        
        [center](Présentation du match, si vous le souhaitez)[/center]
        
        
        [center][b]Chiffres à domicile[/b] | [b]Chiffres à l'extérieur[/b][/center] (https://www.lequipe.fr/Football/ligue-1/page-classement-equipes/general classement domicile/exterieur)
        
        [center](Classement à domicile) | (Classement à l'extérieur)[/center]
        [center]xV - xN - xD | xV - xN - xD[/center]
        [center]xx pts | xx pts (points)[/center]
        [center]+/-xx | +/-xx (différence de but)[/center]
        [center][b]Série en cours (Dom | Ext)[/b][/center]
        [center]X-X-X-X | X-X-X-X[/center]
        [center][b]Meilleurs buteurs (Dom | Ext)[/b][/center] (https://www.transfermarkt.fr/ligue-1/heimauswaertstorschuetzen/wettbewerb/FR1/saison_id/2021/plus/1 un peu chiant s'ils font pas partir du top 20)
        [center][img](lien de la photo du buteur)[/img] | [img](lien de la photo du buteur)[/img][/center]
        [center]Prénom NOM (nbre de but) | Prénom NOM (nbre de but)[/center]
        
        
        [b]Groupes :[/b] 
        
        [u](Nom de l'équipe domicile)[/u]
        [i]Suspendu(s) :[/i] 
        [i]Blessé(s) :[/i] 
        [i]Groupe :[/i] 
        
        [u](Nom de l'équipe extérieure)[/u] 
        [i]Suspendu(s) :[/i] 
        [i]Blessé(s) :[/i] 
        [i]Groupe :[/i] 
        
        ---
        
        [b]Les arbitres de la rencontre :[/b] (https://www.ligue1.fr/ feuille de match)
        [i]Arbitre principal :[/i] 
        [i]Arbitres assistants :[/i] 
        [i]4e arbitre :[/i] 
        
        ---
        
        [b]Les dernières confrontations :[/b] (https://www.matchendirect.fr/france/ligue-1/ cliquer sur stat des équipes)
        Date : score
        Date : score
        Date : score
        Date : score
        Couleur : (gris, nul) (rouge, défaite) (vert, victoire)
        
        [b]Bilan des confrontations :[/b]
        [img](lien mini logo équipe domicile)[/img] (nombre de victoires équipe domicile) - (nombre matchs nuls) - (nombre de victoires équipe extérieure) [img](lien mini logo équipe extérieur)[/img] (mini logo : https://www.transfermarkt.fr/ligue-1/startseite/wettbewerb/FR1 clic droit copier lien de l'image)
        
        ---
        
        [b]Diffusion télé :[/b] (Logo à trouver ici : https://www.ligue1.fr/ feuille de match)
        
        ---
        
        Classement Ligue 1 (si vous le souhaitez, trouvable ici : https://www.transfermarkt.fr/ligue-1/startseite/wettbewerb/FR1 - cap d'écran à réaliser, upload sur imgur) ";

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