<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateStandingRequest;
use App\Models\Standing;
use Illuminate\Http\Request;
use App\Enums\Location;
use App\Models\Scorer;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;

class StandingController extends Controller
{
    public function index()
    {
        //$s = Scorer::orderBy('total', 'DESC')->get();
        //dd($s);

        return view('admin.standings', [
            'homeRankings' => Standing::rankings('home'),
            'awayRankings' => Standing::rankings('away')
        ]);
    }


    public function show(Location $location)
    {
        return view('admin.standings_location', [
            'rankings' => Standing::rankings($location->value),
            'location' => $location->value
        ]);
    }


    public function update(UpdateStandingRequest $request)
    {

        $validated = $request->validated();

        foreach($validated['ranking'] as $ranking)
        {
            $team = Standing::
                where('id', $ranking['id'])->
                where('club_id', $ranking['club_id'])->
                update($ranking);
        }
        
        return redirect('/admin/standings')->with('success', 'Standings updated');
    }


}
