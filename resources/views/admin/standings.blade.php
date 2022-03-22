<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Standings') }}
        </h2>
    </x-slot>
    <x-layout.main>
        <x-standing.block location="total"  :scorers="$totalScorers" />
        <x-standing.block location="home" :rankings="$homeRankings" :scorers="$homeScorers" />
        <x-standing.block location="away" :rankings="$awayRankings" :scorers="$awayScorers" />
    </x-admin.main>
</x-app-layout>