<?php

namespace App\Http\Controllers;

use App\Models\Fixture;
use Illuminate\Http\Request;

class FixtureController extends Controller
{
    public function index()
    {
        return view('list', ['fixtures' => Fixture::with('user', 'calendar')->latest()->paginate(2)]);

        //dd($list);

        /*
            --- TODO ---
            + Comment instancier classes Actions ou Services.
            

        */
    }

}
