<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
           
                

                <!-- This example requires Tailwind CSS v2.0+ -->
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="text-left mb-4">{{$fixtures->links()}}</div>
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="w-full divide-y divide-gray-200">
                                    <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($fixtures as $fixture)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            <a href="/list">
                                                                {{$fixture->calendar->label}}
                                                            </a>
                                                        </div>
                                                        <div class="text-sm text-gray-500">{{$fixture->user->name}}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{$fixture->calendar->kickoff}}</div>
                                                <div class="text-sm text-gray-500"></div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"> Published </span>
                                                <div class="text-sm text-gray-500">{{$fixture->created_at->diffForHumans()}}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="/list" class="text-indigo-600 hover:text-indigo-900">{{ __('Edit') }}</a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="/lists/{{ $fixture->id }}" class="text-indigo-600 hover:text-indigo-900">{{ __('Show') }}</a>
                                            
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-left mt-4">{{$fixtures->links()}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>