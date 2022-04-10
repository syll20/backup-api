<?php

namespace App\Models;

use App\Enums\Location;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Standing extends Model
{
    use HasFactory;

    public function scopeRankings($query, Location $location)
    {
        return $this
            ->where('location', $location->value)
            ->orderBy('points', 'DESC')
            ->orderBy('goals_diff', 'desc')
            ->orderBy('goals_for', 'desc')
            ->orderBy('win', 'desc')
            ->get();
    }
}
