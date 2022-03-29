<tr class="odd:bg-gray-100 even:bg-gray-200 divide-y divide-red-500">
    <td>{{ $calendar->label }}</td>
    <td>
        <form method="post" action="/admin/calendars" >
            @csrf
            @method('patch')
            <input type="hidden" name="id" value="{{ $calendar->id }}" />
            <input type="text" name="kickoff" value="{{ $calendar->kickoff }}" size="18" />
            <input type="submit" value="update" />
        </form>
    </td>
</tr>