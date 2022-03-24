<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Head to head') }}
        </h2>
    </x-slot>

    <x-layout.main>
        <div class="col-span-2">
            <select>
                <option>Nice</option>
                <option>Marseille</option>
                <option>Monaco</option>
            </select>
            <input type="radio"> Home - 
            <input type="radio"> Away -
            <input type="text" value="0-1" size="1" />
            <input type="text" value="2022-04-03" size="10" />
            <input type="submit" />
        </div>

        <div class="bg-red-500 ">
            <form method="post" action="/admin/h2h/import">
                @csrf
                Mass Import here
                <input type="text" size="50" name="target" value="{{ old('target', 'test') }}" />
                Vs  <select name="club">
                    <option value="Metz">Metz</option>
                    <option value="Nice">Nice</option>
                    <option value="Marseille">Marseille</option>
                    <option value="Monaco">Monaco</option>
                </select>
                <input type="radio" name="location" value="home"> Home - <input type="radio" name="location" value="away"> Away<br>
                <input type="submit" value="Import" />
            </form>
        </div>
    </x-layout.main>
</x-app-layout>