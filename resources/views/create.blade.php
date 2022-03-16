<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Generate game template') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-sky-500">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class= overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6  border-b border-gray-200 text-red-600 bg-black">
                    {{__('Pick a game and click Submit')}}
                </div>

                <!-- This example requires Tailwind CSS v2.0+ -->
                <div class="flex flex-col bg-indigo-500">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="text-right mb-4"> 
                        @if ($errors->any())
                            <div class="alert alert-danger text-red-600">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        </div>
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg bg-green-500">
                            <form method="POST" action="/generate">
                                @csrf
                                <input type=hidden name="team" value="94" />
                                <select name="date" id="game_date" required>
                                    <option value="2022-03-20">Rennes-Metz (20 mars 2022)</option>
                                    @if(isset($next_games['response']))
                                        @foreach($next_games['response'] as $next_game)
                                            <option value="{{ date('Y-m-d', $next_game['fixture']['timestamp']) }}">
                                                [{{ $next_game['league']['name'] }}
                                                -
                                                {{ $next_game['league']['round'] }}]

                                                {{ $next_game['teams']['home']['name'] }}
                                                -
                                                {{ $next_game['teams']['away']['name'] }}
                                                ({{ date("d M Y H:i", $next_game['fixture']['timestamp']) }})
                                            </option>
                                        @endforeach
                                    @endif
                                </select>

                                <div class="relative grid grid-cols-4 bg-red-500 gap-6">
                                    
                                        <div class="bg-blue-600"><input type="checkbox" name="placeholders[]" value="competition" checked /> %competition</div>
                                        <div><input type="checkbox" name="placeholders[]" value="round" checked /> %round</div>
                                        <div><input type="checkbox" name="placeholders[]" value="date_time" checked /> %date_time</div>
                                        <div><input type="checkbox" name="placeholders[]" value="venue" checked /> %venue</div>

                                        <div><input type="checkbox" name="placeholders[]" value="home_team_logo" checked /> %home_team_logo</div>
                                        <div><input type="checkbox" name="placeholders[]" value="away_team_logo" checked /> %away_team_logo</div>
                                        <div class="col-span-2"><input type="checkbox" name="placeholders[]" value="referee" checked /> %referee</div>
                                    
                                        <div><input type="checkbox" name="placeholders[]" value="home_team_injuries"  /> %home_team_injuries</div>
                                        <div class="col-span-3"><input type="checkbox" name="placeholders[]" value="away_team_injuries"  /> %away_team_injuries</div>
                                        
                                        <div><input type="checkbox" name="placeholders[]" value="general_home_ranking" checked /> %general_home_ranking</div>
                                        <div><input type="checkbox" name="placeholders[]" value="general_away_ranking" checked /> %general_away_ranking</div>
                                        <div><input type="checkbox" name="placeholders[]" value="general_home_points" checked /> %general_home_points</div>
                                        <div><input type="checkbox" name="placeholders[]" value="general_away_points" checked /> %general_away_points</div>
                                        
                                        <div><input type="checkbox" name="placeholders[]" value="general_home_goalaverage" checked /> %general_home_goalaverage</div>
                                        <div class="colspan-3"><input type="checkbox" name="placeholders[]" value="general_away_goalaverage" checked /> %general_away_goalaverage</div>
                                        
                                        <div><input type="checkbox" name="placeholders[]" value="home_team_wdl" checked /> %home_team_wdl</div>
                                        <div><input type="checkbox" name="placeholders[]" value="home_team_points" checked /> %home_team_points</div>
                                        <div><input type="checkbox" name="placeholders[]" value="home_team_goalaverage" checked /> %home_team_goalaverage</div>
                                        <div><input type="checkbox" name="placeholders[]" value="away_team_wdl" checked /> %away_team_wdl</div>
                                        
                                        <div><input type="checkbox" name="placeholders[]" value="away_team_points" checked /> %away_team_points</div>
                                        <div class="col-span-3"><input type="checkbox" name="placeholders[]" value="away_team_goalaverage" checked /> %away_team_goalaverage</div>
                                        
                                </div>
                                <br><input type="submit" value="{{ __('Submit') }}" />
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

