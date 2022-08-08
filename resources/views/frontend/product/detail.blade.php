@extends('layouts.frontend_app')
@section('content')
<section class="text-gray-700 body-font overflow-hidden bg-white">
    <div class="container px-5 py-10 mx-auto">
        <form method="POST" action="{{ route('carts.store', $product->product_id) }}" enctype="multipart/form-data">
            @csrf
            <div class="mx-auto flex flex-wrap">

                <!-- <img alt="ecommerce" class="lg:w-1/2 w-full object-cover object-center rounded border border-gray-200" src="https://www.whitmorerarebooks.com/pictures/medium/2465.jpg"> -->
                @if ($product->getFirstMediaUrl('images_url'))
                <img class="lg:w-1/2 w-full rounded border border-gray-200" width="100" height="100" src="{{ asset($product->getFirstMediaUrl('images_url')) }}">
                @endif
                <div class="lg:w-1/2 lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                    <li id="product_id" class="text-sm title-font text-gray-500 tracking-widest" value="{{$product->product_id}}">Thương hiệu: {{$product->brand->name}}</li>
                    <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{$product->name}}</h1>
                    <div class="bg-white b-1">
                        <div class="mb-2 border-gray-300 rounded border w-full">
                            <div class="bg-gray-400 px-2 py-3 border-solid border-gray-200 border-b">
                                <strong class="flex justify-center">Mô tả chi tiết</strong>
                            </div>
                            <div class="relative mb-2 w-full">
                                <textarea rows="10" class="leading-relaxed p-1 w-full" readonly>{{$product->content}}</textarea>
                            </div>
                        </div>
                        <div class="mb-2">
                            <a class="text-green-400" href="{{route('products.selectsize')}}">Hướng dẫn cách quy đổi & đo size giày mới nhất 2022</a>
                        </div>
                    </div>
                    <form method="" action="">
                        {{ csrf_field() }}
                        <div class="flex mt-6 items-center mb-5">
                            <div class="flex items-center">
                                <span class="mr-3">Màu sắc:</span>
                                <div class="relative">
                                    <select id="productdetail_color" name="productdetail_color" class="rounded border appearance-none border-gray-400 py-2 focus:outline-none focus:border-red-500 text-base pl-3 pr-10">
                                        <option value=""></option>
                                        @foreach ($productdetails as $productdetail)
                                        <option value="{{$productdetail->color}}">{{$productdetail->color}}</option>
                                        @endforeach
                                    </select>
                                    <span class="absolute right-0 top-0 h-full w-10 text-center text-gray-600 pointer-events-none flex items-center justify-center">
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4" viewBox="0 0 24 24">
                                            <path d="M6 9l6 6 6-6"></path>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div class="flex items-center ml-5">
                                <span class="mr-3">Kích cỡ:</span>
                                <div class="relative">
                                    <select id="productdetail_size" name="productdetail_size" class="rounded border appearance-none border-gray-400 py-2 focus:outline-none focus:border-red-500 text-base pl-3 pr-10">
                                        <option value=""></option>
                                        <option value=""></option>
                                    </select>
                                    <span class="absolute right-0 top-0 h-full w-10 text-center text-gray-600 pointer-events-none flex items-center justify-center">
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4" viewBox="0 0 24 24">
                                            <path d="M6 9l6 6 6-6"></path>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <select name="number" id="number" class="block appearance-none border border-gray-200 bg-gray-100 rounded-md py-2 px-3 hover:border-gray-400 focus:outline-none focus:border-gray-400 w-full">

                        </select>
                    </form>
                    <div class="flex mt-3">
                        <span class="title-font font-medium text-xl text-gray-900">Giá bán: {{$product->price}} ₫</span>
                        <button type="submit" class="flex ml-auto text-white bg-red-500 border-0 py-2 px-6 focus:outline-none hover:bg-red-600 rounded">MUA NGAY</button>
                        <a class="rounded-full w-10 h-10 bg-gray-200 p-0 border-0 inline-flex items-center justify-center text-gray-500 ml-4">
                            <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>
                            </svg>
                        </a>
                    </div>
                </div>


            </div>
        </form>
    </div>
    <div class="pt-10 pb-20 p-1">
        <div class="container max-w-screen-xl mx-auto px-4">
            <h2 class="text-2xl font-semibold mb-8">Các sản phẩm tương tự</h2>
            <div class="grid grid-flow-row grid-cols-1 md:grid-cols-3 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-10">
                @foreach ($similar_products as $similar_product)
                <div class="shadow-lg rounded-lg h-48">
                    <a href="{{route('products.show', $similar_product->product_id)}}" class="flex justify-center h-2/5">
                        @if ($similar_product->getFirstMediaUrl('images_url', 'small'))
                        <img width="100" height="100" src="{{ asset($similar_product->getFirstMediaUrl('images_url', 'small')) }}">
                        @endif
                    </a>
                    <div class="p-2 h-3/5">
                        <h3 class="h-1/2 flex justify-center"><a href="{{route('products.show', $similar_product->product_id)}}" class="text-sm">{{$similar_product->name}}</a></h3>
                        <div class="flex flex-col xl:flex-row justify-center h-1/2">
                            <a class="text-red-400 text-sm">{{$similar_product->price}} ₫</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var url1 = "{{ url('/products/size') }}";
        var url2 = "{{ url('/products/number') }}";

        $("select[name='productdetail_color']").change(function() {
            var productdetail_color = $(this).val();
            var product_id = document.getElementById("product_id").value;
            console.log(product_id)
            var token = $("input[name='_token']").val();
            let productdetail_id;
            $.ajax({
                url: url1,
                method: 'POST',
                data: {
                    product_id: product_id,
                    productdetail_color: productdetail_color,
                    _token: token
                },
                success: function(data) {
                    $("select[name='productdetail_size'").html('');
                    let i = 0;
                    $.each(data, function(key, value) {
                        $("select[name='productdetail_size']").append(
                            "<option value=" + value.productdetail_id + ">" + value.size + "</option>"
                        );

                        if (i == 0) {
                            productdetail_id = value.productdetail_id;
                            i++
                        }

                    });

                    $.ajax({
                        url: url2,
                        method: 'POST',
                        data: {
                            productdetail_id: productdetail_id,
                            _token: token
                        },
                        success: function(data) {
                            $("select[name='number'").html('');
                            $.each(data, function(key, value) {
                                $("select[name='number']").append(
                                    "<option value=" + value.productdetail_id + ">" + "Còn hàng: " + value.number + " sản phẩm</option>"
                                );
                            });
                        }
                    });
                }
            });

        });
    </script>
</section>

<script type="text/javascript">
    var url = "{{ url('/products/number') }}";
    $("select[name='productdetail_size']").change(function() {

        var productdetail_id = $(this).val();
        var token = $("input[name='_token']").val();
        $.ajax({
            url: url,
            method: 'POST',
            data: {
                productdetail_id: productdetail_id,
                _token: token
            },
            success: function(data) {
                $("select[name='number'").html('');
                $.each(data, function(key, value) {
                    $("select[name='number']").append(
                        "<option value=" + value.productdetail_id + ">" + "Còn hàng: " + value.number + " sản phẩm</option>"
                    );
                });
            }
        });
    });
</script>
@endsection