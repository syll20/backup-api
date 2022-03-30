<?php

return [

    'default' => env('SOCCER_DATA_API', 'api-football'),
   
    'rennes' => 'Rennes',
    'rennes_long' => 'Stade Rennais',

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

    'servers' => [

        'api-football' => [
            'current_season' => env('API_FOOTBALL_CURRENT_SEASON', 2021),
            'league_id' => env('API_FOOTBALL_LEAGUE', 61),
            'club_id' => env('API_FOOTBALL_CLUB', 94), 
            'namespace' => 'App\Servers\ApiFootballComV3',
            'base_url' => 'https://v3.football.api-sports.io',
            'auth_key_name' => env('API_FOOTBALL_KEY_NAME', 'x-apisports-key'),
            'auth_key_value' => env('API_FOOTBALL_KEY_VALUE', 'fdf1ff3c4f0ddfa001f0e3b223c9ce80'),
        ],

        /*        
        'sport-data-api' => [
            'namespace' => '',
            'auth_key_name' => env('SPORT_DATA_API_KEY_NAME', null),
            'auth_key_value' => env('SPORT_DATA_API_KEY_VALUE', null),
        ],

        'football-data' => [
            'namespace' => '',
            
        ],
        */
    ],

];
