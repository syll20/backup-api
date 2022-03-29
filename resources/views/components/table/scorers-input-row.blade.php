<tr class="odd:bg-gray-100 even:bg-gray-200 divide-y divide-red-500 @if($scorer->club_id == 94) font-bold @endif">
    <td><img src="{{ $scorer->photo }}" width="25" /></td>
    <td>{{ $scorer->first_name }} {{ $scorer->last_name }}</td>
    <td>
        <form method="post" action="/admin/scorer" >
            @csrf
            @method('patch')
            <input type="hidden" name="id" value="{{ $scorer->id }}" />
            <input type="hidden" name="player_id" value="{{ $scorer->player_id }}" />
            <input type="text" name="goal" value="{{ $scorer->$location }}" size="1" />
            <input type="hidden" name="location" value="{{$location}}" />
            <input type="submit" value="update" />
        </form>
    </td>
</tr>