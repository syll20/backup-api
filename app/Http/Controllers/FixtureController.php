<?php

namespace App\Http\Controllers;

require_once __DIR__.'/../../../vendor/autoload.php';


use App\Actions\Fixtures;
use App\Actions\MainAction;
use App\Contracts\SoccerDataApiInterface;
use App\Http\Requests\StoreFixtureRequest;
use App\Models\Fixture;
use App\Services\Api;
use App\Services\CentralStation;
use GuzzleHttp\Client as GuzzleClient;
use Goutte\Client;

use Symfony\Component\BrowserKit\HttpBrowser;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class FixtureController extends Controller
{
    protected $auth;

    public function index()
    {
        return view('list', [
            'fixtures' => Fixture::with('user', 'calendar')->latest()->paginate(5)
        ]);
    }

    public function show(Fixture $fixture)
    {
        return view('show', [
            'fixture' => $fixture
        ]);
    }


    public function create(SoccerDataApiInterface $s)
    {

        //dd('In FICTURE::CREATE');
        /*
            TODO

            return (api) liste des prochains matchs
    
        */
        $json = null;
        $this->s = $s;

        // next games:
        if($this->auth = $this->s->getAuthKeys())
        {
                //$dt = date_create("2022-03-08 23:59:00");
                // dd($dt);

        //$json = '[{"fixture":{"id":718625,"referee":"A. Gautier","timezone":"UTC","date":"2022-03-13T16:05:00+00:00","timestamp":1647187500,"periods":{"first":null,"second":null},"venue":{"id":666,"name":"Groupama Stadium","city":"D\u00e9cines-Charpieu"},"status":{"long":"Not Started","short":"NS","elapsed":null}},"league":{"id":61,"name":"Ligue 1","country":"France","logo":"https:\/\/media.api-sports.io\/football\/leagues\/61.png","flag":"https:\/\/media.api-sports.io\/flags\/fr.svg","season":2021,"round":"Regular Season - 28"},"teams":{"home":{"id":80,"name":"Lyon","logo":"https:\/\/media.api-sports.io\/football\/teams\/80.png","winner":null},"away":{"id":94,"name":"Rennes","logo":"https:\/\/media.api-sports.io\/football\/teams\/94.png","winner":null}},"goals":{"home":null,"away":null},"score":{"halftime":{"home":null,"away":null},"fulltime":{"home":null,"away":null},"extratime":{"home":null,"away":null},"penalty":{"home":null,"away":null}}},{"fixture":{"id":844644,"referee":null,"timezone":"UTC","date":"2022-03-17T17:45:00+00:00","timestamp":1647539100,"periods":{"first":null,"second":null},"venue":{"id":680,"name":"Roazhon Park","city":"Rennes"},"status":{"long":"Not Started","short":"NS","elapsed":null}},"league":{"id":848,"name":"UEFA Europa Conference League","country":"World","logo":"https:\/\/media.api-sports.io\/football\/leagues\/848.png","flag":null,"season":2021,"round":"Round of 16"},"teams":{"home":{"id":94,"name":"Rennes","logo":"https:\/\/media.api-sports.io\/football\/teams\/94.png","winner":null},"away":{"id":46,"name":"Leicester","logo":"https:\/\/media.api-sports.io\/football\/teams\/46.png","winner":null}},"goals":{"home":null,"away":null},"score":{"halftime":{"home":null,"away":null},"fulltime":{"home":null,"away":null},"extratime":{"home":null,"away":null},"penalty":{"home":null,"away":null}}},{"fixture":{"id":718639,"referee":null,"timezone":"UTC","date":"2022-03-20T14:00:00+00:00","timestamp":1647784800,"periods":{"first":null,"second":null},"venue":{"id":680,"name":"Roazhon Park","city":"Rennes"},"status":{"long":"Not Started","short":"NS","elapsed":null}},"league":{"id":61,"name":"Ligue 1","country":"France","logo":"https:\/\/media.api-sports.io\/football\/leagues\/61.png","flag":"https:\/\/media.api-sports.io\/flags\/fr.svg","season":2021,"round":"Regular Season - 29"},"teams":{"home":{"id":94,"name":"Rennes","logo":"https:\/\/media.api-sports.io\/football\/teams\/94.png","winner":null},"away":{"id":112,"name":"Metz","logo":"https:\/\/media.api-sports.io\/football\/teams\/112.png","winner":null}},"goals":{"home":null,"away":null},"score":{"halftime":{"home":null,"away":null},"fulltime":{"home":null,"away":null},"extratime":{"home":null,"away":null},"penalty":{"home":null,"away":null}}},{"fixture":{"id":718646,"referee":null,"timezone":"UTC","date":"2022-04-03T00:00:00+00:00","timestamp":1648944000,"periods":{"first":null,"second":null},"venue":{"id":663,"name":"Allianz Riviera","city":"Nice"},"status":{"long":"Time to be defined","short":"TBD","elapsed":null}},"league":{"id":61,"name":"Ligue 1","country":"France","logo":"https:\/\/media.api-sports.io\/football\/leagues\/61.png","flag":"https:\/\/media.api-sports.io\/flags\/fr.svg","season":2021,"round":"Regular Season - 30"},"teams":{"home":{"id":84,"name":"Nice","logo":"https:\/\/media.api-sports.io\/football\/teams\/84.png","winner":null},"away":{"id":94,"name":"Rennes","logo":"https:\/\/media.api-sports.io\/football\/teams\/94.png","winner":null}},"goals":{"home":null,"away":null},"score":{"halftime":{"home":null,"away":null},"fulltime":{"home":null,"away":null},"extratime":{"home":null,"away":null},"penalty":{"home":null,"away":null}}},{"fixture":{"id":718659,"referee":null,"timezone":"UTC","date":"2022-04-10T00:00:00+00:00","timestamp":1649548800,"periods":{"first":null,"second":null},"venue":{"id":674,"name":"Stade Auguste-Delaune II","city":"Reims"},"status":{"long":"Time to be defined","short":"TBD","elapsed":null}},"league":{"id":61,"name":"Ligue 1","country":"France","logo":"https:\/\/media.api-sports.io\/football\/leagues\/61.png","flag":"https:\/\/media.api-sports.io\/flags\/fr.svg","season":2021,"round":"Regular Season - 31"},"teams":{"home":{"id":93,"name":"Reims","logo":"https:\/\/media.api-sports.io\/football\/teams\/93.png","winner":null},"away":{"id":94,"name":"Rennes","logo":"https:\/\/media.api-sports.io\/football\/teams\/94.png","winner":null}},"goals":{"home":null,"away":null},"score":{"halftime":{"home":null,"away":null},"fulltime":{"home":null,"away":null},"extratime":{"home":null,"away":null},"penalty":{"home":null,"away":null}}}]';
            /*
                        $games = Http::acceptJson()->withHeaders([
                                $this->auth['key_name'] => $this->auth['key_value']
                            ])->get('https://v3.football.api-sports.io/fixtures', [
                            // 'league' => '61',
                                //'season' => '2021',
                                'team' => '94',
                                'next' => '5'
                            ])->json();

            */        
        }
        
        //dd($games);

        $games = null;
        return view('create', [
            'next_games' => $games
        ]);

    }


    //public function store(StoreFixtureRequest $request, MainAction $action)
    public function store(CentralStation $central)
    {

        /*
         * TODO: Custom Rule: 
         *
         *  Verifier la date correspond a un match de l'equipe
         * getFixturesByDate()
         * creer une class Rule GameDate php artisan make:rule GameDate
        */

        //dd($request);
        //$api->fixtures();


        /*
        $fixture['timestamp'] = 1234;
        $fixture['venue']['name'] = 'Roazhon Park';
        $fixture['referee'] = "Mr l'arbitre";

        $f = json_decode (json_encode ($fixture), FALSE);
       // dd($f->venue->name);
        */

        //$action->handle('fixtures');
        //$action->handle();


        //$home = array();
        /*$home[91] = 41;
        $home[94] = 54;
        $home[92] = 42;
        arsort($home);*/
        
        $home = array();
        $home['points'][91] = 41;
        $home['diff'][91] = 15;

        $home['points'][94] = 54;
        $home['diff'][94] = 5;

        $home['points'][92] = 41;
        $home['diff'][92] = 17;

        /*
        $ar = array(
            array("10", 11, 100, 100, "a"),
            array(   1,  2, "2",   3,   1)
           );

        array_multisort($home['points'], SORT_DESC, SORT_NUMERIC,
                        $home['diff'], SORT_NUMERIC, SORT_DESC);

*/
/*
$waiters[76] = array('points' => 67, 'diff' => 1);
$waiters[14] = array('points' => 41, 'diff' => 2);
$waiters[58] = array('points' => 85, 'diff' => 3);
$waiters[89] = array('points' => 98, 'diff' => 4);
$waiters[68] = array('points' => 85, 'diff' => 5);
$waiters[31] = array('points' => 13, 'diff' => 6);

foreach ($waiters as $id => $waiter) {
    $points[$id]        = $waiter['points'];
    $diff[$id]   = $waiter['diff'];

}

$keys = array_keys($waiters);
array_multisort(
    $points, SORT_DESC, SORT_NUMERIC,
    $diff, SORT_DESC, SORT_NUMERIC ,
    $waiters, $keys
);
//$waiters = array_combine($keys, $waiters);

        dd($waiters);
        
        */

        /*
        $goutteClient = new Client();
        $guzzleClient = new GuzzleClient(array(
            'timeout' => 60,
            'verify' => false
        ));
        $goutteClient->setClient($guzzleClient);
        //setClient($guzzleClient);
        $crawler = $goutteClient->request('GET', 'https://www.maxifoot.fr/calendrier-ligue-1-france-2021-2022.htm');
        dd($crawler);
        $crawler->filter('.cald1 .cd1')->each(function ($node) {
            dd($node->text());
        });

*/

if (Storage::disk('local')->exists('public/exemple.txt')) {
    $content = Storage::get('public/example.txt');
}else{
    print "<br>GUZZLE<br>";
    $guzzleClient = new GuzzleClient(array(
        'timeout' => 60,
        'verify' => false
    ));

    $response = $guzzleClient->get('https://www.maxifoot.fr/calendrier-ligue-1-france-2021-2022.htm');
    $content = $response->getBody()->getContents();
    Storage::disk('local')->put('public/example.txt', $content);
}
//dd($content);

/**
 *  1. Sauve la page dans un fixhier
 *  2. Lire le fichier
 *  3. Installer SimpleDom
 *  4. Essayer ça: $ret = $html->find('table[class=cd1]'); 
 * 
 * 
 */




        dd('stop');

        $central->handle();

    }
    /*
            $json = Cache::remember('next1', 30, function () {
                print "CLOSURE";
                return Http::
                    withHeaders([
                        $this->auth['key_name'] => $this->auth['key_value']
                    ])->get('https://v3.football.api-sports.io/fixtures?league=61&season=2021&team=94&next=5');

            });
        */
        /*            
            var_dump($this->auth['key_name']);
            var_dump($this->auth['key_value']);
            collect($json['response'])->map(function($data){
                var_dump($data['teams']);
            });
            exit;
        */
               // print_r( Utils::jsonDecode($json->body()));

}
