<tr class="odd:bg-gray-100 even:bg-gray-200 divide-y divide-red-500">
    <td>{{ $calendar->label }}</td>
    <td>{{ $calendar->fixture }}</td>
    <td>{{ $calendar->kickoff }}</td>
    <td>
        <form method="post" action="/admin/h2h/add" >
            @csrf
            <input type="hidden" id="fixture" name="fixture" value="{{ $calendar->fixture }}" />
            <input type="submit" value="update h2h" />
        </form>
    </td>
</tr>