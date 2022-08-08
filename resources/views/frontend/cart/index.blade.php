@extends('layouts.frontend_app')
@section('content')

<div class="container mx-auto p-5">
    <section class="py-5 sm:py-7 bg-blue-100">
        <div class="container max-w-screen-xl mx-auto px-4">
            <h2 class="text-3xl font-semibold mb-2">Giỏ hàng của bạn</h2>

        </div>
    </section>
    <section class="py-10">
        <div class="container max-w-screen-xl mx-auto px-4">

            <div class="flex flex-col md:flex-row gap-4">
                <main class="md:w-3/4">

                    <article class="border border-gray-200 bg-white shadow-sm rounded mb-5 p-3 lg:p-5">
                        @if($total_price == '0')
                        <div class="flex flex-wrap lg:flex-row gap-5  mb-4 justify-center">
                        <a class="flex justify-center w-full">Giỏ hàng của bạn đang trống</a>
                        <a type="button" href="{{route('products.index')}}" class="flex justify-center w-auto p-2 border rounded bg-red-400 text-white">Mua ngay</a>
                        </div>
                        @else
                        @foreach ($carts as $cart)
                        <form action="{{route('carts.destroy', $cart->cart_id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="float-right">
                                <button type="submit" class="px-4 py-2 inline-block text-red-600 bg-white shadow-sm border border-gray-200 rounded-md hover:bg-gray-100"> Xóa </button>
                            </div>
                        </form>
                        <form method="POST" action="{{route('carts.update', $cart->cart_id)}}">
                            @csrf
                            @method('PUT')
                            <div class="flex flex-wrap lg:flex-row gap-5  mb-4">
                                <div class="w-full lg:w-2/5 xl:w-2/4">
                                    <figure class="flex leading-5">
                                        <div>
                                            <div class="block w-16 h-16 rounded border border-gray-200 overflow-hidden">
                                                @if ($cart->product->getFirstMediaUrl('images_url', 'small'))
                                                <img width="100" height="100" src="{{ asset($cart->product->getFirstMediaUrl('images_url', 'small')) }}">
                                                @endif
                                            </div>
                                        </div>
                                        <figcaption class="ml-3">
                                            <p><a href="{{route('products.show', $cart->product_id)}}" class="hover:text-blue-600" value="">{{$cart->product->name}} </a></p>
                                            <p class="mt-1 text-gray-400"> Màu: {{$cart->productdetail->color}}, Size: {{$cart->productdetail->size}} </p>
                                        </figcaption>
                                    </figure>
                                </div>
                                <div>
                                    <input class="text-center py-2 inline-block text-red-600 bg-white shadow-sm border border-gray-200 rounded-md hover:bg-gray-100" type="number" value="{{$cart->number}}" name="number" id="number" autocomplete="on" MIN="1" MAX="10">
                                </div>
                                <div>
                                    <div class="leading-5">
                                        <p class="font-semibold not-italic">{{$cart->product->price * $cart->number}} ₫</p>
                                        <small class="text-gray-400"> {{$cart->product->price}} ₫ / sản phẩm </small>
                                    </div>
                                </div>
                                <div class="flex-auto">
                                    <div class="float-right">
                                        <button type="submit" class="px-4 py-2 inline-block text-red-600 bg-white shadow-sm border border-gray-200 rounded-md hover:bg-gray-100"> Cập nhật </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        @endforeach
                        @endif
                        <hr class="my-4">

                    </article>

                </main>
                <aside class="md:w-1/4">

                    <article class="border border-gray-200 bg-white shadow-sm rounded mb-5 p-3 lg:p-5">

                        <ul class="mb-5">
                            <li value="{{$total_price}}" class="flex justify-between text-gray-600 mb-1 font-bold">
                                <span>Tạm tính:</span>
                                <span>{{$total_price}} ₫</span>
                            </li>
                        </ul>

                        <a class="px-4 py-3 mb-2 inline-block text-lg w-full text-center font-medium text-white bg-green-600 border border-transparent rounded-md hover:bg-green-700" href="{{route('orders.create')}}"> Thanh toán ngay </a>
                        <a class="px-4 py-3 inline-block text-lg w-full text-center font-medium text-green-600 bg-white shadow-sm border border-gray-200 rounded-md hover:bg-gray-100" href="{{route('products.index')}}"> Trở lại mua hàng </a>

                    </article>

                </aside>
            </div>

        </div>
    </section>
    <div class="pt-10 pb-20 p-1">
        <div class="container max-w-screen-xl mx-auto px-4">
            <h2 class="text-2xl font-semibold mb-8">Các sản phẩm khác của shop</h2>
            <div class="grid grid-flow-row grid-cols-1 md:grid-cols-3 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-10">
                @foreach ($other_products as $other_product)
                <div class="shadow-lg rounded-lg h-48">
                    <a href="{{route('products.show', $other_product->product_id)}}" class="flex justify-center h-2/5">
                        @if ($other_product->getFirstMediaUrl('images_url', 'small'))
                        <img width="100" height="100" src="{{ asset($other_product->getFirstMediaUrl('images_url', 'small')) }}">
                        @endif
                    </a>
                    <div class="p-2 h-3/5">
                        <h3 class="h-1/2 flex justify-center"><a href="{{route('products.show', $other_product->product_id)}}" class="text-sm">{{$other_product->name}}</a></h3>
                        <div class="flex flex-col xl:flex-row justify-center h-1/2">
                            <a class="text-red-400 text-sm">{{$other_product->price}} ₫</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection 