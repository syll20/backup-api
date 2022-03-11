<?php

namespace App\Api\V1;

use App\Contracts\SoccerDataApiInterface;

/**
 * Setup the query for api-football.com API
 */
class ApiFootballCom implements SoccerDataApiInterface
{
 
    private $auth_key_name = null;
    private $auth_key_value = null;

/*
    function __construct(App $app)
    {
        $this->app = $app;
    }
*/
    function __construct(array $provider)
    {
        //dd($provider);
        $this->auth_key_name = $provider['auth_key_name'];
        $this->auth_key_value = $provider['auth_key_value'];
    }

    public function getAuthKeys(): array
    {
        return [
            'key_name' => $this->auth_key_name, 
            'key_value' =>$this->auth_key_value
        ];
    }


    /**
     *  COUNTRIES 
    */ 

    public function getCountries(): string
    {
        return '/countries?';
    }

    public function getCountryByName(string $english_name): string
    {
        return $this->getCountries() . http_build_query(['name' => $english_name]);
    }

    public function getCountryByCode(string $code): string
    {
        return $this->getCountries() . http_build_query(['code'=> $code]);
    }
    
    public function getCountryBySearch(string $search): string
    {
        return $this->getCountries() . http_build_query(['search'=> $search]);
    }

    // https://media.api-sports.io/flags/{country_code}.svg
    public function getCountryFlag(string $country_code): string
    {
        return "https://media.api-sports.io/flags/" . $country_code . ".svg";
    }


    /**
     *  SEASONS 
    */ 

    public function getSeasons(): string
    {
        return '/leagues/seasons';
    }

    /** get("https://v3.football.api-sports.io/leagues?id=39");  -- SAME AS getLeagueById() */
    public function getSeasonsByLeague(int $league_id): string
    {
        return $this->getLeagues() . http_build_query(['id' => $league_id]);
    }


    /**
     *  LEAGUES 
    */ 

    /**get("https://v3.football.api-sports.io/leagues"); */ 
    public function getLeagues(): string
    {
        return '/leagues?';
    }

    /** get("https://v3.football.api-sports.io/leagues?id=39"); -- SAME AS getSeasonsByLeague() */
    public function getLeagueById(int $league_id): string
    {
        return $this->getLeagues() . http_build_query(['id' => $league_id]);
    }

    /** get("https://v3.football.api-sports.io/leagues?name= premier league"); */
    public function getLeaguesByName(string $english_league_name): string
    {
        return $this->getLeagues() . http_build_query(['name' => $english_league_name]);
    }

    /** get("https://v3.football.api-sports.io/leagues?country=england"); */
    public function getLeaguesByCountry(string $english_country_name): string
    {
        return $this->getLeagues() . http_build_query(['country' => $english_country_name]);
    }

    /** get("https://v3.football.api-sports.io/leagues?code=gb"); */
    public function getLeaguesByCountryCode(string $country_code): string
    {
        return $this->getLeagues() . http_build_query(['code' => $country_code]);
    }

    /** get("https://v3.football.api-sports.io/leagues?season=2021"); */
    public function getLeaguesBySeason(int $season_id): string
    {
        return $this->getLeagues() . http_build_query(["season" => $season_id]);
    }
    
    /** get("https://v3.football.api-sports.io/leagues?season=2021&id=39"); */
    public function getLeagueBySeasonAndId(int $season_id, int $league_id): string
    {
        return $this->getLeagues() . 
            http_build_query([
                'season' => $season_id, 
                'league' => $league_id
            ])
        ;
    }

    // Get all leagues in which the {team} has played at least one match
    /** get("https://v3.football.api-sports.io/leagues?team=33"); */
    public function getLeaguesByTeamId(int $team_id): string
    {
        return $this->getLeagues() . http_build_query(["team" => $team_id]);
    }

    // Allows you to search for a league in relation to a league {name} or {country}
    /** get("https://v3.football.api-sports.io/leagues?search=premier league");  */
    /**
     * @param string $search is a league name or a country name
     */
    public function getLeagueBySearch(string $search): string
    {
        return $this->getLeagues() . http_build_query(["search" => $search]);
    }

    /**
     * // Get all leagues from one {type}
     * get("https://v3.football.api-sports.io/leagues?type=league");
     */
    public function getLeaguesByType(string $competition_type): string
    {
        return $this->getLeagues() . http_build_query(["type" => $competition_type]);
    }

    /**
     * // Get all leagues where the season is in progress or not
     * get("https://v3.football.api-sports.io/leagues?current=true");
     */
    public function getLeaguesByStatus(bool $status): string
    {
        return $this->getLeagues() . http_build_query(["current" => $status? 'true' : 'false']);
    }

    /**
     * // Get the last 99 leagues or cups added to the API
     * get("https://v3.football.api-sports.io/leagues?last=99");
     */
    public function getLatestLeaguesAdded(int $latest): string
    {
        return $this->getLeagues() . http_build_query(["last" => $latest]);
    }

