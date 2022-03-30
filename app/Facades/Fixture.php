<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Fixture extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'fixture';
    }
}
