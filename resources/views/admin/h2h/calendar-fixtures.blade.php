<x-app-layout>
    <x-slot name="header">
    <x-layout.sub-navigation.title title="H2h / Update">
        <x-layout.sub-navigation.link href="/admin/h2h" name="List" />
        <x-layout.sub-navigation.link href="/admin/h2h" name="Import" />
        <x-layout.sub-navigation.link href="/admin/h2h/fixtures" name="Add" />
    </x-layout-subnavigation.title>
    </x-slot> 

    <x-layout.main>
        <div class="col-span-2">
        @error('fixture')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
            <x-table.h2h-fixtures-table>
            @foreach($calendars as $calendar)
                <x-table.h2h-fixture-input-row :calendar="$calendar" />
            @endforeach   
            </x-table.h2h-fixtures-table>
        </div>
    </x-layout.main>
</x-app-layout>