    /**
     * filtres: 
     *    season
     *   country_name
     *   country_code
     *   type
     *   team_id
     *   league_id
     *   current
     */
    public function getLeaguesByMixedFilters(array $filters): string
    {
        $leagues_mixed_filters = 
            array(
                'season' => null, 
                'country_name' => null, 
                'country_code' => null, 
                'type' => null, 
                'team_id' => null, 
                'league_id' => null, 
                'current' => null
            )
        ;

        return $this->getLeagues(). 
            http_build_query(
                array_intersect_key($filters, $leagues_mixed_filters)
            )
        ;


    }

    /**https://media.api-sports.io/football/leagues/{league_id}.png */
    public function getLeagueLogo(int $league_id): string
    {
        return "https://media.api-sports.io/football/leagues/" . $league_id . ".png";
    }


    /**
     *  TEAMS 
     */
    public function getTeams(): string
    {
        return '/teams?';
    }


     /**
       * // Get one team from one team {id}
       * get("https://v3.football.api-sports.io/teams?id=33");
     */
    public function getTeamById(int $team_id): string
    {
        return $this->getTeams() . http_build_query(["teams" => $team_id]);
    }

    /** 
      * // Get one team from one team {name}
      * get("https://v3.football.api-sports.io/teams?name=manchester united");
      */
    public function getTeamByName(string $english_team_name): string
    {
        return $this->getTeams() . http_build_query(["name" => $english_team_name]);
    }

    /** 
      * // Get all teams from one {league} & {season}
      * get("https://v3.football.api-sports.io/teams?league=39&season=2019");
      */
    public function getTeamsByLeagueAndSeason(int $league_id, int $season_id): string
    {
        return $this->getTeams() . 
            http_build_query([
                'season' => $season_id, 
                'league' => $league_id
            ])
        ;
    }

    /**
     *  Get teams from one team {country}
     * get("https://v3.football.api-sports.io/teams?country=england");
     */
    public function getTeamsByCountry(string $english_country_name): string
    {
        return $this->getTeams() . http_build_query(["country" => $english_country_name]);
    }

    /**
     * Allows you to search for a team in relation to a team {name} or {country}
     * get("https://v3.football.api-sports.io/teams?search=manches");
     * get("https://v3.football.api-sports.io/teams?search=England");
     * 
     * @param string $search is a portion of team name or country
     */
    public function getTeamsBySearch(string $search): string
    {
        return $this->getTeams() . http_build_query(["search" => $search]);
    }
    
    /**
     * https://media.api-sports.io/football/teams/{team_id}.png
     */
    public function getTeamLogo(int $team_id): string
    {
        return "https://media.api-sports.io/football/teams/" . $team_id . "png";
    }

    public function getTeamStatistics()
    {
        return '/teams/statistics?';
    }
    /**
     *  //Get all statistics for a {team} in a {league} & {season} with a end {date}
     * get("https://v3.football.api-sports.io/teams/statistics?league=39&team=33&season=2019&date=2019-10-08");
     */
    public function getTeamStatisticsByLeagueAndSeason(int $team_id, int $league_id, int $season_id, string $date=null): string
    {
        $filters = [
            'season' => $season_id, 
            'league' => $league_id,
            'team' => $team_id
        ];
            
        if($date) { 
            $filters['date'] = $date; 
        }

        return $this->getTeamStatistics() .  http_build_query($filters);
    }

    /**
     * // Get all seasons available for a team from one team {id}
     * get("https://v3.football.api-sports.io/teams/seasons?team=33");
     */
    public function getTeamSeasons(int $team_id): string
    {
        return '/teams/seasons/' . http_build_query(["team" => $team_id]);
    }


    /**
     *  VENUES 
     */

    public function getVenues(){
        return '/venues?';
    }


    /** 
     * Get one venue from venue {id}
     * get("https://v3.football.api-sports.io/venues?id=556");
    */
    public function getVenueById(int $venue_id): string
    {
        return $this->getVenues() . http_build_query(["id" => $venue_id]);
    }

    /**
     * Get one venue from venue {name}
     * get("https://v3.football.api-sports.io/venues?name=Old Trafford");
     */
    public function getVenueByName(string $english_venue_name): string
    {
        return $this->getVenues() . http_build_query(["name" => $english_venue_name]);
    }

    /**
     * Get all venues from {city}
     * get("https://v3.football.api-sports.io/venues?city=manchester");
     */
    public function getVenuesByCity(string $english_city_name): string
    {
        return $this->getVenues() . http_build_query(["city" => $english_city_name]);
    }

    /**
     * Get venues from {country}
     * get("https://v3.football.api-sports.io/venues?country=england");
     */
    public function getVenuesByCountry(string $english_country_name): string
    {
        return $this->getVenues() . http_build_query(["country" => $english_country_name]);
    }

