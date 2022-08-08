@extends('layouts.backend_app')
@section('content')
@auth
<div class="bg-white block mt-1 w-full rounded-md shadow-sm border-2 border-black">
    <div class="p-4 text-3xl mr-auto bg-indigo-300 w-full flex justify-center">
        {{ __('Thêm mới sản phẩm') }}
    </div>
    <div class=" w-full sm:max-w-4xl mt-6 px-10 sm:rounded-lg block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-100 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        <form method="POST" action="{{ route('backend_product.store') }}" enctype="multipart/form-data">
            @csrf
            <!-- Name -->
            <div class="rounded">
                <label for="name" class="block font-medium text-sm">{{ __('Tên sản phẩm') }}</label>
                <input class="block mt-1 p-1 w-full border-2 border-gray-600" type="text" id="name" name="name" value="{{ old('name') }}" required autofocus />
                @error('name')
                <div class="text-xs text-red-900 py-1 px-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Content -->
            <div class="mt-4">
                <label for="content" class="block font-medium text-sm ">{{ __('Mô tả') }}</label>
                <textarea rows="10" class="block mt-1 p-1 w-full rounded-md border-2 border-gray-600" style="min-height: 6.725rem" id="content" name="content" required>{{ old('content') }}</textarea>
                @error('content')
                <div class="text-xs text-red-900 py-1 px-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Categories -->
            <fieldset class="mt-4 border-2 border-gray-600 rounded">
                <legend for="categories" class="block font-medium text-sm">{{ __('Danh mục sản phẩm')}}</legend>
                <div class="mt-1 w-full overscroll-y-auto overflow-auto h-20">
                    @foreach ($categories as $category)
                    <div class="flex items-center my-2 ml-2 text-sm">
                        <input class="rounded" type="checkbox" id="category_id" name="category_id" value="{{ $category->category_id}}" />
                        <label class="pl-2" for="category">{{ $category->name }}</label>
                    </div>
                    @endforeach
                </div>
                @error('categories')
                <div class="text-xs text-red-900 py-1 px-2">{{ __($message) }}</div>
                @enderror
            </fieldset>
            <!-- Brands -->
            <fieldset class="mt-4 border-2 border-gray-600 rounded">
                <legend for="brands" class="block font-medium text-sm">{{ __('Thương hiệu')}}</legend>
                <div class="mt-1 w-full overscroll-y-auto overflow-auto h-20">
                    @foreach ($brands as $brand)
                    <div class="flex items-center my-2 ml-2 text-sm">
                        <input class="rounded" type="checkbox" id="brand_id" name="brand_id" value="{{ $brand->brand_id}}" />
                        <label class="pl-2" for="brand">{{ $brand->name }}</label>
                    </div>
                    @endforeach
                </div>
                @error('brands')
                <div class="text-xs text-red-900 py-1 px-2">{{ __($message) }}</div>
                @enderror
            </fieldset>
            <div class="rounded mt-4">
                <label for="in_price" class="block font-medium text-sm">{{ __('Giá nhập vào') }}</label>
                <input class="block mt-1 p-1 w-full rounded-md shadow-sm border-2 border-gray-600" type="number" id="in_price" name="in_price" required autofocus />
                @error('in_price')
                <div class="text-xs text-red-900 py-1 px-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="rounded mt-4">
                <label for="price" class="block font-medium text-sm">{{ __('Giá bán ra') }}</label>
                <input class="block mt-1 p-1 w-full rounded-md shadow-sm border-2 border-gray-600" type="number" id="price" name="price" required autofocus />
                @error('price')
                <div class="text-xs text-red-900 py-1 px-2">{{ $message }}</div>
                @enderror
            </div>
            <!-- Image -->
            <div class="mt-4">
                <label for="image_url" class="block font-medium text-sm ">{{ __('Ảnh sản phẩm') }}</label>
                <input class="border-2 bg-white block mt-1 p-1 text-center text-sm" type="file" id="image_url" name="image_url" />
            </div>
            <!-- Image -->
            <!-- <div class="mt-4">
                <label for="image_url" class="block font-medium text-sm ">{{ __('Ảnh mô tả') }}</label>
                <input class="border-2 bg-white block mt-1 p-1 text-center text-sm" type="file" id="images_url" name="images_url" multiple="multiple" />
            </div> -->

            <div class="mt-8 p-1 flex-row">
                <button class="ml-3 inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150" type="submit">
                    {{ __('Add') }}
                </button>
                <a href="{{route('backend_product.index')}}" class="ml-3 inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                    {{ __('Cancel') }}
                </a>
            </div>
        </form>
    </div>
</div>



@endauth
@endsection