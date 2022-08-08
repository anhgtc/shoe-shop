@extends('layouts.backend_app')
@section('content')
@auth
<div class="bg-white block mt-1 w-full rounded-md shadow-sm border-2 border-black">
    <div class="p-4 text-3xl mr-auto bg-indigo-300 w-full flex justify-center">
        {{ __('Sửa thông tin sản phẩm') }}
    </div>
    <div class="content-center w-full sm:max-w-4xl mt-6 px-10 sm:rounded-lg block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-100 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        <form method="POST" action="{{ route('backend_product.update', $product->product_id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- Name -->
            <div class="rounded">
                <label for="name" class="block font-medium text-sm">{{ __('Tên sản phẩm') }}</label>
                <input class="rounded block mt-1 p-1 w-full border-2 border-gray-600" type="text" id="name" name="name" value="{{$product->name}}" required autofocus />
                @error('name')
                <div class="text-xs text-red-900 py-1 px-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Content -->
            <div class="mt-4">
                <label for="content" class="block font-medium text-sm ">{{ __('Mô tả') }}</label>
                <textarea rows="10" class="block mt-1 p-1 w-full rounded-md border-2 border-gray-600" style="min-height: 6.725rem" id="content" name="content" required>{{ $product->content}}</textarea>
                @error('content')
                <div class="text-xs text-red-900 py-1 px-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-4">
                <label for="category" class="block font-medium text-sm ">{{ __('Danh mục sản phẩm') }}</label>
                <select id="category_id" name="category_id" class="bg-gray-50 border border-gray-600 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach ($categories as $category)
                    <option value="{{$category->category_id}}">{{$category->name}}</option>
                    @endforeach
                </select>
                @error('categories')
                <div class="text-xs text-red-900 py-1 px-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-4">
                <label for="brand" class="block font-medium text-sm ">{{ __('Thương hiệu') }}</label>
                <select id="brand_id" name="brand_id" class="bg-gray-50 border border-gray-600 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach ($brands as $brand)
                    <option value="{{$brand->brand_id}}">{{$brand->name}}</option>
                    @endforeach
                </select>
                @error('brands')
                <div class="text-xs text-red-900 py-1 px-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="rounded mt-4">
                <label for="in_price" class="block font-medium text-sm">{{ __('Giá nhập vào') }}</label>
                <input class="block mt-1 w-full p-1 rounded-md shadow-sm border-2 border-gray-600" type="number" id="in_price" name="in_price" value="{{$product->in_price}}" required autofocus />
                @error('in_price')
                <div class="text-xs text-red-900 py-1 px-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="rounded mt-4">
                <label for="price" class="block font-medium text-sm">{{ __('Giá bán ra') }}</label>
                <input class="block mt-1 w-full p-1 rounded-md shadow-sm border-2 border-gray-600" type="number" id="price" name="price" value="{{$product->price}}" required autofocus />
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

            <div class="mt-8 pb-1 flex-row">
                <button class="ml-3 inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150" type="submit">
                    {{ __('Update') }}
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