    /**
     * // Allows you to search for a venues in relation to a venue {name}, {city} or {country}
     * get("https://v3.football.api-sports.io/venues?search=trafford");
     * get("https://v3.football.api-sports.io/venues?search=manches");
     * get("https://v3.football.api-sports.io/venues?search=England");
     */
    public function getVenuesBySearch(string $search): string
    {
        return $this->getVenues() . http_build_query(["search" => $search]);
    }

    /**
     * https://media.api-sports.io/football/venues/{venue_id}.png
     */
    public function getVenueLogo(int $venue_id): string
    {
        return "https://media.api-sports.io/football/venues/" . $venue_id . ".png";
    }


    /**
     *  STANDINGS 
     */

    public function getStandings()
    {
        return '/standings?';
    }

     /**
      * Get all Standings from one {league} & {season}
      * get("https://v3.football.api-sports.io/standings?league=39&season=2019");
      */
    public function getStandingsByLeagueAndSeason(int $season_id, int $league_id): string
    {
        return $this->getStandings() . 
            http_build_query([
                'season' => $season_id, 
                'league' => $league_id
            ])
        ;
    }

    /**
     * Get all Standings from one {team} & {season}
     * get("https://v3.football.api-sports.io/standings?team=33&season=2019");
     */
    public function getTeamStandingsBySeason(int $team_id, int $season_id, int $league_id=null): string
    {
        $filters = [
            'season' => $season_id, 
            'team' => $team_id
        ];
            
        if($league_id) { 
            $filters['league'] = $league_id; 
        }

        return $this->getStandings() .  http_build_query($filters);
    }


    /**
     *  FIXTURES - ROUNDS
     */

    public function getRounds()
    {
        return '/rounds?';
    }

    /**
      * Get all available rounds from one {league} & {season}
      * get("https://v3.football.api-sports.io/rounds?league=39&season=2019");
      */
    public function getRoundsByLeagueAndSeason(int $league_id, int $season_id, bool $current_round=null): string
    {
        $filters = [
            'season' => $season_id, 
            'league' => $league_id
        ];
            
        if($current_round !== null) { 
            $filters['current'] = $current_round? 'true' : 'false'; 
        }

        return $this->getRounds() . http_build_query($filters);
    }

    /**
     *  FIXTURES - FIXTURES
     */

    public function getFixtures()
    {
        return '/fixtures?';
    }

    /**
     * // Get fixture from one fixture {id}
     * // In this request events, lineups, statistics fixture and players fixture are returned in the response
     * get("https://v3.football.api-sports.io/fixtures?id=215662");
     */
    public function getFixtureById(int $fixture_id): string
    {
        return $this->getFixtures() .  http_build_query(['id' => $fixture_id]);
    }

    /**
     * // Get all available fixtures in play
     * // In this request events are returned in the response
     * get("https://v3.football.api-sports.io/fixtures?live=all"); // 'all'
     */
    public function getAllLiveFixtures(): string
    {
        return $this->getFixtures() .  http_build_query(['live' => 'all']);
    }

    /**
     * // Get all available fixtures in play
     * // In this request events are returned in the response
     * get("https://v3.football.api-sports.io/fixtures?live=all"); //'all' or 'id-id-id'... (league ids) 
     */
    public function getLiveFixturesByLeagues(int ...$league_id): string
    {
        return $this->getFixtures() .  
            http_build_query([
                "live" => implode('-', $league_id)
            ])
        ;
    }

    /**
     * Get all available fixtures from one {league} & {season}
     * get("https://v3.football.api-sports.io/fixtures?league=39&season=2019");
     */
    public function getFixturesByLeagueAndSeason(int $league_id, int $season_id): string
    {
        return $this->getFixtures() . 
            http_build_query([
                'season' => $season_id, 
                'league' => $league_id
            ])
        ;
    }

    /**
     * Get all available fixtures from one {date}
     * get("https://v3.football.api-sports.io/fixtures?date=2019-10-22");
     */
    public function getFixturesByDate(string $date): string
    {
        return $this->getFixtures() .  http_build_query(['date' => $date]);
    }

    /**
     * Get next X available fixtures
     * get("https://v3.football.api-sports.io/fixtures?next=15");
     */
    public function getNextFixtures(int $next= 10): string
    {
        return $this->getFixtures() .  http_build_query(['next' => $next]);
    }

    /**
     * Get last X available fixtures
     * get("https://v3.football.api-sports.io/fixtures?last=15");
     */
    public function getLastFixtures(int $last= 10): string
    {
        return $this->getFixtures() .  http_build_query(['last' => $last]);
    }

