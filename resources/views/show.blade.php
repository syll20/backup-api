<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Generated template for') }}: {{ $fixture->calendar->label }}
        </h2>
    </x-slot>

    <x-layout.main>
        <div class="col-span-3">
            <textarea class="w-full" rows=80 id="label">
                {{ $fixture->template }}
            </textarea>
        </div>
    </x-layout.main>
</x-app-layout>