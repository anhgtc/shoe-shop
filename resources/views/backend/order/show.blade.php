@extends('layouts.backend_app')
@section('content')
@auth
<div class="flex flex-1 bg-white flex-col md:flex-row lg:flex-row mx-2 rounded ">
    <div class="mb-2 border-solid border-gray-300 rounded border shadow-sm w-full">
        <div class="bg-gray-400 px-2 py-3 border-solid border-gray-400 border-b">
            <strong class="flex justify-center">Chi tiết đơn hàng</strong>
        </div>
        <div class="relative pt-1 bg-yellow-300">
            <div class="flex flex-wrap lg:flex-row gap-5 mb-4">
                <div class="w-2/5 lg:w-2/5 xl:w-2/4">
                    <p><a class="p-1 font-semibold not-italic">Sản phẩm </a></p>
                </div>
                <div class="w-1/5">
                    <p class="text-center font-semibold not-italic p-1">Số lượng</p>
                </div>
                <div class="w-1/5">
                    <p class="font-semibold not-italic p-1">Thành tiền</p>
                </div>
            </div>
        </div>
        <div class="relative mt-10">
            @foreach ($orderdetails as $orderdetail)
            <div class="flex flex-wrap lg:flex-row gap-5 mb-4">
                <div class="w-2/5 lg:w-2/5 xl:w-2/4">
                    <figure class="flex leading-5">
                        <div>
                            <div class="block w-16 h-16 rounded border border-gray-200 overflow-hidden">
                                <img width="100" height="100" src="{{ $orderdetail->image }}">
                            </div>
                        </div>
                        <figcaption class="ml-3">
                            <p><a>{{$orderdetail->product}} </a></p>
                            <small class="mt-1 text-black"> {{$orderdetail->productdetail}} </small>
                        </figcaption>
                    </figure>
                </div>
                <div class="w-1/5">
                    <p class="text-center py-2 text-red-600">{{$orderdetail->number}}</p>
                </div>
                <div class="w-1/5">
                    <div class="leading-5">
                        <p class="font-semibold not-italic">{{$orderdetail ->price * $orderdetail ->number}} ₫</p>
                        <small class="text-black"> {{$orderdetail ->price}} ₫ / sản phẩm </small>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endauth
@endsection