    /**
     * // It’s possible to make requests by mixing the available parameters
     *   get("https://v3.football.api-sports.io/fixtures?date=2020-01-30&league=61&season=2019");
     *   get("https://v3.football.api-sports.io/fixtures?league=61&next=10");
     *   get("https://v3.football.api-sports.io/fixtures?league=61&last=10&status=ft");
     *   get("https://v3.football.api-sports.io/fixtures?team=85&last=10&timezone=Europe/london");
     *   get("https://v3.football.api-sports.io/fixtures?team=85&season=2019&from=2019-07-01&to=2020-10-31");
     *   get("https://v3.football.api-sports.io/fixtures?league=61&season=2019&from=2019-07-01&to=2020-10-31&timezone=Europe/london");
     *   get("https://v3.football.api-sports.io/fixtures?league=61&season=2019&round=Regular Season - 1");
     */
    public function getFixturesByMixedFilters(array $filters): string
    {
        $fixtures_mixed_filters = 
            array(
                'date' => null, 
                'league' => null, 
                'season' => null, 
                'next' => null, 
                'last' => null, 
                'team' => null, 
                'status' => null, 
                'timezone' => null, 
                'from' => null, 
                'to' => null,
                'round' => null
            )
        ;

        return $this->getFixtures(). 
            http_build_query(
                array_intersect_key($filters, $fixtures_mixed_filters)
            )
        ;
    }


    /**
     *  FIXTURES - HEAD TO HEAD
     */
    public function getFixturesH2H()
    {
        return '/fixtures/headtohead?';
    }

    /**
     * Get all head to head between two {team}
     * get("https://v3.football.api-sports.io/fixtures/headtohead?h2h=33-34");
     */
    public function getFixtureH2HByTeams(int $first_team_id, int $second_team_id): string
    {
        return $this->getFixturesH2H() . 
            http_build_query([
                'h2h' => $first_team_id . '-' . $second_team_id 
            ])
        ;
    }

    /**
     * // It’s possible to make requests by mixing the available parameters
     *   get("https://v3.football.api-sports.io/fixtures/headtohead?h2h=33-34");
     *   get("https://v3.football.api-sports.io/fixtures/headtohead?h2h=33-34&status=ns");
     *   get("https://v3.football.api-sports.io/fixtures/headtohead?h2h=33-34&from=2019-10-01&to=2019-10-31");
     *   get("https://v3.football.api-sports.io/fixtures/headtohead?date=2019-10-22&h2h=33-34");
     *   get("https://v3.football.api-sports.io/fixtures/headtohead?league=39&season=2019&h2h=33-34&last=5");
     *   get("https://v3.football.api-sports.io/fixtures/headtohead?league=39&season=2019&h2h=33-34&next=10&from=2019-10-01&to=2019-10-31");
     *   get("https://v3.football.api-sports.io/fixtures/headtohead?league=39&season=2019&h2h=33-34&last=5&timezone=Europe/London");
     *      
     *   Status:   
     *      TBD : Time To Be Defined
     *       NS : Not Started
     *       1H : First Half, Kick Off
     *       HT : Halftime
     *       2H : Second Half, 2nd Half Started
     *       ET : Extra Time
     *       P : Penalty In Progress
     *       FT : Match Finished
     *       AET : Match Finished After Extra Time
     *       PEN : Match Finished After Penalty
     *       BT : Break Time (in Extra Time)
     *       SUSP : Match Suspended
     *       INT : Match Interrupted
     *       PST : Match Postponed
     *       CANC : Match Cancelled
     *       ABD : Match Abandoned
     *       AWD : Technical Loss
     *       WO : WalkOver
     *       LIVE : In Progress 
     */
    public function getFixtureH2HByMixedFilters(array $filters): string
    {
        if(!$filters['h2h']){
            return '"h2h" filter is required for getFixtureH2HByMixedFilters()';
        }

        $fixtures_h2h_mixed_filters = 
            array(
                'h2h' => null, 
                'status' => null, 
                'from' => null, 
                'to' => null, 
                'date' => null, 
                'league' => null, 
                'last' => null, 
                'next' => null, 
                'timezone' => null, 
                'season' => null
            )
        ;

        return $this->getFixturesH2H(). 
            http_build_query(
                array_intersect_key($filters, $fixtures_h2h_mixed_filters)
            )
        ;
    }


    /**
     *  FIXTURES - STATISTICS
     */
    private function getFixtureStats()
    {
        return '/fixtures/statistics?';
    }

     /**
      * Get all available statistics from one {fixture} & {type}
      * get("https://v3.football.api-sports.io/fixtures/statistics?fixture=215662&type=Total Shots");
      */
    public function getFixtureStatsById(int $fixture_id, int $team_id = null, $type = null): string
    {
        $filters = [
            'fixture' => $fixture_id, 
        ];
            
        if($team_id) { 
            $filters['team'] = $team_id; 
        }
        if($type) { 
            $filters['type'] = $type; 
        }

        return $this->getFixtureStats() .  http_build_query($filters);
    }


    /**
     *  FIXTURES - EVENTS
     */

    public function getFixtureEvents()
    {
        return '/fixtures/events?';
    }

    /**
     * Get all available events from one {fixture}
     * get("https://v3.football.api-sports.io/fixtures/events?fixture=215662");
     */
    public function getFixtureEventsById(int $fixture_id): string
    {
        return $this->getFixtureEvents() .  http_build_query(['fixture' => $fixture_id]);
    }

