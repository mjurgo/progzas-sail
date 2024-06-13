<div class="max-w-md">
    <form method="POST" action="{{ route('students.addGrade', ['id' => $id]) }}">
        @csrf

        <div class='flex justify-between items-end gap-5 w-full mb-[20px]'> 
            <div>
                <select name="subject_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option selected>Przedmiot</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class='w-[200px]'>
                <x-input-label for="value" :value="__('Ocena')" />
                <x-number-input min="1" max="6" id="value" class="block mt-1 w-[200px]" name="value" :value="old('value')" required />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

        </div>

        <div>
            <x-input-label for="comment" :value="__('Komentarz')" />
            <x-textarea-input id="comment" class="block mt-1 w-full" type="text" name="comment" :value="old('comment')" />
        </div>

        <div>
            <x-primary-button class="mt-4">
                {{ __('Dodaj ocenę') }}
            </x-primary-button>
        </div>
    </form>
</div>
