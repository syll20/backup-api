<div class="">
    <x-form.error />
    <div>
        {{$location}} (<a href="{{ route('show_standing', $location) }}">update</a>)
    </div>
    
    <div>
        <x-table.standing-table>
        @if(isset($rankings))
        @foreach($rankings as $ranking)
            <x-table.standing-data-row :ranking="$ranking" />
        @endforeach
        @endif
        </x-table.standing-table>
    </div>
</div>
<div> 
    <x-table.scorers-table>
    @foreach($scorers as $scorer)
        <x-table.scorers-input-row :scorer="$scorer" location="{{$location}}" />
    @endforeach
    </x-table.scorers-table>
</div>
<div>
    Colonne passeurs
</div>