    /**
     * Get all available events from one {fixture} & {team}
     * get("https://v3.football.api-sports.io/fixtures/events?fixture=215662&team=463");
     */
    public function getFixtureEventsByTeam(int $fixture_id, int $team_id): string
    {
        return $this->getFixtureEvents() .  
            http_build_query([
                'fixture' => $fixture_id,
                'team' => $team_id
            ])
        ;
    }

    /**
     * Get all available events from one {fixture} & {player}
     * get("https://v3.football.api-sports.io/fixtures/events?fixture=215662&player=35845");
     */
    public function getFixtureEventsByPlayer(int $fixture_id, int $player_id): string
    {
        return $this->getFixtureEvents() .  
            http_build_query([
                'fixture' => $fixture_id,
                'player' => $player_id
            ])
        ;
    }

    /**
     * Get all available events from one {fixture} & {type}
     * get("https://v3.football.api-sports.io/fixtures/events?fixture=215662&type=card");
     */
    public function getFixtureEventsByType(int $fixture_id, string $type = 'goal'):string
    {
        return $this->getFixtureEvents() .  
            http_build_query([
                'fixture' => $fixture_id,
                'type' => $type
            ])
        ;
    }

    /**
     * // It’s possible to make requests by mixing the available parameters
     * get("https://v3.football.api-sports.io/fixtures/events?fixture=215662&player=35845&type=card");
     * get("https://v3.football.api-sports.io/fixtures/events?fixture=215662&team=463&type=goal&player=35845");
     */
    public function getFixtureEventsByMixedFilters(array $filters): string
    {
        if(!$filters['fixture']){
            return '"fixture" filter is required for getFixtureEventsByMixedFilters()';
        }

        $fixture_events_mixed_filters = 
            array(
                'fixture' => null, 
                'player' => null, 
                'type' => null, 
                'team' => null
            )
        ;

        return $this->getFixtureEvents(). 
            http_build_query(
                array_intersect_key($filters, $fixture_events_mixed_filters)
            )
        ;
    }

  
    /**
     *  FIXTURES - LINEUPS
     */

    private function getFixtureLineups(): string
    {
        return '/fixtures/lineup?';
    }

    /**
     * Get all available lineups from one {fixture}
     * get("https://v3.football.api-sports.io/fixtures/lineups?fixture=592872");
     */
    public function getFixtureLineupsById(int $fixture_id): string
    {
        return $this->getFixtureLineups() .  http_build_query(['fixture' => $fixture_id]);
    }

    /**
     * Get all available lineups from one {fixture} & {team}
     * get("https://v3.football.api-sports.io/fixtures/lineups?fixture=592872&team=50");
     */
    public function getFixtureLineupsByTeam(int $fixture_id, int $team_id): string
    {
        return $this->getFixtureLineups() . 
            http_build_query([
                'fixture' => $fixture_id,
                'team' => $team_id
            ])
        ;
    }

    /**
     * Get all available lineups from one {fixture} & {player}
     * get("https://v3.football.api-sports.io/fixtures/lineups?fixture=215662&player=35845");
     */
    public function getFixtureLineupsEventsByPlayer(int $fixture_id, int $player_id): string
    {
        return $this->getFixtureLineups() . 
            http_build_query([
                'fixture' => $fixture_id,
                'player' => $player_id
            ])
        ;
    }

    /**
     * Get all available lineups from one {fixture} & {type}
     * get("https://v3.football.api-sports.io/fixtures/lineups?fixture=215662&type=startXI");
     */
    public function getFixtureLineupsEventsByType(int $fixture_id, string $type): string
    {
        return $this->getFixtureLineups() . 
            http_build_query([
                'fixture' => $fixture_id,
                'type' => $type
            ])
        ;
    }

    /**
     * It’s possible to make requests by mixing the available parameters
     * get("https://v3.football.api-sports.io/fixtures/lineups?fixture=215662&player=35845&type=startXI");
     * get("https://v3.football.api-sports.io/fixtures/lineups?fixture=215662&team=463&type=startXI&player=35845");
     * 
     * @param array $filters. $filters= array['fixture' => 1234, 'type' => 'Formation'];
     */
    public function getFixtureLineupsEventsByMixedFilters(array $filters): string
    {
        if(!$filters['fixture']){
            return '"fixture" filter is required for getFixtureLineupsEventsByMixedFilters()';
        }

        $fixture_lineups_mixed_filters = 
            array(
                'fixture' => null, 
                'player' => null, 
                'type' => null, 
                'team' => null
            )
        ;

        return $this->getFixtureEvents(). 
            http_build_query(
                array_intersect_key($filters, $fixture_lineups_mixed_filters)
            )
        ;
    }


    /**
     *  FIXTURES - PLAYERS STATS
     */

    public function getFixturePlayers()
    {
        return '/fixtures/players?';
    }

