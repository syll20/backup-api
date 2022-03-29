<x-app-layout>
    <x-slot name="header">
        <x-layout.sub-navigation.title title="Templates : ">
            <x-layout.sub-navigation.link href="{{route('template_lists')}}" name="All" />
            <x-layout.sub-navigation.link href="{{route('template_create')}}" name="Create a template" />
        </x-layout-subnavigation.title>
    </x-slot> 

    <x-layout.main>   
            <div class="col-span-2">
                <div class="text-left mb-4">
                    {{$fixtures->links()}}
                </div>
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="w-full divide-y divide-gray-200">
                            <tbody class=" divide-y divide-gray-200">
                            @foreach($fixtures as $fixture)
                                <tr class="even:bg-gray-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    <a href="/list">
                                                        {{$fixture->calendar->label}}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{$fixture->user->name}}</div>
                                        <div class="text-sm text-gray-500">(Admin)</div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{$fixture->calendar->kickoff}}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex  leading-5 font-semibold rounded-full bg-red-500 text-black"> {{$fixture->created_at->diffForHumans()}}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="#" class="text-black hover:text-gray-900">{{ __('Delete (todo)') }}</a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="/admin/lists/{{ $fixture->id }}" class="text-black hover:text-gray-900">{{ __('Show') }}</a>
                                    
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="text-left mt-4">
                        {{$fixtures->links()}}
                    </div>
                </div>
    </x-layout.main>
</x-app-layout>