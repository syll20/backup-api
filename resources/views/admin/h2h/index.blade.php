<x-app-layout>
    <x-slot name="header">
        <x-layout.sub-navigation.title title="Head to head : ">
        </x-layout-subnavigation.title>
    </x-slot>
 
    <x-layout.main>
        <div class="col-span-2">
            <select name="club">
                @foreach($clubs as $club)
                    <option value="@if($club->name2){{$club->name2}}@else{{$club->name}}@endif">{{$club->name}}</option>
                @endforeach
            </select>
            <input type="radio"> Home - 
            <input type="radio"> Away -
            <input type="text" value="0-1" size="1" />
            <input type="text" value="2022-04-03" size="10" />
            <input type="submit" />
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