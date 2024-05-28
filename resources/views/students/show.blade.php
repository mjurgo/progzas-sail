<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profil ucznia') }}
        </h2>
        <h3 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $student->name }}
        </h3>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @can('teacher-level')
                @include('students.partials.update-grade-form', ['id' => $student->id])
            @endcan
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <table class="min-w-full text-left text-sm font-light">
                        <thead class="border-b font-medium dark:border-neutral-500">
                        <tr>
                            <th scope="col" class="px-6 py-4">Przedmiot</th>
                            <th scope="col" class="px-6 py-4">Ocena</th>
                            <th scope="col" class="px-6 py-4">Nauczyciel</th>
                            <th scope="col" class="px-6 py-4">Komentarz nauczyciela</th>
                            <th scope="col" class="px-6 py-4">Wystawiona</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($student->grades as $grade)
                            <tr class="border-b dark:border-neutral-500">
                                <td class="whitespace-nowrap px-6 py-4">{{ $grade->subject->name }}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{ $grade->value }}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{ $grade->teacher->name }}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{ $grade->comment }}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{ $grade->created_at }}</td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    @can('teacher-level')
                                        <button class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
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
