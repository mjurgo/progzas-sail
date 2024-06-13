<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl leading-tight bg-gradient-to-r from-green-400 via-blue-500 to-purple-600 text-white p-6 rounded-lg shadow-md">
            {{ __('Profil ucznia') }}: {{ $student->name }}
        </h2>
    </x-slot>
    <div class="py-16">
        <div class="max-w-7xl mx-auto sm:px-8 lg:px-10 space-y-8">
            @can('teacher-level')
                @include('students.partials.update-grade-form', ['id' => $student->id])
            @endcan
            <div class="p-6 sm:p-10 bg-gray-50 shadow-lg sm:rounded-xl">
                <div class="w-full">
                    <table class="w-full text-left text-base font-medium">
                        <thead class="border-b-2 font-semibold bg-blue-100">
                        <tr>
                            <th scope="col" class="px-6 py-4">Przedmiot</th>
                            <th scope="col" class="px-6 py-4">Ocena</th>
                            <th scope="col" class="px-6 py-4">Nauczyciel</th>
                            <th scope="col" class="px-6 py-4">Komentarz nauczyciela</th>
                            <th scope="col" class="px-6 py-4">Wystawiona</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($student->grades as $grade)
                            <tr class="border-b bg-white hover:bg-blue-50">
                                <td class="whitespace-nowrap px-6 py-4">{{ $grade->subject->name }}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{ $grade->value }}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{ $grade->teacher->name }}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{ $grade->comment }}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{ $grade->created_at }}</td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <button class="inline-flex items-center px-5 py-2 bg-indigo-600 text-white font-bold rounded-lg shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        <a href="{{ route('grades.history', ['grade' => $grade]) }}">Historia zmian</a>
                                    </button>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    @can('teacher-level')
                                        <button class="inline-flex items-center px-5 py-2 bg-yellow-600 text-white font-bold rounded-lg shadow hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            <a href="{{ route('grades.edit', ['grade' => $grade]) }}">Zmień ocenę</a>
                                        </button>
                                    @endcan
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    @can('teacher-level')
                                        @include('students.partials.delete-grade-form', ['studentId' => $grade->user_id, 'gradeId' => $grade->id])
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
