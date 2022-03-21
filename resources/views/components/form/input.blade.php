@props(['id', 'name', 'type' => 'text'])
<x-form.field-layout>
    <x-form.label id="{{$id}}" name="{{$name}}" />
    <input class="border border-gray-400 p-2 w-full"
            type="{{$type}}"
            name="{{$id}}"
            id="{{$id}}"

            {{ $attributes(['value' => old($id)]) }}
    />
    <x-form.error id="{{$id}}" />
</x-form.field-layout>