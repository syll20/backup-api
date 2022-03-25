<x-app-layout>
    <x-slot name="header">
        <x-layout.sub-navigation.title title="Clubs : ">
            <x-layout.sub-navigation.link href="/admin/clubs" name="All" />
            <x-layout.sub-navigation.link href="/admin/clubs/import" name="Import" />
        </x-layout-subnavigation.title>
    </x-slot> 

    <x-layout.main>
        <div class="col-span-2">
            <x-table.clubs-table>
            @foreach($clubs as $club)
                <x-table.clubs-data-row :club="$club" />
            @endforeach
            </x-table.clubs-table>
        </div>
    </x-layout.main>
</x-app-layout>