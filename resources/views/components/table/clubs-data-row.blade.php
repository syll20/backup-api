<tr class="odd:bg-gray-100 even:bg-gray-200 divide-y divide-red-500 @if($club->id == 94) font-bold @endif">
    <td><img src="{{ $club->logo }}" width="25" /></td>
    <td>{{ $club->name }}</td>
    <td>{{ $club->venue }}</td>
    <td>{{ $club->founded }}</td>
    <td>
        <form method="post" action="#" >
            @csrf
            @method('patch')
            <input type="hidden" name="id" value="{{ $club->id }}" />
            <input type="submit" value="update" />
        </form>
    </td>
</tr>