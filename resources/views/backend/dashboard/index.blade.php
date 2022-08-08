@extends('layouts.backend_app')
@section('content')
@auth
<section>
    <div id="main" class="main-content flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">

        <div class="bg-gray-800 pt-3">
            <div class="rounded-tl-3xl bg-gradient-to-r from-blue-900 to-gray-800 p-4 shadow text-2xl text-white">
                <h1 class="font-bold pl-2">Thống kê</h1>
            </div>
        </div>

        <div class="flex flex-wrap">
            <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                <div class="bg-gradient-to-b from-green-200 to-green-100 border-b-4 border-green-600 rounded-lg shadow-xl p-5">
                    <div class="flex flex-row items-center">
                        <div class="flex-shrink pr-4">
                            <div class="rounded-full p-5 bg-green-600"><i class="fa fa-wallet fa-2x fa-inverse"></i></div>
                        </div>
                        <div class="flex-1 text-right md:text-center">
                            <h2 class="font-bold uppercase text-gray-600">Tổng doanh thu</h2>
                            <p class="font-bold text-3xl">{{$total_prices}} VNĐ <span class="text-green-500"><i class="fas fa-caret-up"></i></span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                <div class="bg-gradient-to-b from-pink-200 to-pink-100 border-b-4 border-pink-500 rounded-lg shadow-xl p-5">
                    <div class="flex flex-row items-center">
                        <div class="flex-shrink pr-4">
                            <div class="rounded-full p-5 bg-pink-600"><i class="fas fa-users fa-2x fa-inverse"></i></div>
                        </div>
                        <div class="flex-1 text-right md:text-center">
                            <h2 class="font-bold uppercase text-gray-600">Tổng số tài khoản</h2>
                            <p class="font-bold text-3xl">{{$total_users}}<span class="text-pink-500"></span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                <div class="bg-gradient-to-b from-yellow-200 to-yellow-100 border-b-4 border-yellow-600 rounded-lg shadow-xl p-5">
                    <div class="flex flex-row items-center">
                        <div class="flex-shrink pr-4">
                            <div class="rounded-full p-5 bg-yellow-600"><i class="fas fa-receipt fa-2x fa-inverse"></i></div>
                        </div>
                        <div class="flex-1 text-right md:text-center">
                            <h2 class="font-bold uppercase text-gray-600">Tổng số sản phẩm</h2>
                            <p class="font-bold text-3xl">{{$total_products}}<span class="text-yellow-600"></span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                <div class="bg-gradient-to-b from-blue-200 to-blue-100 border-b-4 border-blue-500 rounded-lg shadow-xl p-5">
                    <div class="flex flex-row items-center">
                        <div class="flex-shrink pr-4">
                            <div class="rounded-full p-5 bg-blue-600"><i class="fas fa-server fa-2x fa-inverse"></i></div>
                        </div>
                        <div class="flex-1 text-right md:text-center">
                            <h2 class="font-bold uppercase text-gray-600">Số danh mục sản phẩm</h2>
                            <p class="font-bold text-3xl">{{$total_categories}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                <div class="bg-gradient-to-b from-indigo-200 to-indigo-100 border-b-4 border-indigo-500 rounded-lg shadow-xl p-5">
                    <div class="flex flex-row items-center">
                        <div class="flex-shrink pr-4">
                            <div class="rounded-full p-5 bg-indigo-600"><i class="fas fa-tasks fa-2x fa-inverse"></i></div>
                        </div>
                        <div class="flex-1 text-right md:text-center">
                            <h2 class="font-bold uppercase text-gray-600">Số thương hiệu sản phẩm</h2>
                            <p class="font-bold text-3xl">{{$total_brands}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                <div class="bg-gradient-to-b from-red-200 to-red-100 border-b-4 border-red-500 rounded-lg shadow-xl p-5">
                    <div class="flex flex-row items-center">
                        <div class="flex-shrink pr-4">
                            <div class="rounded-full p-5 bg-red-600"><i class="fas fa-inbox fa-2x fa-inverse"></i></div>
                        </div>
                        <div class="flex-1 text-right md:text-center">
                            <h2 class="font-bold uppercase text-gray-600">Số đơn hàng</h2>
                            <p class="font-bold text-3xl">{{$total_orders}} <span class="text-red-500"><i class="fas fa-caret-up"></i></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form method="POST" action="{{route('backend_dashboard.filter')}}">
            @csrf
            <div class="flex flex-row pl-6">
                <div class="w-full md:w-1/4 xl:w-1/4">
                    <p class=""> Từ ngày: <input type="date" id="start_date" name="start_date" value="{{old('start_date')}}">
                    </p>
                </div>
                <div class="w-full md:w-1/4 xl:w-1/4">
                    <p>Đến ngày: <input type="date" id="end_date" name="end_date" value="{{old('end_date')}}">
                    </p>
                </div>
                <div class="w-full md:w-1/4 xl:w-1/4">
                    <button type="submit" class="border rounded px-2 border-blue-400 bg-blue-400 text-white">Lọc kết quả</button>
                </div>
            </div>
            <div class="flex flex-row flex-wrap flex-grow mt-1">

                <div class="w-full md:w-1/2 xl:w-1/2 p-6">
                    <div class="bg-white border-transparent rounded-lg shadow-xl">
                        <div class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
                            <h2 class="font-bold uppercase text-gray-600">Doanh số bán hàng</h2>
                        </div>
                        <div class="p-5">
                            {!! $chartjs_price->render() !!}
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2 xl:w-1/2 p-6">
                    <div class="bg-white border-transparent rounded-lg shadow-xl">
                        <div class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
                            <h2 class="font-bold uppercase text-gray-600">Số lượng đơn hàng</h2>
                        </div>
                        <div class="p-5">
                            {!! $chartjs_order->render() !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-row flex-wrap flex-grow mt-1">
                <div class="w-full p-6">
                    <div class="bg-white border-transparent rounded-lg shadow-xl">
                        <div class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
                            <h5 class="font-bold uppercase text-gray-600">Top sản phẩm bán chạy</h5>
                        </div>
                        <div class="p-5">
                            {!! $chartjs_product->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </form>


    </div>
    </div>
</section>
@endauth
@endsection