<?php

namespace App\Contracts;

interface SoccerDataApiInterface
{

  //private $auth_key;
  //private $auth_value;

/*
  function __construct(App $app)
  {
      $this->app = $app;
  }
*/
  public function __construct(array $provider);

  public function getAuthKeys(): array;

      /**
     *  COUNTRIES 
    */ 
    public function getCountries(): string;

    public function getCountryByName(string $english_name): string;
    public function getCountryByCode(string $code): string;
    public function getCountryBySearch(string $search): string;

    // https://media.api-sports.io/flags/{country_code}.svg
    public function getCountryFlag(string $country_code): string;


    /**
     *  SEASONS 
    */ 
    public function getSeasons(): string;

    /** get("https://v3.football.api-sports.io/leagues?id=39"); */
    public function getSeasonsByLeague(int $league_id): string;


    /**
     *  LEAGUES 
    */ 

    /**get("https://v3.football.api-sports.io/leagues"); */ 
    public function getLeagues(): string;

    /** get("https://v3.football.api-sports.io/leagues?id=39"); -- SAME AS getSeasonsByLeague() */
    public function getLeagueById(int $league_id): string;

    /** get("https://v3.football.api-sports.io/leagues?name= premier league"); */
    public function getLeaguesByName(string $english_league_name): string;

    /** get("https://v3.football.api-sports.io/leagues?country=england"); */
    public function getLeaguesByCountry(string $english_country_name): string;

    /** get("https://v3.football.api-sports.io/leagues?code=gb"); */
    public function getLeaguesByCountryCode(string $country_code): string;

    /** get("https://v3.football.api-sports.io/leagues?season=2021"); */
    public function getLeaguesBySeason(int $season_id): string;
    
    /** get("https://v3.football.api-sports.io/leagues?season=2021&id=39"); */
    public function getLeagueBySeasonAndId(int $season_id, int $league_id): string;

    // Get all leagues in which the {team} has played at least one match
    /** get("https://v3.football.api-sports.io/leagues?team=33"); */
    public function getLeaguesByTeamId(int $team_id): string;

    // Allows you to search for a league in relation to a league {name} or {country}
    /** get("https://v3.football.api-sports.io/leagues?search=premier league");  */
    /**
     * @param string $search is a league name or a country name
     */
    public function getLeagueBySearch(string $search): string;

    /**
     * // Get all leagues from one {type}
     * get("https://v3.football.api-sports.io/leagues?type=league");
     */
    public function getLeaguesByType(string $competition_type): string;

    /**
     * // Get all leagues where the season is in progress or not
     * get("https://v3.football.api-sports.io/leagues?current=true");
     */
    public function getLeaguesByStatus(bool $status): string;

    /**
     * // Get the last 99 leagues or cups added to the API
     * get("https://v3.football.api-sports.io/leagues?last=99");
     */
    public function getLatestLeaguesAdded(int $latest): string;

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
    public function getLeaguesByMixedFilters(array $filters): string;

    /**https://media.api-sports.io/football/leagues/{league_id}.png */
    public function getLeagueLogo(int $league_id): string;


    /**
     *  TEAMS 
     */
    
     /**
       * // Get one team from one team {id}
       * get("https://v3.football.api-sports.io/teams?id=33");
     */
    public function getTeamById(int $team_id): string;

    /** 
      * // Get one team from one team {name}
      * get("https://v3.football.api-sports.io/teams?name=manchester united");
      */
    public function getTeamByName(string $english_team_name): string;

    /** 
      * // Get all teams from one {league} & {season}
      * get("https://v3.football.api-sports.io/teams?league=39&season=2019");
      */
    public function getTeamsByLeagueAndSeason(int $league_id, int $season_id): string;

    /**
     *  Get teams from one team {country}
     * get("https://v3.football.api-sports.io/teams?country=england");
     */
    public function getTeamsByCountry(string $english_country_name): string;

    /**
     * Allows you to search for a team in relation to a team {name} or {country}
     * get("https://v3.football.api-sports.io/teams?search=manches");
     * get("https://v3.football.api-sports.io/teams?search=England");
     * 
     * @param string $search is a portion of team name or country
     */
    public function getTeamsBySearch(string $search): string;
    
    /**
     * https://media.api-sports.io/football/teams/{team_id}.png
     */
    public function getTeamLogo(int $team_id): string;


