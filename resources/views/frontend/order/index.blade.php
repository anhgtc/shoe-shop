@extends('layouts.frontend_app')
@section('content')
@auth
<div class="flex flex-col md:flex-row p-1 h-auto mx:auto my:auto">
    <aside class="md:w-1/7 lg:w-1/7 px-1 p-1">
        <ul>
            <li>
                <a href="#" class="block px-1 py-3 text-gray-800 hover:bg-blue-100 hover:text-blue-500 rounded-md flex">
                    <span aria-hidden="true">
                        <svg class="text-black opacity-50" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </span>
                    <span class="ml-3 text-black" id="" >Tài khoản của tôi</span>
                </a>
            </li>
            <li>
                <a href="#" class="block px-1 py-3 text-gray-800 hover:bg-blue-100 hover:text-blue-500 flex">
                    <span aria-hidden="true">
                        <svg class="text-black opacity-50" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                    </span>
                    <span class="ml-3 text-black">Đơn mua</span>
                </a>
            </li>
        </ul>
    </aside>
    <div class="flex flex-1  flex-col md:flex-row lg:flex-row mx-2 bg-white">
    <div class="mb-2 border-solid border-gray-300 rounded border shadow-sm w-full h-auto">
        <div class="bg-gray-200 px-2 py-3 border-solid border-gray-200 border-b">
            <strong class="flex justify-center">Danh sách đơn hàng</strong>
        </div>
        <div class="p-3">
            <table class="table-responsive px-2 py-3 rounded w-full">
                <thead>
                    <tr>
                        <th class="border w-1/6 px-4 py-2 text-center border-red-600">
                            <a href="{{route('orders.index')}}" class="w-full">Tất cả</a>
                        </th>
                        @foreach ($status as $sta)
                        <th class="border w-1/6 px-4 py-2 text-center border-red-600">
                            <a href="{{route('orders.filter', $sta->status_id)}}" class="w-full">{{$sta->name}}</a>
                        </th>
                        @endforeach
                    </tr>
                </thead>
            </table>
        </div>
        <div class="p-1 h-auto">
            @foreach ($orders as $order)
            <div class="bg-gray-200 px-2 py-3 border-solid border-gray-100 border-b mt-3 rounded">
                <div class="relative">
                    <a class="rounded border border-solid p-1 bg-yellow-400 text-xs">{{$order->status->name}}</a>
                    <a class="ml-2 text-sm">Mã đơn hàng: <a class="text-red-400 text-xs">{{$order->order_id}}</a></a>
                    <a class="ml-2 text-sm">Ngày tạo: <a class="text-red-400 text-xs">{{$order->created_at}}</a></a>
                    <a class="ml-2 text-sm">Ngày cập nhật: <a class="text-red-400 text-xs">{{$order->updated_at}}</a></a>
                    <a class="ml-2 text-sm">Giá trị đơn hàng: <a class="text-red-400 text-xs">{{$order->total_price}} ₫</a></a>
                </div>
                <div class="static mt-5">
                    <strong class="static text-sm">{{$order->name}}</strong>
                    <strong class="inline-block ml-5 text-sm">{{$order->phone}}</strong>
                    <strong class="inline-block ml-5 text-sm">{{$order->email}}</strong>
                    <a class="inline-block ml-5 text-sm">{{$order->address}}</a>
                    <a href="{{route('orders.show', $order->id)}}" class="inline-block ml-5 text-sm border rounded bg-red-400 p-1">Chi tiết</a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="pt-4">
            {{ $orders->onEachSide(1)->appends(request()->except('page'))->links() }}
        </div>
    </div>
</div>
</div>
@endauth
@endsection