    /**
     * // Get all available players statistics from one {fixture} & {team}
     * get("https://v3.football.api-sports.io/fixtures/players?fixture=169080&team=2284");
     */
    public function getFixturePlayersStats(int $fixture_id, int $team_id = null): string
    {
        $filters = [
            'fixture' => $fixture_id, 
        ];
            
        if($team_id) { 
            $filters['team'] = $team_id; 
        }

        return $this->getFixturePlayers() .  http_build_query($filters);
    }


    /**
     *  INJURIES
     */
    public function getInjuries()
    {
        return '/injuries?';
    }

   
    /**
     * Get all available injuries from one {fixture}
     * get("https://v3.football.api-sports.io/injuries?fixture=686314");
     */
    public function getInjuriesByFixture(int $fixture_id): string
    {
        return $this->getInjuries() .  http_build_query(['fixture' => $fixture_id]);
    }

    /**
     *  Get all available injuries from one {league} & {season}
     * get("https://v3.football.api-sports.io/injuries?league=2&season=2020");
     */
    public function getInjuriesByLeagueAndSeason(int $league_id, int $season_id): string
    {
        return $this->getInjuries() .  
            http_build_query([
                'league' => $league_id,
                'season' => $season_id
            ])
        ;
    }
    
    /**
     * Get all available injuries from one {team} & {season}
     * get("https://v3.football.api-sports.io/injuries?team=85&season=2020");
     */
    public function getInjuriesByTeam(int $team_id, int $season_id = null): string
    {
        $filters = [
            'team' => $team_id, 
        ];
            
        if($season_id) { 
            $filters['season'] = $season_id; 
        }

        return $this->getInjuries() .  http_build_query($filters);
    }

    /** 
     * Get all available injuries from one {player} & {season}
     * get("https://v3.football.api-sports.io/injuries?player=865&season=2020");
     * */ 
    public function getInjuriesByPlayer(int $player_id, int $season_id = null): string
    {
        $filters = [
            'player' => $player_id, 
        ];

        if($season_id) { 
            $filters['season'] = $season_id; 
        }

        return $this->getInjuries() .  http_build_query($filters);
    }

    /**
     * Get all available injuries from one {date}
     * get("https://v3.football.api-sports.io/injuries?date=2021-04-07");
     */
    public function getInjuriesByDate(string $date): string
    {
        return $this->getInjuries() .  http_build_query(['date' => $date]);
    }

    /**
     * It’s possible to make requests by mixing the available parameters
     *   get("https://v3.football.api-sports.io/injuries?league=2&season=2020&team=85");
     *   get("https://v3.football.api-sports.io/injuries?league=2&season=2020&player=865");
     *   get("https://v3.football.api-sports.io/injuries?date=2021-04-07&timezone=Europe/London&team=85");
     *   get("https://v3.football.api-sports.io/injuries?date=2021-04-07&league=61");
     */
    public function getInjuriesByMixedFilters(array $filters): string
    {
        $injuries_mixed_filters = 
            array(
                'league' => null, 
                'season' => null, 
                'fixture' => null, 
                'team' => null,
                'player' => null,
                'date' => null,
                'timezone' => null
            )
        ;

        return $this->getInjuries(). 
            http_build_query(
                array_intersect_key($filters, $injuries_mixed_filters)
            )
        ;
    }



    /**
     *  PREDICTIONS
     */

    /**
     * Private because fixture is required for Predictions.
     */
    private function  getPredictions()
    {
        return '/predictions?';
    }

    /**
     * Get all available predictions from one {fixture}
     * get("https://v3.football.api-sports.io/predictions?fixture=198772");
     */
    public function getPredictionsByFixture(int $fixture_id): string
    {
        return $this->getPredictions() .  http_build_query(['fixture' => $fixture_id]);
    }


    /**
     *  COACHS
     */

    public function getCoachs()
    {
        return '/coachs?';
    }

    /**
     * Get coachs from one coach {id}
     * get("https://v3.football.api-sports.io/coachs?id=1");
     */
    public function getCoachById(int $coach_id): string
    {
        return $this->getCoachs().  http_build_query(['id' => $coach_id]);   
    }
      
    /**
     * Get coachs from one {team}
     * get("https://v3.football.api-sports.io/coachs?team=33");
     */
    public function getCoachsByTeam(int $team_id): string
    {
        return $this->getCoachs().  http_build_query(['team' => $team_id]);
    }

    /**
     * Allows you to search for a coach in relation to a coach {name}
     * get("https://v3.football.api-sports.io/coachs?search=Klopp");
     */
    public function getCoachBySearch(string $coach_name): string
    {
        return $this->getCoachs().  http_build_query(['search' => $coach_name]);
    }


    /**
     *  PLAYERS - SEASONS
     */

    /**
     * Get all seasons available for players endpoint
     * get("https://v3.football.api-sports.io/players/seasons");
     */
    public function getPlayersSeasons(): string
    {
        return '/players/seasons?';
    }

    /**
     * Get all seasons available for a player {id}
     * get("https://v3.football.api-sports.io/players/seasons?player=276");
     */
    public function getPlayerSeasonsById(int $player_id): string
    {
        return $this->getPlayersSeasons().  http_build_query(['player' => $player_id]);
    }


