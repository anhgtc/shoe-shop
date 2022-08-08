@extends('layouts.backend_app')
@section('content')
@auth
<div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white sm:rounded-lg">
    <div class="bg-gray-200 px-2 py-3 border-solid border-gray-200 border-b rounded">
        <strong class="flex justify-center">Chỉnh sửa danh mục sản phẩm</strong>
    </div>
    <form method="POST" action="{{ route('backend_category.update', $category->category_id) }}">
        @csrf
        @method('PUT')
        <!-- ID -->
        <div>
            <label for="id" class="block font-medium text-sm text-gray-700">{{ __('ID') }}</label>
            <input class="block mt-1 w-full rounded-md shadow-sm bg-gray-300 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" id="id" name="id" value="{{ $category->category_id }}" required readonly />
        </div>
        <!-- Name -->
        <div class="mt-4">
            <label for="name" class="block font-medium text-sm text-gray-700">{{ __('Name') }}</label>
            <input class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" id="name" name="name" value="{{ $category->name }}" required autofocus onfocus="this.selectionStart = this.value.length;" />
        </div>
        <div class="mt-8 flex-row">
            <button class="ml-3 inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150" type="submit">
                {{ __('Update') }}
            </button>
            <a href="{{route('backend_category.index')}}" class="ml-3 inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                {{ __('Cancel') }}
            </a>
        </div>
    </form>
</div>
@endauth
@endsection