<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scorer extends Model
{
    use HasFactory;


    public function scopeBest($query, string $location, $fixtures)
    {
        return $this
            ->where([
            ['club_id', '=', $fixtures->teams->$location->id],
            [$location, '=', function($query) use ($location, $fixtures){
                $query->selectRaw("max($location)")->where('club_id', '=', $fixtures->teams->$location->id)->from('scorers');
            }]
            ])->get();
    }


}
