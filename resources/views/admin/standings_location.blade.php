<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Standings') }} : {{ __($location) }}
        </h2>
    </x-slot>

    <x-layout.main>
        <x-form.error />
        <div>
            <form method="post" action="/admin/standings" >
                @csrf
                @method('patch')
                <x-table.standing-table>
                    @foreach($rankings as $ranking)
                        <x-table.standing-input-row :ranking="$ranking" />   
                    @endforeach
                </x-table-standing-table>
                <input type="submit" value="Update {{$location}} ranking" class="mt-6 mb-20 bg-black text-red-600" />
            </form>
        </div>
    </x-layout.main>
</x-app-layout>