    /**
     *  //Get all statistics for a {team} in a {league} & {season} with a end {date}
     * get("https://v3.football.api-sports.io/teams/statistics?league=39&team=33&season=2019&date=2019-10-08");
     */
    public function getTeamStatisticsByLeagueAndSeason(int $team_id, int $league_id, int $season_id, string $date=null): string;

    /**
     * // Get all seasons available for a team from one team {id}
     * get("https://v3.football.api-sports.io/teams/seasons?team=33");
     */
    public function getTeamSeasons(int $team_id): string;


    /**
     *  VENUES 
     */

    /** 
     * Get one venue from venue {id}
     * get("https://v3.football.api-sports.io/venues?id=556");
    */
    public function getVenueById(int $venue_id): string;

    /**
     * Get one venue from venue {name}
     * get("https://v3.football.api-sports.io/venues?name=Old Trafford");
     */
    public function getVenueByName(string $english_venue_name): string;

    /**
     * Get all venues from {city}
     * get("https://v3.football.api-sports.io/venues?city=manchester");
     */
    public function getVenuesByCity(string $english_city_name): string;

    /**
     * Get venues from {country}
     * get("https://v3.football.api-sports.io/venues?country=england");
     */
    public function getVenuesByCountry(string $english_country_name): string;

    /**
     * // Allows you to search for a venues in relation to a venue {name}, {city} or {country}
     * get("https://v3.football.api-sports.io/venues?search=trafford");
     * get("https://v3.football.api-sports.io/venues?search=manches");
     * get("https://v3.football.api-sports.io/venues?search=England");
     */
    public function getVenuesBySearch(string $search): string;

    /**
     * https://media.api-sports.io/football/venues/{venue_id}.png
     */
    public function getVenueLogo(int $venue_id): string; 


    /**
     *  STANDINGS 
     */

     /**
      * Get all Standings from one {league} & {season}
      * get("https://v3.football.api-sports.io/standings?league=39&season=2019");
      */
    public function getStandingsByLeagueAndSeason(int $season_id, int $league_id): string;

    /**
     * Get all Standings from one {team} & {season}
     * get("https://v3.football.api-sports.io/standings?team=33&season=2019");
     */
    public function getTeamStandingsBySeason(int $team_id, int $season_id, int $league_id=null): string;
    

    /**
     *  FIXTURES - ROUNDS
     */

    /**
      * Get all available rounds from one {league} & {season}
      * get("https://v3.football.api-sports.io/rounds?league=39&season=2019");
      */
    public function getRoundsByLeagueAndSeason(int $league_id, int $season_id, bool $current_round=true): string;

    /**
     *  FIXTURES - FIXTURES
     */

    /**
     * // Get fixture from one fixture {id}
     * // In this request events, lineups, statistics fixture and players fixture are returned in the response
     * get("https://v3.football.api-sports.io/fixtures?id=215662");
     */
    public function getFixtureById(int $fixture_id): string;

    /**
     * // Get all available fixtures in play
     * // In this request events are returned in the response
     * get("https://v3.football.api-sports.io/fixtures?live=all"); // 'all' or 'id-id-id'... (league ids) 
     */
    public function getAllLiveFixtures(): string;

    /**
     * // Get all available fixtures in play
     * // In this request events are returned in the response
     * get("https://v3.football.api-sports.io/fixtures?live=all"); // 'all' or 'id-id-id'... (league ids) 
     */
    public function getLiveFixturesByLeagues(int ...$league_id): string;

    /**
     * Get all available fixtures from one {league} & {season}
     * get("https://v3.football.api-sports.io/fixtures?league=39&season=2019");
     */
    public function getFixturesByLeagueAndSeason(int $league_id, int $season_id): string;

    /**
     * Get all available fixtures from one {date}
     * get("https://v3.football.api-sports.io/fixtures?date=2019-10-22");
     */
    public function getFixturesByDate(string $date): string;

    /**
     * Get next X available fixtures
     * get("https://v3.football.api-sports.io/fixtures?next=15");
     */
    public function getNextFixtures(int $next= 10): string;

    /**
     * Get last X available fixtures
     * get("https://v3.football.api-sports.io/fixtures?last=15");
     */
    public function getLastFixtures(int $last= 10): string;

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
    public function getFixturesByMixedFilters(array $filters): string;


    /**
     *  FIXTURES - HEAD TO HEAD
     */

    /**
     * Get all head to head between two {team}
     * get("https://v3.football.api-sports.io/fixtures/headtohead?h2h=33-34");
     */
    public function getFixtureH2HByTeams(int $first_team_id, int $second_team_id): string;

