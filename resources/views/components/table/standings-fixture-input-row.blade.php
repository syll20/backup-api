<tr class="odd:bg-gray-100 even:bg-gray-200 divide-y divide-red-500">
    <td>{{ $calendar->label }}</td>
    <td>{{ $calendar->fixture }}</td>
    <td>{{ $calendar->kickoff }}</td>
    <td>
        <form method="post" action="/admin/standings/update" >
            @csrf
            @method('PUT')
            <input type="hidden" id="fixture" name="fixture" value="{{ $calendar->fixture }}" />
            <input type="submit" value="update standings" />
        </form>
    </td>
</tr>