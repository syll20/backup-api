<x-app-layout>
    <x-slot name="header">
        <x-layout.sub-navigation.title title="Create a template : ">
            <x-layout.sub-navigation.link href="{{route('template_lists')}}" name="All" />
            <x-layout.sub-navigation.link href="{{route('template_create')}}" name="Create a template" />
        </x-layout-subnavigation.title>
    </x-slot>
        <x-layout.main>
            <!-- This example requires Tailwind CSS v2.0+ -->
            <div class="col-span-2 flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="text-left mb-4 bg-red-500">

                        @if ($errors->any())
                            <div class="alert alert-danger text-black">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        </div>
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg bg-white">
                        @if(isset($template))
                        <textarea class="w-full" rows=80 id="label">
                            {{ $template }}
                        </textarea>
                        @endif
                        <form method="POST" action="/admin/generate">
                            @csrf
                            <input type=hidden name="team" value="94" />
                            <select name="date" id="game_date" required>
                                @if(isset($next_games))
                                    @foreach($next_games as $next_game)
                                        <option value="{{ Str::subStr($next_game->kickoff, 0, 10) }}">
                                            [{{ $next_game->label }}
                                            -
                                            ({{ $next_game->id}})]

                                            {{ $next_game->kickoff }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            <input type="submit" value="{{ __('Submit') }}" class="bg-red-500 text-black px-4 py-4" />
                            <div class="relative grid grid-cols-4 bg-white gap-6">
                                
                                <div><input type="checkbox" name="placeholders[]" value="competition" checked /> %competition</div>
                                <div><input type="checkbox" name="placeholders[]" value="round" checked /> %round</div>
                                <div><input type="checkbox" name="placeholders[]" value="date_time" checked /> %date_time</div>
                                <div><input type="checkbox" name="placeholders[]" value="venue" checked /> %venue</div>

                                <div><input type="checkbox" name="placeholders[]" value="home_team_logo" checked /> %home_team_logo</div>
                                <div><input type="checkbox" name="placeholders[]" value="away_team_logo" checked /> %away_team_logo</div>
                                <div class="col-span-2"><input type="checkbox" name="placeholders[]" value="main_referee" checked /> %main_referee</div>
                            
                                <div><input type="checkbox" name="placeholders[]" value="home_team_injuries" checked /> %home_team_injuries</div>
                                <div class="col-span-3"><input type="checkbox" name="placeholders[]" value="away_team_injuries" checked /> %away_team_injuries</div>
                                
                                <div><input type="checkbox" name="placeholders[]" value="general_home_ranking" checked /> %general_home_ranking</div>
                                <div><input type="checkbox" name="placeholders[]" value="general_away_ranking" checked /> %general_away_ranking</div>
                                <div><input type="checkbox" name="placeholders[]" value="general_home_points" checked /> %general_home_points</div>
                                <div><input type="checkbox" name="placeholders[]" value="general_away_points" checked /> %general_away_points</div>
                                
                                <div><input type="checkbox" name="placeholders[]" value="general_home_goalaverage" checked /> %general_home_goalaverage</div>
                                <div class="colspan-3"><input type="checkbox" name="placeholders[]" value="general_away_goalaverage" checked /> %general_away_goalaverage</div>
                                
                                <div><input type="checkbox" name="placeholders[]" value="home_team_wdl" checked /> %home_team_wdl</div>
                                <div><input type="checkbox" name="placeholders[]" value="home_team_points" checked /> %home_team_points</div>
                                <div><input type="checkbox" name="placeholders[]" value="home_team_goalaverage" checked /> %home_team_goalaverage</div>
                                <div><input type="checkbox" name="placeholders[]" value="home_team_ranking" checked /> %home_team_ranking</div>
                                <div><input type="checkbox" name="placeholders[]" value="home_team_last_5" checked /> %home_team_last_5</div>
                                
                                <div><input type="checkbox" name="placeholders[]" value="away_team_wdl" checked /> %away_team_wdl</div>
                                <div><input type="checkbox" name="placeholders[]" value="away_team_points" checked /> %away_team_points</div>
                                <div><input type="checkbox" name="placeholders[]" value="away_team_goalaverage" checked /> %away_team_goalaverage</div>
                                <div><input type="checkbox" name="placeholders[]" value="away_team_ranking" checked /> %away_team_ranking</div>
                                <div><input type="checkbox" name="placeholders[]" value="away_team_last_5" checked /> %away_team_last_5</div>

                                <div><input type="checkbox" name="placeholders[]" value="best_scorers" checked />%best_scorers</div>
                                <div><input type="checkbox" name="placeholders[]" value="last_5_games" checked />%last_5_games</div>
                                <div><input type="checkbox" name="placeholders[]" value="stats_h2h" checked />%stats_h2h</div>
                                <div><input type="checkbox" name="placeholders[]" value="tv" checked />%tv</div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>                
        </x-layout.main>
    </div>
</x-app-layout>