    /**
     *  PLAYERS - PLAYERS
     */

    private function getPlayers()
    {
        return '/players?';
    }
    
    /**
     * Get all players statistics from one player {id} & {season}
     * get("https://v3.football.api-sports.io/players?id=19088&season=2018");
     */
    public function getPlayerById(int $player_id, int $season_id = null): string
    {
        $filters = [
            'id' => $player_id, 
        ];
            
        if($season_id) { 
            $filters['season'] = $season_id; 
        }

        return $this->getPlayers() .  http_build_query($filters);
    }

    /**
     * Get all players statistics from one {team} & {season}
     * get("https://v3.football.api-sports.io/players?season=2018&team=33&page=2");
     */
    public function getPlayersByTeam(int $team_id, int $season_id, int $page = null): string
    {
        $filters = [
            'team' => $team_id,
            'season' => $season_id, 
        ];
            
        if($page) { 
            $filters['page'] = $page; 
        }

        return $this->getPlayers() .  http_build_query($filters);
    }

    /**
     * Get all players statistics from one {league} & {season}
     * get("https://v3.football.api-sports.io/players?season=2018&league=61");
     * get("https://v3.football.api-sports.io/players?season=2018&league=61&page=4");
     */
    public function getPlayersByLeagueAndSeason(int $league_id, int $season_id, $page = null): string
    {
        $filters = [
            'league' => $league_id,
            'season' => $season_id, 
        ];
            
        if($page) { 
            $filters['page'] = $page; 
        }

        return $this->getPlayers() .  http_build_query($filters);
    }

    /**
     * Allows you to search for a player in relation to a player {name}
     * get("https://v3.football.api-sports.io/players?team=85&search=cavani");
     * get("https://v3.football.api-sports.io/players?league=61&search=cavani");
     * get("https://v3.football.api-sports.io/players?team=85&search=cavani&season=2018");
     */
    public function getPlayersByMixedFilters(array $filters): string
    {
        $players_mixed_filters = 
            array(
                'id' => null, 
                'team' => null, 
                'league' => null, 
                'season' => null,
                'search' => null,
                'page' => null,
            )
        ;

        return $this->getPlayers(). 
            http_build_query(
                array_intersect_key($filters, $players_mixed_filters)
            )
        ;
    }


    /**
     *  PLAYERS - SQUADS
     */

    private function getSquads(): string
    {
        return '/squads?';
    }

    /**
     * Get all players from one {team}
     * get("https://v3.football.api-sports.io/squads?team=33");
     */
    public function getPlayersSquadsByTeam(int $team_id): string
    {
        return $this->getSquads().  http_build_query(['team' => $team_id]);
    }

    /**
     * Get all teams from one {player}
     * get("https://v3.football.api-sports.io/squads?player=276");
     */
    public function getPlayerTeams(int $player_id): string
    {
        return $this->getSquads().  http_build_query(['player' => $player_id]);
    }


    /**
     *  PLAYERS - TOP SCORERS
     */
    public function getTopScorersByLeagueAndSeason(int $league_id, int $season_id): string
    {
        $filters = [
            'league' => $league_id,
            'season' => $season_id, 
        ];

        return '/players/topscorers?' .  http_build_query($filters);
    }

    /**
     *  PLAYERS - TOP ASSISTS
     */
    public function getTopAssistsByLeagueAndSeason(int $league_id, int $season_id): string
    {
        $filters = [
            'league' => $league_id,
            'season' => $season_id, 
        ];

        return '/players/topassists?' .  http_build_query($filters);
    }

    /**
     *  PLAYERS - TOP YELLOW CARD
     */
    public function getTopYellowCardsByLeagueAndSeason(int $league_id, int $season_id): string
    {
        $filters = [
            'league' => $league_id,
            'season' => $season_id, 
        ];

        return '/players/topyellowcards?' .  http_build_query($filters);
    }

    /**
     *  PLAYERS - TOP RED CARDS
     */
    public function getTopRedCardsByLeagueAndSeason(int $league_id, int $season_id): string
    {
        return '/players/topredcards?' .  
            http_build_query([
                'league' => $league_id,
                'season' => $season_id, 
            ])
        ;
    }



    /**
     *  TRANSFERTS
     */

    private function getTransferts(): string
    {
        return '/transfers?';
    }

    /**
     * Get all transfers from one {player}
     * get("https://v3.football.api-sports.io/transfers?player=35845");
     */
    public function getTransfertsByPlayer(int $player_id): string
    {
        return $this->getTransferts().  http_build_query(['player' => $player_id]);
    }

    /**
     * Get all transfers from one {team}
     * get("https://v3.football.api-sports.io/transfers?team=463");
     */
    public function getTransfertsByTeam(int $team_id): string
    {
        return $this->getTransferts().  http_build_query(['team' => $team_id]);
    }


