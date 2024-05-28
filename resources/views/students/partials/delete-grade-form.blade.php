<x-danger-button
    x-data=""
    x-on:click.prevent="$dispatch('open-modal', 'confirm-grade-deletion')"
>{{ __('Usuń ocenę') }}</x-danger-button>

<x-modal name="confirm-grade-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
    <form method="post" action="{{ route('students.deleteGrade', ['id' => $studentId]) }}" class="p-6">
        @csrf
        @method('delete')
        <input type="hidden" value="{{ $gradeId }}" name="gradeId" />

        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Na pewno chcesz usunąć tę ocenę?') }}
        </h2>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Anuluj') }}
            </x-secondary-button>

            <x-danger-button class="ml-3">
                {{ __('Usuń') }}
            </x-danger-button>
        </div>
    </form>
</x-modal>
