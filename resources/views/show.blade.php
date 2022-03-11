<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Generated template for') }}: {{ $fixture->calendar->label }}
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
                        <div class="text-right mb-4"> </div>
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="w-full divide-y divide-gray-200">
                                    <tbody class="bg-white divide-y divide-gray-200">
                                   
                                    </tbody>
                                </table>
                            </div>
                            <div></div>
                        </div>
                    </div>
                </div>
                <textarea class="w-full" rows=80 id="label">
                    {{ $fixture->template }}
                </textarea>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>