    /**
     *  TROPHIES
     */

    private function getTrophies(): string
    {
        return '/trophies?';
    }

     /**
      * Get all trophies from one {player}
      * get("https://v3.football.api-sports.io/trophies?player=276");
      */
    public function getTrophiesByPlayer(int $player_id): string
    {
        return $this->getTrophies().  http_build_query(['player' => $player_id]);
    }

    /**
     * Get all trophies from one {coach}
     * get("https://v3.football.api-sports.io/trophies?coach=2");
     */
    public function getTrophiesByCoach(int $coach_id): string
    {
        return $this->getTrophies().  http_build_query(['coach' => $coach_id]);
    }


    /**
     *  SIDELINES
     */

    private function getSidelined(): string
    {
        return '/sidelined?';
    }

    /**
     * Get all from one {player}
     * get("https://v3.football.api-sports.io/sidelined?player=276");
     */
    public function getSidelinesByPlayer(int $player_id): string
    {
        return $this->getSidelined().  http_build_query(['player' => $player_id]);
    }

    /**
     * Get all from one {coach}
     * get("https://v3.football.api-sports.io/sidelined?coach=2");
     */
    public function getSidelinesByCoach(int $coach_id): string
    {
        return $this->getSidelined().  http_build_query(['coach' => $coach_id]);
    }


    /**
     *  ODDS
     */

    private function getOdds(): string
    {
        return '/odds?';
    }

    /**
     * Get all available odds from one {fixture}
     * get("https://v3.football.api-sports.io/odds?fixture=164327");
     */
    public function getOddsByFixture(int $fixture_id): string
    {
        return $this->getOdds().  http_build_query(['fixture' => $fixture_id]);
    }

    /**
     * Get all available odds from one {league} & {season}
     * get("https://v3.football.api-sports.io/odds?league=39&season=2019");
     */
    public function getOddsByLeagueAndSeason(int $league_id, int $season_id): string
    {
        return $this->getOdds() .  
            http_build_query([
                'league' => $league_id,
                'season' => $season_id, 
            ])
        ;
    }

    /**
     * Get all available odds from one {date}
     * get("https://v3.football.api-sports.io/odds?date=2020-05-15");
     */
    public function getOddsByDate(string $date): string
    {
        return $this->getOdds().  http_build_query(['date' => $date]);
    }

    /**
     * It’s possible to make requests by mixing the available parameters
     * get("https://v3.football.api-sports.io/odds?bookmaker=1&bet=4&league=39&season=2019");
     * get("https://v3.football.api-sports.io/odds?bet=4&fixture=164327");
     * get("https://v3.football.api-sports.io/odds?bookmaker=1&league=39&season=2019");
     * get("https://v3.football.api-sports.io/odds?date=2020-05-15&page=2&bet=4");
     */
    public function getOddsByMixedFilters(array $filters): string
    {
        $odds_mixed_filters = 
            array(
                'fixture' => null, 
                'league' => null, 
                'season' => null, 
                'date' => null,
                'timezone' => null,
                'page' => null,
                'bookmaker' => null,
                'bet' => null
            )
        ;

        return $this->getOdds(). 
            http_build_query(
                array_intersect_key($filters, $odds_mixed_filters)
            )
        ;
    }



    /**
     *  MAPPING
     */
    public function getOddsMapping(int $page = null): string
    {
        if($page) { 
            $filters['page'] = $page; 
        }
        
        return '/odds/mapping?' . http_build_query($filters);
    }


    /**
     *  BOOKMAKERS
     */

    public function getBookmakers(): string
    {
        return '/odds/bookmakers?';
    }

    /**
     * Get all available bookmakers
     * get("https://v3.football.api-sports.io/odds/bookmakers?id=1");
     */
    public function getBookmakersById(int $bookmaker_id): string
    {
        return $this->getBookmakers() . http_build_query(['id' => $bookmaker_id]);
    }

    /**
     * Allows you to search for a bookmaker in relation to a bookmakers {name}
     * get("https://v3.football.api-sports.io/odds/bookmakers?search=Betfair");
     */
    public function getBookmakerBySearch(string $bookmaker_name): string
    {
        return $this->getBookmakers().  http_build_query(['search' => $bookmaker_name]);
    }


    /**
     *  BETS
     */
    public function getBets(): string
    {
        return '/odds/bets?';
    }
    
    /**
     * Get all available bets
     * get("https://v3.football.api-sports.io/odds/bets?id=1");
     */
    public function getBetsById(int $bet_id): string
    {
        return $this->getBets().  http_build_query(['id' => $bet_id]);
    }

    /**
     * Allows you to search for a bet in relation to a bets {name}
     * get("https://v3.football.api-sports.io/odds/bets?search=winner");
     */
    public function getBetBySearch(string $bet_name): string
    {
        return $this->getBets().  http_build_query(['search' => $bet_name]);
    }


    /**
     *  TIMEZONE
     */

    public function getTimezone(): string
    {
        return '/timezone';
    }

}