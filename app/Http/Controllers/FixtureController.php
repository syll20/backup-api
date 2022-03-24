<?php

namespace App\Http\Controllers;

require_once __DIR__.'/../../../vendor/autoload.php';


use App\Actions\Fixtures;
use App\Actions\MainAction;
use App\Contracts\SoccerDataApiInterface;
use App\Http\Requests\StoreFixtureRequest;
use App\Models\Calendar;
use App\Models\Fixture;
use App\Models\H2h;
use App\Models\Head2Head;
use App\Services\Api;
use App\Services\CentralStation;
use GuzzleHttp\Client as GuzzleClient;

use Goutte\Client;

use Illuminate\Support\Facades\Storage;
use Weidner\Goutte\GoutteFacade;

class FixtureController extends Controller
{
    protected $auth;

    public function index()
    {
        return view('admin.fixture-list', [
            'fixtures' => Fixture::with('user', 'calendar')->latest()->paginate(5)
        ]);
    }

    public function show(Fixture $fixture)
    {
        return view('show', [
            'fixture' => $fixture
        ]);
    }


    public function create()
    {     
        return view('create', [
            'next_games' => Calendar::where('kickoff', '>', date('Y-m-d H:i:s'))->get()
        ]);
    }


    public function store(StoreFixtureRequest $request, CentralStation $central)
    {
        
        $template = $central->handle();

        if(! isset($template))
        {
            return redirect('/create')
                ->withErrors("There is no fixture that day ($request->date)");
        }

        $fixture = new Fixture();
        $fixture->user_id = auth()->id();
        $fixture->template = $template;
        $fixture->calendar_id = Calendar::where('kickoff', 'like', $request->date.'%')->value('id');
        $fixture->save();
    
        $games = Calendar::where('kickoff', '>', date('Y-m-d H:i:s'))->get();

        return view('create', [
            'next_games' => $games,
            'template' => $template
        ]);

        
       /*
        $client = new Client();
        $count= 0;
        $h2h = new Head2Head();

        $h2h->played_at = '2022-03-15';

        $relation = [
            0 => 'played_at',
            1 => 'match',
            2 => 'score',
            3 => 'competition'
        ];
        $field = $relation[0];
        dd($h2h->$field);

        $website = $client->request('GET', 'https://www.matchendirect.fr/statistique/lyon-contre-rennes.html');
        $filter = $website->filter('tr')->children('td')->each(function($node) use($count, $h2h, $relation){
            
                $field = $relation[$count]; 
                $h2h->$field = $node->text();
                $count++;

                if($count == 4){
                    //$h2h->save();
                    $count= 0;
                }
            
            dd($h2h);
        });
        dd($filter);
        */

        /**
         *  1. Sauve la page dans un fixhier
         *  2. Lire le fichier
         *  3. Installer SimpleDom
         *  4. Essayer ça: $ret = $html->find('table[class=cd1]'); 
         * 
         * 
         */

        //dd('stop');

       

    }

}
