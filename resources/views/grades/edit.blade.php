<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-center text-3xl leading-tight bg-gradient-to-r from-blue-500 to-purple-500 text-white p-6 rounded shadow-lg">
            {{ __('Edytuj ocenę') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow-lg sm:rounded-lg">
                <div class="max-w-xl">
                    @include('grades.partials.update-grade-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
