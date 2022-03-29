<x-app-layout>
    <x-slot name="header">
    <x-layout.sub-navigation.title title="Next games for Stade Rennais ">
        </x-layout-subnavigation.title>
    </x-slot> 

    <x-layout.main>
        <div class="col-span-2">
            <x-table.calendars-table>
            @foreach($calendars as $calendar)
                <x-table.calendars-input-row :calendar="$calendar" />
            @endforeach   
            </x-table.calendars-table>
        </div>
    </x-layout.main>
</x-app-layout>