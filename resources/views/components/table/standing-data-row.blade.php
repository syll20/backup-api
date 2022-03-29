<tr class="odd:bg-gray-100 even:bg-gray-200 divide-y divide-red-500 @if($ranking->club_id == 94) font-bold @endif">
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
    <td class="bg-white flex text-white font-extrabold content-center">{{ Str::of(Str::replace(['W', 'D', 'L'], ['<div class="bg-green-500 mr-1">&nbsp;*&nbsp;</div>', 
        '<div class="bg-amber-500 mr-1">&nbsp;*&nbsp;</div>', '<div class="bg-red-500 mr-1">&nbsp;*&nbsp;</div>'], $ranking->last5))->toHtmlString() }}</td>
</tr>