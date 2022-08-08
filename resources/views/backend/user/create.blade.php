@extends('layouts.backend_app')
@section('content')
@auth
<!-- Form create new -->
<div class="p-4 text-3xl mr-auto">
    {{ __('Thêm mới tài khoản') }}
</div>
<div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white sm:rounded-lg">
    <form method="POST" action="{{ route('backend_user.store') }}">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block font-medium text-sm text-gray-700">{{ __('Name') }}</label>
            <input class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" id="name" name="name" value="{{ old('name') }}" required autofocus />
            @error('name')
            <div class="text-xs text-red-900 py-1 px-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email -->
        <div class="mt-4">
            <label for="email" class="block font-medium text-sm text-gray-700">{{ __('Email') }}</label>
            <input class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="email" id="email" name="email" value="{{ old('email') }}" required />
            @error('email')
            <div class="text-xs text-red-900 py-1 px-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" class="block font-medium text-sm text-gray-700">{{ __('Password') }}</label>
            <input class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="password" id="password" name="password" value="{{ old('password') }}" required />
            @error('password')
            <div class="text-xs text-red-900 py-1 px-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <label for="password_confirmation" class="block font-medium text-sm text-gray-700">{{ __('Confirm Password') }}</label>
            <input class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="password" id="password_confirmation" name="password_confirmation" required />
        </div>

        <div class="mt-8 flex-row">
            <button class="ml-3 inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150" type="submit">
                {{ __('Add') }}
            </button>
            <a href="{{ url()->previous() }}" class="ml-3 inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                {{ __('Cancel') }}
            </a>
        </div>
    </form>
</div>
@endauth
@endsection