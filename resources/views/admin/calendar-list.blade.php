<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl  leading-tight">
            {{ __('Calendar') }}
        </h2>
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