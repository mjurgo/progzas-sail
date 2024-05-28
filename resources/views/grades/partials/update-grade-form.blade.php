<form method="POST" action="{{ route('grades.update', $grade) }}">
    @csrf
    @method('put')

    <div>
        <select name="subject_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            @foreach($subjects as $subject)
                <option value="{{ $subject->id }}" {{ ($subject->id == $grade->subject_id) ? 'selected' : '' }}>{{ $subject->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <x-input-label for="value" :value="__('Ocena')" />
        <x-number-input min="1" max="6" id="value" class="block mt-1 w-1/6" name="value" :value="old('value', $grade->value)" required />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="comment" :value="__('Komentarz')" />
        <textarea name="comment" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('comment', $grade->comment) }}</textarea>
    </div>

    <div>
        <x-primary-button class="mt-4">
            {{ __('Zmień ocenę') }}
        </x-primary-button>
    </div>
</form>
