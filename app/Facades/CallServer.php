<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class CallServer extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'callserver';
    }
}
