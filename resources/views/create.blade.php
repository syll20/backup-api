<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Generate game template') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{__('Pick a game and click Submit')}}
                </div>

                <!-- This example requires Tailwind CSS v2.0+ -->
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="text-right mb-4"> </div>
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <form method="POST" action="/generate">
                                @csrf
                                <select name="game_date" id="game_date" required>
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
                                </select>
                                <input type="submit" value="{{ __('Submit') }}" />
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


