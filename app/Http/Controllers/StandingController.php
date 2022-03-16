<?php

namespace App\Http\Controllers;

use App\Models\Standing;
use Illuminate\Http\Request;

class StandingController extends Controller
{
    public function index()
    {
        return view('admin.standings', [
            'homeRankings' => Standing::rankings('home'),
            'awayRankings' => Standing::rankings('away')
        ]);
    }


}