    /**
     * // It’s possible to make requests by mixing the available parameters
     *   get("https://v3.football.api-sports.io/fixtures/headtohead?h2h=33-34");
     *   get("https://v3.football.api-sports.io/fixtures/headtohead?h2h=33-34&status=ns");
     *   get("https://v3.football.api-sports.io/fixtures/headtohead?h2h=33-34&from=2019-10-01&to=2019-10-31");
     *   get("https://v3.football.api-sports.io/fixtures/headtohead?date=2019-10-22&h2h=33-34");
     *   get("https://v3.football.api-sports.io/fixtures/headtohead?league=39&season=2019&h2h=33-34&last=5");
     *   get("https://v3.football.api-sports.io/fixtures/headtohead?league=39&season=2019&h2h=33-34&next=10&from=2019-10-01&to=2019-10-31");
     *   get("https://v3.football.api-sports.io/fixtures/headtohead?league=39&season=2019&h2h=33-34&last=5&timezone=Europe/London");
     */
    public function getFixtureH2HByMixedFilters(array $filters): string;


    /**
     *  FIXTURES - STATISTICS
     */

     /**
      * Get all available statistics from one {fixture} & {type}
      * get("https://v3.football.api-sports.io/fixtures/statistics?fixture=215662&type=Total Shots");
      */
    public function getFixtureStatsById(int $fixture_id, int $team_id = null, $type = null): string;


    /**
     *  FIXTURES - EVENTS
     */

    /**
     * Get all available events from one {fixture}
     * get("https://v3.football.api-sports.io/fixtures/events?fixture=215662");
     */
    public function getFixtureEventsById(int $fixture_id): string;

    /**
     * Get all available events from one {fixture} & {team}
     * get("https://v3.football.api-sports.io/fixtures/events?fixture=215662&team=463");
     */
    public function getFixtureEventsByTeam(int $fixture_id, int $team_id): string;

    /**
     * Get all available events from one {fixture} & {player}
     * get("https://v3.football.api-sports.io/fixtures/events?fixture=215662&player=35845");
     */
    public function getFixtureEventsByPlayer(int $fixture_id, int $player_id): string;

    /**
     * Get all available events from one {fixture} & {type}
     * get("https://v3.football.api-sports.io/fixtures/events?fixture=215662&type=card");
     */
    public function getFixtureEventsByType(int $fixture_id, string $type = 'goal'): string;

    /**
     * // It’s possible to make requests by mixing the available parameters
     * get("https://v3.football.api-sports.io/fixtures/events?fixture=215662&player=35845&type=card");
     * get("https://v3.football.api-sports.io/fixtures/events?fixture=215662&team=463&type=goal&player=35845");
     */
    public function getFixtureEventsByMixedFilters(array $filters): string;

  
    /**
     *  FIXTURES - LINEUPS
     */

    /**
     * Get all available lineups from one {fixture}
     * get("https://v3.football.api-sports.io/fixtures/lineups?fixture=592872");
     */
    public function getFixtureLineupsById(int $fixture_id): string;

    /**
     * Get all available lineups from one {fixture} & {team}
     * get("https://v3.football.api-sports.io/fixtures/lineups?fixture=592872&team=50");
     */
    public function getFixtureLineupsByTeam(int $fixture_id, int $team_id): string;

    /**
     * Get all available lineups from one {fixture} & {player}
     * get("https://v3.football.api-sports.io/fixtures/lineups?fixture=215662&player=35845");
     */
    public function getFixtureLineupsEventsByPlayer(int $fixture_id, int $player_id): string;

    /**
     * Get all available lineups from one {fixture} & {type}
     * get("https://v3.football.api-sports.io/fixtures/lineups?fixture=215662&type=startXI");
     */
    public function getFixtureLineupsEventsByType(int $fixture_id, string $type): string;

    /**
     * It’s possible to make requests by mixing the available parameters
     * get("https://v3.football.api-sports.io/fixtures/lineups?fixture=215662&player=35845&type=startXI");
     * get("https://v3.football.api-sports.io/fixtures/lineups?fixture=215662&team=463&type=startXI&player=35845");
     */
    public function getFixtureLineupsEventsByMixedFilters(array $filters): string;


    /**
     *  FIXTURES - PLAYERS STATS
     */

