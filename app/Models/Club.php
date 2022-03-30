<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;

    public function head2heads()
    {
        return $this->belongsToMany(Head2head::class, 'club_h2h')->withPivot('location');
    }
}
