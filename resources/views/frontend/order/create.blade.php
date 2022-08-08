@extends('layouts.frontend_app')
@section('content')
@auth


<div class="flex flex-col md:flex-row gap-4 lg:gap-8 p-3">
    <form method="POST" action="{{route('orders.store')}}" class="md:w-2/3">
        @csrf
        <div>
            <article class="border border-gray-200 bg-white shadow-sm rounded p-4 lg:p-6 mb-5">

                <h2 class="text-xl font-semibold mb-5">Thông tin giao hàng</h2>
                <div class="">
                    <div class="mb-4">
                        <label class="block mb-1"> Họ và tên </label>
                        <input id="name" name="name" class="appearance-none border border-gray-200 bg-gray-100 rounded-md py-2 px-3 hover:border-gray-400 focus:outline-none focus:border-gray-400 w-full" type="text" placeholder="Họ và tên" required="">
                    </div>
                </div>

                <div class="grid lg:grid-cols-2 gap-x-3">
                    <div class="mb-4">
                        <label class="block mb-1"> Số điện thoại </label>
                        <div class="flex  w-full">
                            <input id="phone" name="phone" class="appearance-none flex-1 border border-gray-200 bg-gray-100 rounded-tr-md rounded-br-md py-2 px-3 hover:border-gray-400 focus:outline-none focus:border-gray-400" type="text" placeholder="Số điện thoại" required="">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1"> Email </label>
                        <input id="email" name="email" class="appearance-none border border-gray-200 bg-gray-100 rounded-md py-2 px-3 hover:border-gray-400 focus:outline-none focus:border-gray-400 w-full" type="email" id="email" name="email" placeholder="Email" required="">
                    </div>
                </div>

                <div class="gap-x-3">
                    <div class="mb-4 md:col-span-2">
                        <label class="block mb-1"> Địa chỉ </label>
                        <input id="address" name="address" class="appearance-none border border-gray-200 bg-gray-100 rounded-md py-2 px-3 hover:border-gray-400 focus:outline-none focus:border-gray-400 w-full" type="text" placeholder="Địa chỉ" required="">
                    </div>
                </div>
                <form method="" action="">
                    {{ csrf_field() }}
                    <div class="grid md:grid-cols-3 gap-x-3">
                        <div class="mb-4 md:col-span-1">
                            <label class="block mb-1"> Tỉnh/Thành phố </label>
                            <div class="relative">
                                <select name="province" id="province" class="block appearance-none border border-gray-200 bg-gray-100 rounded-md py-2 px-3 hover:border-gray-400 focus:outline-none focus:border-gray-400 w-full">
                                    <option value=""></option>
                                    @foreach($provinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                    @endforeach
                                </select>
                                <i class="absolute inset-y-0 right-0 p-2 text-gray-400">
                                    <svg width="22" height="22" class="fill-current" viewBox="0 0 20 20">
                                        <path d="M7 10l5 5 5-5H7z" />
                                    </svg>
                                </i>
                            </div>
                        </div>
                        <div class="mb-4 md:col-span-1">
                            <label class="block mb-1"> Quận/Huyện </label>
                            <div class="relative">
                                <select name="district" id="district" class="block appearance-none border border-gray-200 bg-gray-100 rounded-md py-2 px-3 hover:border-gray-400 focus:outline-none focus:border-gray-400 w-full">
                                    <option value=""></option>

                                </select>
                                <i class="absolute inset-y-0 right-0 p-2 text-gray-400">
                                    <svg width="22" height="22" class="fill-current" viewBox="0 0 20 20">
                                        <path d="M7 10l5 5 5-5H7z" />
                                    </svg>
                                </i>
                            </div>
                        </div>
                        <div class="mb-4 md:col-span-1">
                            <label class="block mb-1"> Phường/Xã </label>
                            <div class="relative">
                                <select name="ward" id="ward" class="block appearance-none border border-gray-200 bg-gray-100 rounded-md py-2 px-3 hover:border-gray-400 focus:outline-none focus:border-gray-400 w-full">
                                    <option value=""></option>
                                </select>
                                <i class="absolute inset-y-0 right-0 p-2 text-gray-400">
                                    <svg width="22" height="22" class="fill-current" viewBox="0 0 20 20">
                                        <path d="M7 10l5 5 5-5H7z" />
                                    </svg>
                                </i>
                            </div>
                        </div>
                    </div>
                </form>
                <select class="flex items-center w-max my-4" name="payment_method">
                    <option class="ml-2 inline-block text-gray-500" value="cod"> Thanh toán khi nhận hàng </option>
                    <option class="ml-2 inline-block text-gray-500" value="vnpay"> Thanh toán qua VNPAY </option>
                </select>
                <div class="flex justify-end space-x-2">
                    <a class="px-5 py-2 inline-block text-gray-700 bg-white shadow-sm border border-gray-200 rounded-md hover:bg-gray-100 hover:text-blue-600" href="#"> Trở lại </a>
                    <button type="submit" class="px-5 py-2 inline-block text-white bg-green-600 border border-transparent rounded-md hover:bg-green-700"> Đặt hàng </button>
                </div>

            </article>
        </div>

        <aside class="md:w-1/3">

            <article class="text-gray-600" style="max-width: 350px">
                <h2 class="text-lg font-semibold mb-3">Sản phẩm trong giỏ hàng</h2>
                @foreach ($carts as $cart)
                <figure class="flex items-center mb-4 leading-5">
                    <div>
                        <div class="block relative w-20 h-20 rounded p-1 border border-gray-200">
                            @if ($cart->product->getFirstMediaUrl('images_url', 'small'))
                            <img width="100" height="100" src="{{ asset($cart->product->getFirstMediaUrl('images_url', 'small')) }}">
                            @endif
                            <span class="absolute -top-2 -right-2 w-6 h-6 text-sm text-center flex items-center justify-center text-white bg-gray-400 rounded-full"> {{$cart->number}} </span>
                        </div>
                    </div>
                    <figcaption class="ml-3">
                        <p> {{$cart->product->name}} <br> Màu: {{$cart->productdetail->color}}, Size: {{$cart->productdetail->size}} </p>
                        <p class="mt-1 text-gray-400"> Total: {{$cart->product->price * $cart->number}} ₫ </p>
                    </figcaption>
                </figure>
                @endforeach
                <hr class="my-4">

                <div class="flex gap-3">
                    <input class="appearance-none border border-gray-200 bg-gray-100 rounded-md py-2 px-3 hover:border-gray-400 focus:outline-none focus:border-gray-400 w-full" type="text" placeholder="Coupon code">
                    <button type="button" class="px-4 py-2 inline-block text-gray-700 bg-white shadow-sm border border-gray-200 rounded-md hover:bg-gray-100 hover:text-blue-600"> Apply </button>
                </div>

                <h2 class="text-lg font-semibold mb-3">Summary</h2>
                <ul>
                    <li class="border-t flex justify-between mt-3 pt-3" value="{{$total_price}} ">
                        <span>Tổng cộng:</span>
                        <span class="text-gray-900 font-bold">{{$total_price}} ₫</span>
                    </li>
                </ul>
            </article>
        </aside>
    </form>
</div>
<script type="text/javascript">
    var url1 = "{{ url('/orders/district') }}";
    var url2 = "{{ url('/orders/ward') }}";
    $("select[name='province']").change(function() {
        var province_id = $(this).val();
        var token = $("input[name='_token']").val();
        let district_id;
        $.ajax({
            url: url1,
            method: 'POST',
            data: {
                province_id: province_id,
                _token: token
            },
            success: function(data) {
                $("select[name='district'").html('');
                let i = 0;
                $.each(data, function(key, value) {
                    $("select[name='district']").append(
                        "<option value=" + value.id + ">" + value.name + "</option>"
                    );

                    if (i == 0) {
                        district_id = value.id;
                        i++
                    }

                });

                $.ajax({
                    url: url2,
                    method: 'POST',
                    data: {
                        district_id: district_id,
                        _token: token
                    },
                    success: function(data) {
                        $("select[name='ward'").html('');
                        $.each(data, function(key, value) {
                            $("select[name='ward']").append(
                                "<option value=" + value.id + ">" + value.name + "</option>"
                            );
                        });
                    }
                });
            }
        });

    });
</script>
<script type="text/javascript">
    var url2 = "{{ url('/orders/ward') }}";
    $("select[name='district']").change(function() {

        var district_id = $(this).val();
        var token = $("input[name='_token']").val();
        $.ajax({
            url: url2,
            method: 'POST',
            data: {
                district_id: district_id,
                _token: token
            },
            success: function(data) {
                $("select[name='ward'").html('');
                $.each(data, function(key, value) {
                    $("select[name='ward']").append(
                        "<option value=" + value.id + ">" + value.name + "</option>"
                    );
                });
            }
        });
    });
</script>
@endauth
@endsection