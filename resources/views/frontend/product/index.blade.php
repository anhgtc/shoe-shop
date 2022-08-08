@extends('layouts.frontend_app')
@section('content')
<div class="container mx-auto p-5">
    <section class="py-12">
        <div class="container max-w-screen-xl mx-auto px-4">

            <div class="flex flex-col md:flex-row -mx-4">
                <aside class="md:w-1/3 lg:w-1/4 px-4">

                    <!-- filter wrap -->
                    <div class="hidden md:block px-6 py-4 border border-gray-200 bg-white rounded shadow-sm">
                        <h3 class="font-semibold mb-2">Danh mục sản phẩm</h3>

                        <ul class="text-gray-500 space-y-1">
                            @foreach ($allcategories as $category)
                            <li><a class="hover:text-blue-600 hover:underline" href="{{route('products.classify', $category->category_id)}}">{{$category->name}} </a></li>
                            @endforeach
                        </ul>

                        <hr class="my-4">

                        <h3 class="font-semibold mb-2">Lọc theo</h3>
                        <form method="GET" action="{{route('products.filter')}}">
                            <ul class="space-y-1">
                                <li>
                                    @foreach ($brands as $brand)
                                    <label class="flex items-center">
                                        <input id="brand_id" name="brand_id" type="radio" value="{{$brand->brand_id}}" class="h-4 w-4">
                                        <span class="ml-2 text-gray-500"> {{$brand->name}} </span>
                                    </label>
                                    @endforeach
                                </li>
                            </ul>

                            <hr class="my-4">

                            <h3 class="font-semibold mb-2">Sắp xếp theo</h3>
                            <ul class="space-y-1">
                                <li>
                                    <label class="flex items-center">
                                        <input name="myselection" type="radio" class="h-4 w-4" value="tang">
                                        <span class="ml-2 text-gray-500"> Giá: Tăng dần </span>
                                    </label>
                                </li>
                                <li>
                                    <label class="flex items-center">
                                        <input name="myselection" type="radio" class="h-4 w-4" value="giam">
                                        <span class="ml-2 text-gray-500"> Giá: Giảm dần </span>
                                    </label>
                                </li>
                                <li>
                                    <label class="flex items-center">
                                        <input name="myselection" type="radio" class="h-4 w-4" value="moi">
                                        <span class="ml-2 text-gray-500"> Mới nhất </span>
                                    </label>
                                </li>
                                <li>
                                    <label class="flex items-center">
                                        <input name="myselection" type="radio" class="h-4 w-4" value="cu">
                                        <span class="ml-2 text-gray-500"> Cũ nhất </span>
                                    </label>
                                </li>
                            </ul>
                            <div class="mt-8 p-1 flex-row">
                                <button class="ml-3 inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150" type="submit">
                                    {{ __('Tìm kiếm') }}
                                </button>
                            </div>
                        </form>
                    </div>

                </aside>
                <main class="md:w-2/3 lg:w-3/4 px-4">

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($products as $product)
                        <div>
                            <!-- COMPONENT: PRODUCT CARD -->
                            <article class="shadow-sm rounded bg-white border border-gray-200">
                                <a href="{{route('products.show', $product->product_id)}}" class="block relative p-1 flex justify-center">
                                    @if ($product->getFirstMediaUrl('images_url', 'small'))
                                    <img width="100" height="100" src="{{ asset($product->getFirstMediaUrl('images_url', 'small')) }}">
                                    @endif
                                </a>
                                <div class="p-4 border-t border-t-gray-200 h-40">
                                    <div class="h-1/2"> <a href="{{route('products.show', $product->product_id)}}" class="text-gray-600 mb-3 hover:text-blue-500 block">
                                            {{$product->name}}
                                        </a></div>
                                    <div class="h-1/2">
                                        <p class="font-semibold flex justify-center p-1">{{$product->price}} ₫</p>

                                        <a class="ml-5 px-4 py-2 inline-block text-white text-center bg-red-400 border border-transparent rounded-md hover:bg-blue-700" href="{{route('products.show', $product->product_id)}}">
                                            Add to cart
                                        </a>
                                        <a href="#" class="rounded-full w-10 h-10 bg-gray-200 p-0 border-0 inline-flex items-center justify-center text-gray-500 ml-10 p-1">
                                            <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                                <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </article>
                            <!-- COMPONENT: PRODUCT CARD //END -->
                        </div>
                        @endforeach

                    </div>
                    <div class="pt-4">
                        {{ $products->onEachSide(1)->appends(request()->except('page'))->links() }}
                    </div> <!-- grid .// -->

                </main> <!-- col.// -->
            </div> <!-- grid.// -->

        </div>
    </section>
</div>
@endsection