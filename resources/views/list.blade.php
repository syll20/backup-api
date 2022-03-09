<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
           
                @foreach($calendars as $calendar)
                {{dd($calendar->fixture[0]->user_id)}}
                    {{$calendar->kickoff}} - {{$calendar->label}} - 
                    
                    @if(isset($calendar->fixture->user_id))
                        {{$calendar->fixture->user_id ?? 'Pas de user_id'}}
                    @endif
                    
                    <br>
                @endforeach

            </div>
        </div>
    </div>
</x-app-layout>