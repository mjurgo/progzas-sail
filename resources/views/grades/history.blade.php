<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-white leading-tight bg-gradient-to-r from-blue-500 to-purple-500 p-4 rounded shadow-md">
                Historia zmiany oceny: {{ $studentName }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-lg rounded-lg transition transform hover:-translate-y-1 hover:shadow-xl">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full text-left text-sm font-light">
                        <thead class="border-b font-medium bg-gray-100">
                        <tr>
                            <th scope="col" class="px-6 py-4">Ocena</th>
                            <th scope="col" class="px-6 py-4">Komentarz nauczyciela</th>
                            <th scope="col" class="px-6 py-4">Wystawiona</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($grades as $grade)
                            <tr class="border-b bg-gray-50 hover:bg-gray-100 transition transform hover:-translate-y-1 hover:shadow-md">
                                <td class="whitespace-nowrap px-6 py-4">{{ $grade->value }}</td>
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
