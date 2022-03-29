<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Competition;
use App\Models\Head2head;
use Goutte\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Head2headController extends Controller
{
    public function index()
    {
        return view('/admin/h2h/index', [
            'clubs' => Club::orderBy('name')->get(),
        ]);
    }

    public function show(Request $request)
    {
       // $games = h2hByLocation($request)

        /*$team = Club::with('head2heads')
            ->whereHas('head2heads', function($query) use($request){
                $query->where('club_id', '=', $request->club)
                    ->where('club_h2h.location', '=', $request->location)
                    ->has('competition');
            }) 
            ->find($request->club);
            */

        return view('/admin/h2h/index', [
            'games' => Head2head::byLocation($$request->club, $request->location ), 
            'clubs' => Club::orderBy('name')->get(),
            'requestClub' => $request->club 
        ]);
    }


    public function store(Request $request)
    {

        /**
         * Get clubs id/name
         */
        $clubs = Club::get();

        foreach($clubs as $club)
        {
            if(isset($club->name2)){
                $relation[$club->name2] = $club->id;
            }else{
                $relation[$club->name] = $club->id;
            }
        }

        /**
         * Get html
         */
        $client = new Client();
        $website = $client->request('GET', $request->target);
        $website->filter('tr')->each(function($node) use ($request, $relation){
   
            $data = explode(' ', $node->text());
            dump($data);

            /**
             * Validation
             */
            if(count($data) < 8 || count($data) > 10){
                return;
            }
            dump([$request->club, 'Rennes']);

            if( ($data[1] != 'Rennes' && $data[1] != $request->club)
                    || 
                    ($data[3] != 'Rennes' && $data[3] != $request->club)
            ){
                return;
            }    

            /**
             * Date format 
             */
            $dt = explode('.', $data[0]);
            $dt[2] += ($dt[2] >50) ? 1900 : 2000;
            $gameDate = $dt[2]. '-' . $dt[1]. '-' . $dt[0];

            /**
             * Is this h2h already in the DB?
             */
            $h = Head2head::where('played_at', '=', $gameDate)->get();
            dump($h);
            dump($relation[$data[1]]);

            $club1 = $relation[$data[1]]; 
            $club2 = $relation[$data[3]]; 
            
            if(isset($h->clubs))
            {
                foreach($h->clubs as $club)
                {
                    dump('in foreach');
                    if(! Str::contains($club, $club1) && ! Str::contains($club, $club2) )
                    {
                        dump('return');
                        return;
                    }
                }
            }

            /**
             *  Get competition & save
             */
            $competition = Competition::where('name', 'like', "$data[7]%")->value('id');

            if(isset($competition))
            {
                $h2h = new Head2head();
                $h2h->played_at = $gameDate;
                $h2h->home_goals = $data[4];
                $h2h->away_goals = $data[6];
                $h2h->competition_id = $competition;
                $h2h->save();

                $h2h->clubs()->attach($club1, ['location' => 'home']);
                $h2h->clubs()->attach($club2, ['location' => 'away']);
            }
               
        });
        dd('import completed :)');
    }
}
