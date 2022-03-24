<?php

namespace App\Http\Controllers;

use App\Models\Head2head;

use Goutte\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Head2headController extends Controller
{
    public function index()
    {
        return view('/admin/h2h/index');
    }

    public function store(Request $request)
    {

        $string = "20.03.22 Rennes - Metz 6 - 1 Ligue 1";

        /** verif
         * 
         */
        if( Str::contains($string, 'Rennes') && Str::contains($string, $request->club) )
        {
            //dd("Les deux clubs sont dans la string");
        }

        /**
         * explode
         */
        
        $data = [
            0 => "20.03.22",
            1 => "Rennes",
            2 => "-",
            3 => "Metz",
            4 => "6",
            5 => "-",
            6 => "1",
            7 => "Ligue",
            8 => "1"
        ];
        
        $dt = explode('.', $data[0]);

        $dt[2] += ($dt[2] >50) ? 1900 : 2000;

        dd($dt[2]. '-' . $dt[1]. '-' . $dt[0]);
         

        /**
         * Clubs migration
         */

        /**
         * How to import clubs name/id?
         */


        /**
         * Get clubs id/name
         */
        $clubs = Club::get();

        foreach($clubs as $club)
        {
            $relation[$club->name] = $club->id;
        }


        /**
         * Competition migration
         */

        /**
         * Set h2h object and save()
         */
        $h2h = new Head2head();
        $h2h->club_home_id = $data[1];
        $h2h->club_away_id = $data[3];
        $h2h->score = $data[4] .'-'. $data[6];
        $h2h->game_date= $dt[2]. '-' . $dt[1]. '-' . $dt[0];
        $h2h->competition = Competition::where('name', 'like', "$data[7]%")->value('id');
        $h2h->save();

        
        
        dd("stop");

        

        



        /*$relation = [
            0 => 'played_at',
            1 => 'match',
            2 => 'score',
            3 => 'competition'
        ];*/
        //$field = $relation[0];
        //dd($h2h->$field);

        $client = new Client();
        $website = $client->request('GET', $request->target);
        
        $filter = $website->filter('tr')->each(function($node) use ($relation){
            
                if(!isset($h2h)){
                    $h2h = new Head2head();
                }
                //$field = $relation[count($h2h->attributesToArray())]; 
                //$h2h->$field = $node->text();

                dump(explode(' ', $node->text()));
               
        });
        dump("B");

    }
}
