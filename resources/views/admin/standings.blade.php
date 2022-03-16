<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Standings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 inline">
                    <form action="/admin/standings" method="POST">
                        @csrf
                        <input class="bg-black text-red-500 text-bold w-48 justify-center" type="submit" value="Update" />
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-blue-500">
        <div class="grid grid-cols-3 gap-4">
        <div>Général</div>
        
        <div>Home</div>

        <div>Away</div>
        </div>
    </div>
</x-app-layout>