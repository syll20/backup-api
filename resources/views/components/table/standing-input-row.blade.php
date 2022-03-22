<input type="hidden" name="ranking[{{$ranking->club_id}}][id]" value="{{$ranking->id}}" />
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