<?php

namespace App\Http\Controllers;

//require_once __DIR__.'/../../../vendor/autoload.php';

use App\Actions\Fixtures;
use App\Actions\MainAction;
use App\Contracts\SoccerDataApiInterface;
use App\Http\Requests\StoreFixtureRequest;
use App\Models\Calendar;
use App\Models\Fixture;
use App\Services\CentralStation;

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
        
        if( ($template = $central->handle()) === null)
        {
            return redirect('/create')
                ->withErrors("There is no fixture that day ($request->date)");
        }

        /*if(! isset($template))
        {
            return redirect('/create')
                ->withErrors("There is no fixture that day ($request->date)");
        }*/

        $fixture = new Fixture();
        $fixture->user_id = auth()->id();
        $fixture->template = $template;
        $fixture->calendar_id = Calendar::where('kickoff', 'like', $request->date.'%')->value('id');
        $fixture->save();

        return view('create', [
            'template' => $template,
            'next_games' => Calendar::where('kickoff', '>', date('Y-m-d H:i:s'))->get()
            
        ]);
    }
}
