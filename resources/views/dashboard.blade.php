<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-100 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-10 font-semibold text-xl text-gray-800 center">
                    Successfully logged in
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
