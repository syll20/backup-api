<x-app-layout>
    <x-slot name="header">
    <x-layout.sub-navigation.title title="Standings / Update home/away : ">
        <x-layout.sub-navigation.link href="{{route('standings')}}" name="All" />
        <x-layout.sub-navigation.link href="{{route('admin_standing_fixture')}}" name="Update table league (Home/Away)" />
    </x-layout-subnavigation.title>
    </x-slot> 

    <x-layout.main>
        <div class="col-span-2">
        @error('fixture')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
            <x-table.standings-fixtures-table>
            @foreach($calendars as $calendar)
                <x-table.standings-fixture-input-row :calendar="$calendar" />
            @endforeach   
            </x-table.standings-fixtures-table>
        </div>
    </x-layout.main>
</x-app-layout>