<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Head2head extends Model
{
    use HasFactory;

    protected $table = 'h2h';


    public static  function byLocation($club, $location, $limit = null){

        $query = DB::table('h2h')
        ->select(DB::raw('h2h.played_at,   h2h.away_goals, 
            competitions.name as competition, club_h2h.location, h2h.home_goals, clubs.name'))
        ->join('club_h2h', 'h2h.id', '=', 'club_h2h.head2head_id')
        ->join('competitions', 'competitions.id', '=', 'h2h.competition_id')
        ->join('clubs', 'clubs.id', '=', 'club_h2h.club_id')
        ->where('club_h2h.club_id', '=', $club)
        ->where('club_h2h.location', '=', $location)
        ->orderBy('h2h.played_at', 'desc');

        if($limit)
        {
            $query->limit($limit);
        }

        return $query->get();
    }

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }

    public function clubs()
    {
        return $this->belongsToMany(Club::class, 'club_h2h')->withPivot('location');
    }

   
}