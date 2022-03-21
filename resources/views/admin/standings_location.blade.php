<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Standings') }} : {{ __($location) }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
        <div>
            
            <div class="col-span-4">
                
                    <div>@if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                <div >
                <form method="post" action="/admin/standings" >
                    @csrf
                    @method('patch')
                    <table class="bg-white text-red-600 mt-4">
                        <thead>
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
                        </thead>
                        <tbody>
                            @foreach($rankings as $ranking)
                            <input type="hidden" name="ranking[{{$ranking->club_id}}][id]" value="{{$ranking->id}}" />
                            <input type="hidden" name="ranking[{{$ranking->club_id}}][league]" value="{{$ranking->league}}" />
                            <input type="hidden" name="ranking[{{$ranking->club_id}}][season]" value="{{$ranking->season}}" />

                            <input type="hidden" name="ranking[{{$ranking->club_id}}][club_id]" value="{{$ranking->club_id}}" />
                            <input type="hidden" name="ranking[{{$ranking->club_id}}][location]" value="{{$ranking->location}}" />
                            <tr class=" divide-y divide-red-500 @if($ranking->club_id == 94) bg-red-600 font-bold  @endif ">
                                <td><x-form.input-no-label id="ranking[{{$ranking->club_id}}][rank]" value="{{ $ranking->rank}}" /></td>
                                <td class="bg-indigo-600">{{ $ranking->name }}</td>
                                <td><x-form.input-no-label id="ranking[{{$ranking->club_id}}][points]" value="{{ $ranking->points}}" /></td>
                                <td><x-form.input-no-label id="ranking[{{$ranking->club_id}}][played]" value="{{ $ranking->played}}" /></td>
                                <td><x-form.input-no-label id="ranking[{{$ranking->club_id}}][win]" value="{{ $ranking->win}}" /></td>
                                <td><x-form.input-no-label id="ranking[{{$ranking->club_id}}][draw]" value="{{ $ranking->draw}}" /></td>
                                <td><x-form.input-no-label id="ranking[{{$ranking->club_id}}][lose]" value="{{ $ranking->lose}}" /></td>
                                <td><x-form.input-no-label id="ranking[{{$ranking->club_id}}][goals_for]" value="{{ $ranking->goals_for}}" /></td>
                                <td><x-form.input-no-label id="ranking[{{$ranking->club_id}}][goals_against]" value="{{ $ranking->goals_against}}" /></td>
                                <td><x-form.input-no-label id="ranking[{{$ranking->club_id}}][goals_diff]" value="{{ $ranking->goals_diff}}" size="2" /></td>
                                <td><x-form.input-no-label id="ranking[{{$ranking->club_id}}][last5]" value="{{ $ranking->last5}}" size="8" /></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <input type="submit" value="Update {{$location}} ranking" class="mt-6 mb-20 bg-black text-red-600" />
                    </form>
                </div>
            </div>
            
            
        </div>
    </div>
</x-app-layout>