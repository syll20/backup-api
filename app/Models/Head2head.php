<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Head2head extends Model
{
    use HasFactory;

    protected $table = 'h2h';

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }

    public function clubs()
    {
        return $this->belongsToMany(Club::class);
    }

   
}