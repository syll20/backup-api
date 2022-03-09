<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Cache Store
    |--------------------------------------------------------------------------
    |
    | This option controls the default cache connection that gets used while
    | using this caching library. This connection is used when another is
    | not explicitly specified when executing a given caching function.
    |
    */

    'default' => env('SOCCER_DATA_API', 'api-football'),
   
    /*
    |--------------------------------------------------------------------------
    | Cache Stores
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the cache "stores" for your application as
    | well as their drivers. You may even define multiple stores for the
    | same cache driver to group types of items stored in your caches.
    |
    | Supported providers: "api-football.com", "sportdataapi.com", 
    /                       "football-data.org"
    |
    */
/*
    Headers([
        'x-apisports-key' => 'fdf1ff3c4f0ddfa001f0e3b223c9ce80'
*/
    'providers' => [

        'api-football' => [
            'driver' => 'App\SoccerDataApi\ApiFootball',
            'auth_key_name' => env('API_FOOTBALL_KEY_NAME', 'x-apisports-key'),
            'auth_key_value' => env('API_FOOTBALL_KEY_VALUE', 'fdf1ff3c4f0ddfa001f0e3b223c9ce80'),
        ],

/*        'sport-data-api' => [
            'driver' => 'SportDataApi',
            'auth_key_name' => env('SPORT_DATA_API_KEY_NAME', null),
            'auth_key_value' => env('SPORT_DATA_API_KEY_VALUE', null),
        ],

        'football-data' => [
            'driver' => 'database',
            
        ],
*/
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache Key Prefix
    |--------------------------------------------------------------------------
    |
    | When utilizing a RAM based store such as APC or Memcached, there might
    | be other applications utilizing the same cache. So, we'll specify a
    | value to get prefixed to all our keys so we can avoid collisions.
    |
    */

//    'prefix' => env('CACHE_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_').'_cache_'),

];
