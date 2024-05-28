<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pulpit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Ostatnie oceny') }}
                    </h2>
                    <table class="min-w-full text-left text-sm font-light">
                        <thead class="border-b font-medium dark:border-neutral-500">
                        <tr>
                            <th scope="col" class="px-6 py-4">Przedmiot</th>
                            <th scope="col" class="px-6 py-4">Ocena</th>
                            @can('teacher-level')
                                <th scope="col" class="px-6 py-4">Uczeń</th>
                            @else
                                <th scope="col" class="px-6 py-4">Nauczyciel</th>
                            @endcan
                            <th scope="col" class="px-6 py-4">Komentarz nauczyciela</th>
                            <th scope="col" class="px-6 py-4">Wystawiona</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($grades as $grade)
                            <tr class="border-b dark:border-neutral-500">
                                <td class="whitespace-nowrap px-6 py-4">{{ $grade->subject->name }}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{ $grade->value }}</td>
                                @can('teacher-level')
                                    <td class="whitespace-nowrap px-6 py-4">{{ $grade->student->name }}</td>
                                @else
                                    <td class="whitespace-nowrap px-6 py-4">{{ $grade->student->name }}</td>
                                @endcan
                                <td class="whitespace-nowrap px-6 py-4">{{ $grade->comment }}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{ $grade->created_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
