@props(['id', 'value', 'type' => 'text', 'size' => '1'])
<input class="border border-gray-400 p-1"
        type="text"
        name="{{$id}}"
        id="{{$id}}"
        size="{{$size}}"

        {{ $attributes(['value' => old($id, $value)]) }}
/>
<x-form.error id="{{$id}}" />
