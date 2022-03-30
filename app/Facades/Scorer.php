<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Scorer extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'scorer';
    }
}
