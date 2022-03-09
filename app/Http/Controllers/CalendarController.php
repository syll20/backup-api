<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    

    public function index()
    {
        return view('list', ['calendars' => Calendar::with('fixture')->latest()->get()]);

        //dd($list);

        /*
            --- TODO ---

            Faire FixtureController
            + fixture list view : return view('list', ['fixtures' => Fixture::with('user', 'calendar')->latest()->get()]);
            
            + paginate
            + prendre le beau tableau du blog
            + installer/configurer Tailwind
            
            

        */
    }
}
