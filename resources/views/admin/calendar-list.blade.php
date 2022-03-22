<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl  leading-tight">
            {{ __('Calendar') }}
        </h2>
    </x-slot> 

    <x-layout.main>
        <x-table.calendars-table>
        @foreach($calendars as $calendar)
            <x-table.calendars-input-row :calendar="$calendar" />
         @endforeach   
        </x-table.calendars-table>
    </x-layout.main>
</x-app-layout>