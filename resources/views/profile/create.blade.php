<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Utwórz użytkownika') }}
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('users.store') }}"
          class="bg-white p-8 rounded-lg shadow-md max-w-md mx-auto mt-10">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-bold text-gray-700">{{ __('Name') }}</label>
            <input id="name"
                   class="block mt-1 w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                   type="text" name="name" :value="old('name')" required autofocus autocomplete="name"/>
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-600 text-sm"/>
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <label for="email" class="block text-sm font-bold text-gray-700">{{ __('Email') }}</label>
            <input id="email"
                   class="block mt-1 w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                   type="email" name="email" :value="old('email')" required autocomplete="username"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 text-sm"/>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" class="block text-sm font-bold text-gray-700">{{ __('Password') }}</label>
            <input id="password"
                   class="block mt-1 w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                   type="password" name="password" required autocomplete="new-password"/>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 text-sm"/>
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <label for="password_confirmation"
                   class="block text-sm font-bold text-gray-700">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation"
                   class="block mt-1 w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                   type="password" name="password_confirmation" required autocomplete="new-password"/>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-600 text-sm"/>
        </div>

        <div class="flex items-center justify-between mt-6">
            <select name="role_id"
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option selected>Rola</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex items-center justify-between mt-6">
            <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white text-sm font-bold rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                {{ __('Utwórz') }}
            </button>
        </div>

    </form>
</x-app-layout>
