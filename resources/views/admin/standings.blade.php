<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Standings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 inline">
                    <form action="/admin/standings" method="POST">
                        @csrf
                        <input class="bg-black text-red-500 text-bold w-48 justify-center" type="submit" value="Update" />
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
        <div class="grid grid-cols-4 gap-4">
            <div class="col-span-2">
                <div>
                    General
                </div>
                <div>
                    <table>
                        <tr>
                            <td>Pos</td>
                            <td>Club</td>
                            <td>pts</td>
                            <td>J</td>
                            <td>V</td>
                            <td>N</td>
                            <td>D</td>
                            <td>p.</td>
                            <td>c.</td>
                            <td>+/-</td>
                            <td>forme</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div>
                Colonne buteurs
            </div>
            <div>
                Colonne passeurs
            </div>
            <div class="col-span-2">
                <div>
                    Home
                </div>
                <div>
                    <table class="w-full bg-red-500">
                        <tr>
                            <td>Pos</td>
                            <td>Club</td>
                            <td>pts</td>
                            <td>J</td>
                            <td>V</td>
                            <td>N</td>
                            <td>D</td>
                            <td>p.</td>
                            <td>c.</td>
                            <td>+/-</td>
                            <td>forme</td>
                        </tr>
                        @foreach($homeRankings as $ranking)
                        <tr class=" divide-y divide-red-500 @if($ranking->club_id == 94) font-bold @endif">
                            <td>{{ $ranking->rank }}</td>
                            <td>{{ $ranking->name }}</td>
                            <td>{{ $ranking->points }}</td>
                            <td>{{ $ranking->played }}</td>
                            <td>{{ $ranking->win }}</td>
                            <td>{{ $ranking->draw }}</td>
                            <td>{{ $ranking->lose }}</td>
                            <td>{{ $ranking->goals_for }}</td>
                            <td>{{ $ranking->goals_against }}</td>
                            <td>{{ $ranking->goals_diff }}</td>
                            <td>{{ $ranking->last5 }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div>
                Colonne buteurs
            </div>
            <div>
                Colonne passeurs
            </div>
            <div class="col-span-2">
                <div>
                    Away
                </div>
                <div>
                    <table>
                        <tr>
                            <td>Pos</td>
                            <td>Club</td>
                            <td>pts</td>
                            <td>J</td>
                            <td>V</td>
                            <td>N</td>
                            <td>D</td>
                            <td>p.</td>
                            <td>c.</td>
                            <td>+/-</td>
                            <td>forme</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div>
                Colonne buteurs
            </div>
            <div>
                Colonne passeurs
            </div>
        </div>
    </div>
</x-app-layout>