    /**
     * // Get all available players statistics from one {fixture} & {team}
     * get("https://v3.football.api-sports.io/fixtures/players?fixture=169080&team=2284");
     */
    public function getFixturePlayersStats(int $fixture_id, int $team_id = null): string;


    /**
     *  INJURIES
     */
   
    /**
     * Get all available injuries from one {fixture}
     * get("https://v3.football.api-sports.io/injuries?fixture=686314");
     */
    public function getInjuriesByFixture(int $fixture_id): string;

    /**
     *  Get all available injuries from one {league} & {season}
     * get("https://v3.football.api-sports.io/injuries?league=2&season=2020");
     */
    public function getInjuriesByLeagueAndSeason(int $league_id, int $season_id): string;
    
    /**
     * Get all available injuries from one {team} & {season}
     * get("https://v3.football.api-sports.io/injuries?team=85&season=2020");
     */
    public function getInjuriesByTeam(int $team_id, int $season_id = null): string;

    /** 
     * Get all available injuries from one {player} & {season}
     * get("https://v3.football.api-sports.io/injuries?player=865&season=2020");
     * */ 
    public function getInjuriesByPlayer(int $player_id, int $season_id = null): string;

    /**
     * Get all available injuries from one {date}
     * get("https://v3.football.api-sports.io/injuries?date=2021-04-07");
     */
    public function getInjuriesByDate(string $date): string;

    /**
     * It’s possible to make requests by mixing the available parameters
     *   get("https://v3.football.api-sports.io/injuries?league=2&season=2020&team=85");
     *   get("https://v3.football.api-sports.io/injuries?league=2&season=2020&player=865");
     *   get("https://v3.football.api-sports.io/injuries?date=2021-04-07&timezone=Europe/London&team=85");
     *   get("https://v3.football.api-sports.io/injuries?date=2021-04-07&league=61");
     */
    public function getInjuriesByMixedFilters(array $filters): string;



    /**
     *  PREDICTIONS
     */

    /**
     * Get all available predictions from one {fixture}
     * get("https://v3.football.api-sports.io/predictions?fixture=198772");
     */
    public function getPredictionsByFixture(int $fixture_id): string;



    /**
     *  COACHS
     */

    /**
     * Get coachs from one coach {id}
     * get("https://v3.football.api-sports.io/coachs?id=1");
     */
    public function getCoachById(int $coach_id): string;
      
    /**
     * Get coachs from one {team}
     * get("https://v3.football.api-sports.io/coachs?team=33");
     */
    public function getCoachsByTeam(int $team_id): string;

    /**
     * Allows you to search for a coach in relation to a coach {name}
     * get("https://v3.football.api-sports.io/coachs?search=Klopp");
     */
    public function getCoachBySearch(string $coach_name): string;


    /**
     *  PLAYERS - SEASONS
     */

    /**
     * Get all seasons available for players endpoint
     * get("https://v3.football.api-sports.io/players/seasons");
     */
    public function getPlayersSeasons(): string;

    /**
     * Get all seasons available for a player {id}
     * get("https://v3.football.api-sports.io/players/seasons?player=276");
     */
    public function getPlayerSeasonsById(int $player_id): string;


    /**
     *  PLAYERS - PLAYERS
     */
    
    /**
     * Get all players statistics from one player {id} & {season}
     * get("https://v3.football.api-sports.io/players?id=19088&season=2018");
     */
    public function getPlayerById(int $player_id, int $season_id = null): string;

    /**
     * Get all players statistics from one {team} & {season}
     * get("https://v3.football.api-sports.io/players?season=2018&team=33&page=2");
     */
    public function getPlayersByTeam(int $team_id, int $season_id, int $page = null): string;

    /**
     * Get all players statistics from one {league} & {season}
     * get("https://v3.football.api-sports.io/players?season=2018&league=61");
     * get("https://v3.football.api-sports.io/players?season=2018&league=61&page=4");
     */
    public function getPlayersByLeagueAndSeason(int $league_id, int $season_id, $page = null): string;

    /**
     * Allows you to search for a player in relation to a player {name}
     * get("https://v3.football.api-sports.io/players?team=85&search=cavani");
     * get("https://v3.football.api-sports.io/players?league=61&search=cavani");
     * get("https://v3.football.api-sports.io/players?team=85&search=cavani&season=2018");
     */
    public function getPlayersByMixedFilters(array $filters): string;


    /**
     *  PLAYERS - SQUADS
     */

