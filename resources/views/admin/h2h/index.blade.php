<x-app-layout>
    <x-slot name="header">
        <x-layout.sub-navigation.title title="Head to head : ">
            <x-layout.sub-navigation.link href="/admin/h2h" name="List" />
            <x-layout.sub-navigation.link href="/admin/h2h" name="Import" />
            <x-layout.sub-navigation.link href="/admin/h2h/fixtures" name="Add" />
        </x-layout-subnavigation.title>
    </x-slot>
 
    <x-layout.main>
        <div class="col-span-2">
            <form method="get" action="/admin/h2h/show">
                <select name="club">
                    @foreach($clubs as $club)
                        <option value="{{$club->id}}" @if(isset($requestClub) && $requestClub == $club->id) selected @endif>{{$club->name}}</option>
                    @endforeach
                </select>
                <input type="radio" name="location" value='home' > Home 
                <input type="radio" name="location" value='away'> Away
                <input type="submit" />
            </form>
            @if(isset($games))
                @foreach($games as $team)
                    {{$team->played_at}} 

                    @if($team->location == 'home')
                        {{$team->name }} - Rennes
                    @else
                        Rennes - {{$team->name }}
                    @endif

                    {{$team->home_goals}} - {{$team->away_goals}} - {{ $team->competition}}<br>
                @endforeach
            @endif
        </div>

        <div class="bg-red-500 ">
            <form method="post" action="/admin/h2h/import">
                @csrf
                Import here
                <input type="text" size="50" name="target" value="{{ old('target', 'test') }}" />
                Vs <select name="club">
                    @foreach($clubs as $club)
                        <option value="@if($club->name2){{$club->name2}}@else{{$club->name}}@endif">{{$club->name}}</option>
                    @endforeach
                </select>
                <input type="radio" name="location" value="home"> Home - <input type="radio" name="location" value="away"> Away<br>
                <input type="submit" value="Import" />
            </form>
        </div>
    </x-layout.main>
</x-app-layout>