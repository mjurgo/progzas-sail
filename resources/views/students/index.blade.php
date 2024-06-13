<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista uczniów') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex justify-center p-4 sm:p-8 bg-white shadow sm:rounded-lg ">
                <div class="max-w-xl">
                    @foreach($students as $student)
                    <a href="{{ route('students.show', ['id' => $student->id]) }}">
                        <p class='border-2 rounded p-[10px] w-[100%] m-[10px] flex justify-center hover:bg-slate-200 duration-500'>{{ $student->name }}</p>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
