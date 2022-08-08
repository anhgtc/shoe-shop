@extends('layouts.frontend_app')
@section('content')
<div class="container mx-auto p-5">
    <div class="md:flex md:flex-row mt-20">
        <div class="md:w-2/5 flex flex-col justify-center items-center">
            <h2 class="font-serif text-5xl text-gray-600 mb-4 text-center md:self-start md:text-left">Some Catchy Title Here</h2>
            <p class="uppercase text-gray-600 tracking-wide text-center md:self-start md:text-left">Our brand tagline goes here.</p>
            <p class="uppercase text-gray-600 tracking-wide text-center md:self-start md:text-left">Our brand motto goes here.</p>
            <a href="{{route('products.index')}}" class="bg-gradient-to-r from-red-600 to-pink-500 rounded-full py-4 px-8 text-gray-50 uppercase text-xl md:self-start my-5">Mua ngay</a>
        </div>
        <div class="md:w-1/2">
            <img src="https://yome.vn/logo-cac-hang-giay-noi-tieng/imager_16_36862_700.jpg" class="w-full" />
        </div>
    </div>

    <div class="my-10">
        <div class="flex flex-row justify-between my-5">
            <h2 class="text-3xl">Nam</h2>
            <a href="{{route('products.classify', '9')}}" class="flex flex-row text-lg hover:text-purple-700">
                Xem tất cả
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
        </div>
        <div class="grid grid-flow-row grid-cols-1 md:grid-cols-3 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-10">
            @foreach ($menproducts as $menproduct)
            <div class="shadow-lg rounded-lg">
                <a href="{{route('products.show', $menproduct->product_id)}}" class="flex justify-center h-1/3">
                    @if ($menproduct->getFirstMediaUrl('images_url', 'small'))
                    <img width="100" height="100" src="{{ asset($menproduct->getFirstMediaUrl('images_url', 'small')) }}">
                    @endif
                </a>
                <div class="p-5 h-2/3">
                    <h3 class="h-2/5"><a href="{{route('products.show', $menproduct->product_id)}}" class="text-sm">{{$menproduct->name}}</a></h3>
                    <div class="flex flex-col xl:flex-row justify-center h-3/10">
                        <a class="text-red-400">{{$menproduct->price}} ₫</a>
                    </div>
                    <div class="flex flex-col xl:flex-row justify-center h-3/10">
                        <a class="bg-gradient-to-r from-red-600 to-pink-500 rounded-full py-2 px-4 my-2 text-sm text-white hover:bg-pink-600 hover:from-pink-600 hover:to-pink-600 flex flex-row justify-center" href="{{route('products.show', $menproduct->product_id)}}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Mua
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div> <!-- Men's Collection Section -->


    <div class="my-10">
        <div class="flex flex-row justify-between my-5">
            <h2 class="text-3xl">Nữ</h2>
            <a href="{{route('products.classify', '10')}}" class="flex flex-row text-lg hover:text-purple-700">
                Xem tất cả
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
        </div>
        <div class="grid grid-flow-row grid-cols-1 md:grid-cols-3 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-10">
            @foreach ($womenproducts as $womenproduct)
            <div class="shadow-lg rounded-lg">
                <a href="{{route('products.show', $womenproduct->product_id)}}" class="flex justify-center h-1/3">
                    @if ($menproduct->getFirstMediaUrl('images_url', 'small'))
                    <img class="" width="100" height="100" src="{{ asset($womenproduct->getFirstMediaUrl('images_url', 'small')) }}">
                    @endif
                </a>
                <div class="p-5 h-2/3">
                    <h3 class="h-2/5"><a href="{{route('products.show', $womenproduct->product_id)}}" class="text-sm">{{$womenproduct->name}}</a></h3>
                    <div class="flex flex-col xl:flex-row justify-center h-3/10">
                        <a class="text-red-400">{{$womenproduct->price}} ₫</a>
                    </div>
                    <div class="flex flex-col xl:flex-row justify-center h-3/10">
                        <a class="bg-gradient-to-r from-red-600 to-pink-500 rounded-full py-2 px-4 my-2 text-sm text-white hover:bg-pink-600 hover:from-pink-600 hover:to-pink-600 flex flex-row justify-center" href="{{route('products.show', $womenproduct->product_id)}}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Mua
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="rounded-lg shadow-lg my-20 flex flex-row">
        <div class="lg:w-3/5 w-full bg-gradient-to-r from-black to-purple-900 lg:from-black lg:via-purple-900 lg:to-transparent rounded-lg text-gray-100 p-12">
            <div class="lg:w-1/2">
                <h3 class="text-2xl font-extrabold mb-4">Subscribe to get our offers first</h3>
                <p class="mb-4 leading-relaxed">Want to hear from us when we have new offers? Sign up for our newsletter and we'll email you every time we have new sale offers.</p>
                <div>
                    <input type="email" placeholder="Enter email address" class="bg-gray-600 text-gray-200 placeholder-gray-400 px-4 py-3 w-full rounded-lg focus:outline-none mb-4" />
                    <button type="submit" class="bg-red-600 py-3 rounded-lg w-full">Subscribe</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection