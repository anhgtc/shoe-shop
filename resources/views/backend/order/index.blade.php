@extends('layouts.backend_app')
@section('content')
<!--Grid Form-->
<div class="flex flex-1  flex-col md:flex-row lg:flex-row mx-2 bg-white">
    <div class="mb-2 border-solid border-gray-300 rounded border shadow-sm w-full">
        <div class="bg-gray-200 px-2 py-3 border-solid border-gray-200 border-b">
            <strong class="flex justify-center">Danh sách đơn hàng</strong>
        </div>
        <div class="p-3">
            <table class="table-responsive px-2 py-3 rounded w-full">
                <thead>
                    <tr>
                        <th class="border w-1/6 px-4 py-2 text-center border-red-600">
                            <a href="{{route('backend_order.index')}}" class="w-full">Tất cả</a>
                        </th>
                        @foreach ($status as $sta)
                        <th class="border w-1/6 px-4 py-2 text-center border-red-600">
                            <a href="{{route('backend_order.filter', $sta->status_id)}}" class="w-full">{{$sta->name}}</a>
                        </th>
                        @endforeach
                    </tr>
                </thead>
            </table>
        </div>
        <div class="p-1">
            @foreach ($orders as $order)
            <form method="POST" action="{{ route('backend_order.update', $order->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="bg-gray-200 px-2 py-3 border-solid border-gray-100 border-b mt-3 rounded">
                    <div class="relative">
                        <a class="rounded border border-solid p-1 bg-yellow-400 text-xs">{{$order->status->name}}</a>
                        <a class="ml-3 text-sm">Mã đơn hàng: <a class="text-red-400 text-xs">{{$order->order_id}}</a></a>
                        <a class="ml-3 text-sm">Ngày tạo: <a class="text-red-400 text-xs">{{$order->created_at}}</a></a>
                        <a class="ml-3 text-sm">Ngày cập nhật: <a class="text-red-400 text-xs">{{$order->updated_at}}</a></a>
                        <a class="ml-3 text-sm">Giá trị đơn hàng: <a class="text-red-400 text-xs">{{$order->total_price}} ₫</a></a>
                        <div class="absolute right-0">
                            <select id="order_status" name="order_status" class="rounded border appearance-none border-gray-400 p-1 focus:outline-none focus:border-red-500 text-xs">
                                <option value="{{$order->status_id}}" class="text-xs">{{$order->status->name}}</option>
                                @if ($order->status_id == '1')
                                <option value="2" class="text-xs">Chờ lấy hàng</option>
                                <option value="5" class="text-xs">Đã hủy</option>
                                @elseif ($order->status_id == '2')
                                <option value="3" class="text-xs">Đang giao</option>
                                @elseif ($order->status_id == '3')
                                <option value="4" class="text-xs">Đã nhận</option>
                                @endif
                            </select>
                            <button type="submit" class="p-1 border border-solid rounded bg-blue-600 text-xs">Cập nhật</button>
                        </div>

                    </div>
                    <div class="static mt-5">
                        <strong class="static text-sm">{{$order->name}}</strong>
                        <strong class="inline-block ml-4 text-sm">{{$order->phone}}</strong>
                        <strong class="inline-block ml-4 text-sm">{{$order->email}}</strong>
                        <a class="inline-block ml-4 text-sm">{{$order->address}}</a>
                        <a href="{{route('backend_orderdetail.show', $order->id)}}" class="inline-block ml-5 text-sm border rounded bg-red-400 p-1">Chi tiết</a>
                    </div>
                </div>
            </form>
            @endforeach
        </div>
        <div class="pt-4">
            {{ $orders->onEachSide(1)->appends(request()->except('page'))->links() }}
        </div>
    </div>
</div>
<!--/Grid Form-->
@endsection