    /**
     * Get all players from one {team}
     * get("https://v3.football.api-sports.io/squads?team=33");
     */
    public function getPlayersSquadsByTeam(int $team_id): string;

    /**
     * Get all teams from one {player}
     * get("https://v3.football.api-sports.io/squads?player=276");
     */
    public function getPlayerTeams(int $player_id): string;


    /**
     *  PLAYERS - TOP SCORERS
     */
    public function getTopScorersByLeagueAndSeason(int $league_id, int $season_id): string;

    /**
     *  PLAYERS - TOP ASSISTS
     */
    public function getTopAssistsByLeagueAndSeason(int $league_id, int $season_id): string;

    /**
     *  PLAYERS - TOP YELLOW CARD
     */
    public function getTopYellowCardsByLeagueAndSeason(int $league_id, int $season_id): string;

    /**
     *  PLAYERS - TOP RED CARDS
     */
    public function getTopRedCardsByLeagueAndSeason(int $league_id, int $season_id): string;



    /**
     *  TRANSFERTS
     */

    /**
     * Get all transfers from one {player}
     * get("https://v3.football.api-sports.io/transfers?player=35845");
     */
    public function getTransfertsByPlayer(int $player_id): string;

    /**
     * Get all transfers from one {team}
     * get("https://v3.football.api-sports.io/transfers?team=463");
     */
    public function getTransfertsByTeam(int $team_id): string;




    /**
     *  TROPHIES
     */

     /**
      * Get all trophies from one {player}
      * get("https://v3.football.api-sports.io/trophies?player=276");
      */
    public function getTrophiesByPlayer(int $player_id): string;

    /**
     * Get all trophies from one {coach}
     * get("https://v3.football.api-sports.io/trophies?coach=2");
     */
    public function getTrophiesByCoach(int $coach_id): string;


    /**
     *  SIDELINES
     */

    /**
     * Get all from one {player}
     * get("https://v3.football.api-sports.io/sidelined?player=276");
     */
    public function getSidelinesByPlayer(int $player_id): string;

    /**
     * Get all from one {coach}
     * get("https://v3.football.api-sports.io/sidelined?coach=2");
     */
    public function getSidelinesByCoach(int $coach_id): string;


    /**
     *  ODDS
     */

    /**
     * Get all available odds from one {fixture}
     * get("https://v3.football.api-sports.io/odds?fixture=164327");
     */
    public function getOddsByFixture(int $fixture_id): string;

    /**
     * Get all available odds from one {league} & {season}
     * get("https://v3.football.api-sports.io/odds?league=39&season=2019");
     */
    public function getOddsByLeagueAndSeason(int $league_id, int $season_id): string;

    /**
     * Get all available odds from one {date}
     * get("https://v3.football.api-sports.io/odds?date=2020-05-15");
     */
    public function getOddsByDate(string $date): string;

    /**
     * It’s possible to make requests by mixing the available parameters
     * get("https://v3.football.api-sports.io/odds?bookmaker=1&bet=4&league=39&season=2019");
     * get("https://v3.football.api-sports.io/odds?bet=4&fixture=164327");
     * get("https://v3.football.api-sports.io/odds?bookmaker=1&league=39&season=2019");
     * get("https://v3.football.api-sports.io/odds?date=2020-05-15&page=2&bet=4");
     */
    public function getOddsByMixedFilters(array $filters): string;



    /**
     *  MAPPING
     */
    public function getOddsMapping(int $page = null): string;


    /**
     *  BOOKMAKERS
     */

    public function getBookmakers(): string;

    /**
     * Get all available bookmakers
     * get("https://v3.football.api-sports.io/odds/bookmakers?id=1");
     */
    public function getBookmakersById(int $bookmaker_id): string;

    /**
     * Allows you to search for a bookmaker in relation to a bookmakers {name}
     * get("https://v3.football.api-sports.io/odds/bookmakers?search=Betfair");
     */
    public function getBookmakerBySearch(string $bookmaker_name): string;


    /**
     *  BETS
     */

    public function getBets(): string;

    /**
     * Get all available bets
     * get("https://v3.football.api-sports.io/odds/bets");
     */
    public function getBetsById(int $bet_id): string;

    /**
     * Allows you to search for a bet in relation to a bets {name}
     * get("https://v3.football.api-sports.io/odds/bets?search=winner");
     */
    public function getBetBySearch(string $search): string;


    /**
     *  TIMEZONE
     */

    public function getTimezone(): string;

}