<?php

namespace App\Http\Controllers;

use App\Contracts\SoccerDataApiInterface;
use App\Models\Fixture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

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


            $json = Http::withHeaders([
                    $this->auth['key_name'] => $this->auth['key_value']
                ])->get('https://v3.football.api-sports.io/fixtures', [
                   // 'league' => '61',
                    //'season' => '2021',
                    'team' => '94',
                    'next' => '5'
                ]);

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

        return view('create', [
            'next_games' => collect($json['response'])
        ]);

    }

}
