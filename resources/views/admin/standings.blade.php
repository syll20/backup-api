<x-app-layout>
    <x-slot name="header">
        <x-layout.sub-navigation.title title="Standings ">
        </x-layout-subnavigation.title>
    </x-slot>
    <x-layout.main>
        <x-standing.block location="total"  :scorers="$totalScorers" />
        <x-standing.block location="home" :rankings="$homeRankings" :scorers="$homeScorers" />
        <x-standing.block location="away" :rankings="$awayRankings" :scorers="$awayScorers" />
    </x-admin.main>
</x-app-layout>