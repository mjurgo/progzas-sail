<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-center text-3xl leading-tight bg-gradient-to-r from-blue-500 to-purple-500 text-white p-6 rounded shadow-lg">
            {{ __('Pulpit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">
                        {{ __('Ostatnie oceny') }}
                    </h2>
                    <table class="min-w-full text-left text-sm font-light">
                        <thead class="bg-gray-100 border-b">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-semibold text-gray-700">Przedmiot</th>
                            <th scope="col" class="px-6 py-4 font-semibold text-gray-700">Ocena</th>
                            @can('admin-level')
                                <th scope="col" class="px-6 py-4 font-semibold text-gray-700">Uczeń</th>
                                <th scope="col" class="px-6 py-4 font-semibold text-gray-700">Nauczyciel</th>
                            @elsecan('teacher-level')
                                <th scope="col" class="px-6 py-4 font-semibold text-gray-700">Uczeń</th>
                            @else
                                <th scope="col" class="px-6 py-4 font-semibold text-gray-700">Nauczyciel</th>
                            @endcan
                            <th scope="col" class="px-6 py-4 font-semibold text-gray-700">Komentarz nauczyciela</th>
                            <th scope="col" class="px-6 py-4 font-semibold text-gray-700">Wystawiona</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                        @foreach($grades as $grade)
                            <tr class="hover:bg-gray-50 transition duration-300 ease-in-out">
                                <td class="whitespace-nowrap px-6 py-4 hover:bg-gray-200 transition duration-300 ease-in-out">{{ $grade->subject->name }}</td>
                                <td class="whitespace-nowrap px-6 py-4 hover:bg-gray-200 transition duration-300 ease-in-out">{{ $grade->value }}</td>
                                @can('admin-level')
                                    <td class="whitespace-nowrap px-6 py-4 hover:bg-gray-200 transition duration-300 ease-in-out">{{ $grade->student->name }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 hover:bg-gray-200 transition duration-300 ease-in-out">{{ $grade->teacher->name }}</td>
                                @elsecan('teacher-level')
                                    <td class="whitespace-nowrap px-6 py-4 hover:bg-gray-200 transition duration-300 ease-in-out">{{ $grade->student->name }}</td>
                                @else
                                    <td class="whitespace-nowrap px-6 py-4 hover:bg-gray-200 transition duration-300 ease-in-out">{{ $grade->teacher->name }}</td>
                                @endcan
                                <td class="whitespace-nowrap px-6 py-4 hover:bg-gray-200 transition duration-300 ease-in-out">{{ $grade->comment }}</td>
                                <td class="whitespace-nowrap px-6 py-4 hover:bg-gray-200 transition duration-300 ease-in-out">{{ $grade->created_at->format('Y-m-d H:i') }}</td>
                                @cannot('teacher-level')
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <a href="{{ route('grades.history', ['grade' => $grade]) }}" class="inline-flex items-center px-4 py-2 bg-indigo-500 text-white rounded-md font-semibold text-xs uppercase tracking-widest shadow-sm hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            Historia zmian
                                        </a>
                                    </td>
                                @endcannot
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
