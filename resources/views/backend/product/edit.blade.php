@extends('layouts.backend_app')
@section('content')
@auth

<div class="flex flex-col">
    <!-- Thông tin chi tiết sản phẩm -->
    <div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2">
        <!--Thông tin chung-->
        <div class="bg-white mb-2 border-solid border-gray-200 rounded border shadow-sm w-full md:w-1/2 lg:w-1/2">
            <div class="bg-gray-400 px-2 py-3 border-solid border-gray-300 border-b font-bold justify-center ">
                {{$product->name}}
            </div>
            <div class="p-3">
                <div class="mb-2 px-4 py-3 rounded flex justify-center">
                    @if ($product->getFirstMediaUrl('images_url', 'small'))
                    <img width="100" height="100" src="{{ asset($product->getFirstMediaUrl('images_url', 'small')) }}">
                    @endif
                </div>
                <div class=" border-b-4 px-4 py-3 flex justify-center">
                    <strong class="font-bold">Danh mục sản phẩm: &nbsp</strong>
                    <span class="block sm:inline text-red-500">{{$product->category->name}}</span>
                </div>
                <div class=" border-b-4 px-4 py-3 flex justify-center">
                    <strong class="font-bold">Thương hiệu: &nbsp</strong>
                    <span class="block sm:inline text-red-500">{{$product->brand->name}}</span>
                </div>
                <div class=" border-b-4 px-4 py-3 flex justify-center">
                    <strong class="font-bold">Giá nhập vào: &nbsp</strong>
                    <span class="block sm:inline text-red-500">{{$product->in_price}} ₫</span>
                </div>
                <div class=" border-b-4 px-4 py-3 flex justify-center">
                    <strong class="font-bold">Giá bán: &nbsp</strong>
                    <span class="block sm:inline text-red-500">{{$product->price}} ₫</span>
                </div>
                <div class="px-4 py-3 flex justify-center">
                    <a class="absolute" href="{{ route('backend_product.show', $product->product_id) }}">
                        <button class="px-2 bg-blue-500 hover:bg-blue-700 text-white font-bold rounded ">Chỉnh sửa</button>
                    </a>
                </div>
            </div>
        </div>

        <div class="bg-white mb-2 md:mx-2 lg:mx-2 border-solid border-gray-300 rounded border shadow-sm w-full md:w-1/2 lg:w-1/2">
            <div class="relative bg-gray-400 px-2 py-3 border-solid border-gray-300 border-b font-bold">
                <div class="">
                    Kho
                </div>
                <div class="absolute inset-y-0 right-0 content-center">
                    <a>
                        <button data-modal='productDetailFormModal' class="modal-trigger px-2 py-3 bg-blue-500 hover:bg-blue-700 text-white font-bold rounded">Thêm mới</button>
                    </a>
                </div>
            </div>
            <div class="p-3 relative">
                <table class="table-responsive w-full rounded">
                    <thead>
                        <tr>
                            <th class="border w-1/4 px-4 py-2">Màu sắc</th>
                            <th class="border w-1/4 px-4 py-2">Kích cỡ</th>
                            <th class="border w-1/4 px-4 py-2">Số lượng</th>
                            <th class="border w-1/4 px-4 py-2">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productdetails as $productdetail)
                        <tr>
                            <td class="border px-4 py-2">{{$productdetail->color}}</td>
                            <td class="border px-4 py-2">{{$productdetail->size}}</td>
                            <td class="border px-4 py-2">{{$productdetail->number}}</td>
                            <td class="border px-4 py-2">
                                <div class="flex items-center">
                                    <div>
                                        <a data-modal='productDetailEditFormModal' class="modal-trigger bg-teal-300 cursor-pointer rounded p-1 mx-1 text-white">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                    <div>
                                        <form action="{{ route('backend_productdetail.destroy', $productdetail->productdetail_id) }}" method="POST">
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
        </div>
    </div>

    <!--Grid Form-->

    <div class="flex flex-1 pt-4 flex-col md:flex-row lg:flex-row mx-2 rounded  ">
        <div class="mb-2 border-solid bg-white border-gray-300 rounded border shadow-sm w-full">
            <div class="bg-gray-400 px-2 py-3 border-solid border-gray-300 border-b font-bold">
                Mô tả chi tiết
            </div>
            <div class="p-1 flex flex-1 flex-col md:flex-row lg:flex-row justify-between md:mx-2 lg:mx-2">
                <textarea rows="10" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" style="min-height: 6.725rem" id="content" name="content" required readonly>{{ $product->content }}</textarea>
            </div>
        </div>
    </div>
    <!--/Grid Form-->
</div>
<div id='productDetailFormModal' class="modal-wrapper">
    <div class="overlay close-modal"></div>
    <div class="modal modal-centered">
        <div class="modal-content shadow-lg p-5">
            <div class="border-b p-2 pb-3 pt-0 mb-4">
                <div class="flex justify-between items-center">
                    Thêm mới
                    <span class='close-modal cursor-pointer px-3 py-1 rounded-full bg-gray-100 hover:bg-gray-200'>
                        <i class="fas fa-times text-gray-700"></i>
                    </span>
                </div>
            </div>
            <!-- Modal content -->
            <form id='form_productdetail' class="w-full" method="POST" action="{{ route('backend_productdetail.store', $product->product_id)}}">
                @csrf
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1" for="color">
                            Mã sản phẩm
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white-500" id="product_id" name="product_id" type="text" value="{{$product->product_id}}">
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1" for="color">
                            Màu sắc
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white-500" id="color" name="color" type="text" placeholder="Color">
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1" for="size">
                            Kích cỡ
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white-500" id="size" name="size" type="text" placeholder="Size">
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1" for="number">
                            Số lượng
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white-500" id="number" name="number" type="number" placeholder="">
                    </div>
                </div>
                <div class="mt-5">
                    <button type="submit" class='bg-green-500 hover:bg-green-800 text-white font-bold py-2 px-4 rounded'> Thêm </button>
                    <span class='close-modal cursor-pointer bg-red-200 hover:bg-red-500 text-red-900 font-bold py-2 px-4 rounded'>
                        Đóng
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>
@endauth
@endsection