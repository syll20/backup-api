PROCHAINS MATCHS:<br>
<br>

<select>
@foreach($next_games as $next_game)

    
        <option id="{{ $next_game['fixture']['id'] }}">
            [{{ $next_game['league']['name'] }}
            -
            {{ $next_game['league']['round'] }}
            ]
            {{ $next_game['teams']['home']['name'] }}
            -
            {{ $next_game['teams']['away']['name'] }}
            ( {{ $next_game['fixture']['date'] }} )
        </option>
    
@endforeach
</select>
