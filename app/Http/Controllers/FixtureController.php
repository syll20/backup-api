<?php

namespace App\Http\Controllers;

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
            'fixtures' => Fixture::with('user', 'calendar')->latest()->paginate(8)
        ]);
    }

    public function show(Fixture $fixture)
    {
        return view('admin.template-show', [
            'fixture' => $fixture
        ]);
    }


    public function create()
    {     
        return view('admin.template-create', [
            'next_games' => Calendar::where('kickoff', '>', date('Y-m-d H:i:s'))->limit(3)->get()
        ]);
    }


    public function store(StoreFixtureRequest $request, CentralStation $central)
    {
        
        if( ($template = $central->handle()) === null)
        {
            return redirect('/admin/create')
                ->withErrors("There is no fixture that day ($request->date)");
        }

        $fixture = new Fixture();
        $fixture->user_id = auth()->id();
        $fixture->template = $template;
        $fixture->calendar_id = Calendar::where('kickoff', 'like', $request->date.'%')->value('id');
        $fixture->save();

        return view('admin.template-create', [
            'template' => $template,
            'next_games' => Calendar::where('kickoff', '>', date('Y-m-d H:i:s'))->get()
            
        ]);
    }
}
