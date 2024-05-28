<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista uczniów') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @foreach($students as $student)
                        <p><a href="{{ route('students.show', ['id' => $student->id]) }}">{{ $student->name }}</a></p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
