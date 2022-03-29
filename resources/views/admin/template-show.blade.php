<x-app-layout>
    <x-slot name="header">
        <x-layout.sub-navigation.title title="{{ __('Generated template for') }}: {{ $fixture->calendar->label }} -">
        <x-layout.sub-navigation.link href="{{route('template_lists')}}" name="All" />
            <x-layout.sub-navigation.link href="{{route('template_create')}}" name="Create a template" />
        </x-layout-subnavigation.title>
        <h2 class="font-semibold text-xl text-white leading-tight">
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