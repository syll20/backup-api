<tr class="odd:bg-red-500 even:bg-gray-400 divide-y divide-red-500 @if($ranking->club_id == 94) font-bold @endif">
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
    <td class="flex">{{ Str::of(Str::replace('W', '<div class="bg-bl">*</div>', $ranking->last5))->toHtmlString() }}</td>
</tr>