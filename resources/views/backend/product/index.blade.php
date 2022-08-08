@extends('layouts.backend_app')
@section('content')
@auth
<div class="flex flex-1 bg-white flex-col md:flex-row lg:flex-row mx-2 rounded ">
    <div class="mb-2 border-solid border-gray-300 rounded border shadow-sm w-full">
        <div class="bg-gray-400 px-2 py-3 border-solid border-gray-400 border-b">
            <strong class="flex justify-center">Danh sách sản phẩm</strong>
        </div>
        <div class="relative mb-2 border-solid rounded border shadow-sm w-full">
            <a href="{{route('backend_product.create')}}" class="absolute inset-y-0 right-0">
                <button class="px-2 py-3 bg-blue-500 hover:bg-blue-700 text-white font-bold rounded">Thêm mới sản phẩm</button>
            </a>
            <!-- Form search -->
            <form method="GET" action="{{route('backend_product.search')}}">
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-gray-300">Search</label>
                <div class="relatives">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" id="search_product" name="search_product" class="px-2 py-3 pl-10 w-1/5 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-400 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tìm kiếm sản phẩm" required="">
                    <button type="submit" class="px-2 py-3 text-white absolute bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tìm kiếm</button>
                </div>
            </form>
        </div>
        <div class="relative flex justify-center">
            <table class="w-full rounded table-fixed">
                <thead>
                    <tr>
                        <th class="border w-13/56 px-3 py-2">Tên sản phẩm</th>
                        <th class="border w-1/6 px-4 py-2">Ảnh</th>
                        <th class="border w-1/6 px-4 py-2">Giá nhập vào</th>
                        <th class="border w-1/6 px-4 py-2">Giá bán ra</th>
                        <th class="border w-1/7 px-4 py-2 text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td class="border px-3 py-2">{{$product->name}}</td>
                        <td class="border px-2 py-2">
                            @if ($product->getFirstMediaUrl('images_url', 'small'))
                            <img width="100" height="100" src="{{ asset($product->getFirstMediaUrl('images_url', 'small')) }}">
                            @endif
                        </td>
                        <td class="border px-4 py-2">{{$product->in_price}} ₫</td>
                        <td class="border px-4 py-2">{{$product->price}} ₫</td>
                        <td class="border px-4 py-2">
                            <div class="flex justify-center">
                                <div>
                                    <a href="{{ route('backend_product.show', $product->product_id) }}" class="bg-teal-300 cursor-pointer rounded p-1 mx-1 text-white">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                                <div>
                                    <a href="{{ route('backend_product.edit', $product->product_id) }}" class="bg-teal-300 cursor-pointer rounded p-1 mx-1 text-white">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                                <div>
                                    <form action="{{ route('backend_product.destroy', $product->product_id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">
                                            <a class="bg-teal-300 cursor-pointer rounded p-1 mx-1 text-red-500">
                                                <i class="fas fa-trash"></i></a>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="pt-4">
            {{ $products->onEachSide(1)->appends(request()->except('page'))->links() }}
        </div>
    </div>
</div>
@endauth
@endsection