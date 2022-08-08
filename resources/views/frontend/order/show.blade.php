@extends('layouts.frontend_app')
@section('content')
@auth
<div class="flex flex-col md:flex-row p-3 h-auto">
    <aside class="md:w-1/3 lg:w-1/4 px-4 p-4">
        <ul>
            <li class="hover:bg-blue-100 relative">
                <a href="#" class="block px-3 py-2 text-gray-800 hover:bg-blue-100 hover:text-blue-500 rounded-md flex">
                    <span aria-hidden="true">
                        <svg class="text-black opacity-50" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </span>
                    <button class="ml-3 text-black" id="dropdownDefault" data-dropdown-toggle="dropdown">Tài khoản của tôi</button>
                    <div id="dropdown" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
                            <li>
                                <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                            </li>
                            <li>
                                <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
                            </li>
                            <li>
                                <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Earnings</a>
                            </li>
                            <li>
                                <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sign out</a>
                            </li>
                        </ul>
                    </div>
                </a>
            </li>
            <li>
                <a href="#" class="block px-3 py-2 text-gray-800 hover:bg-blue-100 hover:text-blue-500 flex">
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
    <div class="mb-2 border-solid border-gray-300 rounded border shadow-sm w-full">
        <div class="bg-gray-400 px-2 py-3 border-solid border-gray-400 border-b">
            <strong class="flex justify-center">Chi tiết đơn hàng</strong>
        </div>
        <div class="p-1">

            <div class="px-4 py-4 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-4 lg:px-4 lg:py-4">
                <div class="font-bold">Mã đơn hàng:
                    <a class="text-xs text-red-400">{{$order->order_id}}</a>
                    |
                    <a>Trạng thái: <a class="text-xs text-red-400"> {{$order->status->name}}</a></a>

                </div>
                <div class="flex flex-row pt-5">
                    @if ($order->status_id == '5')
                    <div class="relative text-center w-1/2">
                        <div class="flex items-center justify-center w-10 h-10 mx-auto mb-4 rounded-full bg-indigo-50 sm:w-15 sm:h-15">
                            <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
                                <path strokeLinecap="round" strokeLinejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                        </div>

                        <h6 class="mb-2 text-base">Đơn hàng đã đặt</h6>
                        <p class="max-w-md mb-1 text-gray-900 sm:mx-auto text-xs">
                            {{$order->created_at}}
                        </p>
                        <div class="top-0 right-0 flex items-center justify-center h-24 lg:-mr-8 lg:absolute">
                            <svg class="w-5 text-gray-700 transform rotate-90 lg:rotate-0" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <line fill="none" stroke-miterlimit="10" x1="2" y1="12" x2="22" y2="12"></line>
                                <polyline fill="none" stroke-miterlimit="10" points="15,5 22,12 15,19 "></polyline>
                            </svg>
                        </div>
                    </div>
                    <div class="relative text-center w-1/2">
                        <div class="flex items-center justify-center w-10 h-10 mx-auto mb-4 rounded-full bg-indigo-50 sm:w-15 sm:h-15">
                            <svg xmlns="http://www.w3.org/2000/svg" className="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fillRule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clipRule="evenodd" />
                            </svg>
                        </div>

                        <h6 class="mb-2 text-base">Đơn hàng đã bị hủy</h6>
                        <p class="max-w-md mb-1 text-gray-900 sm:mx-auto text-xs">
                            {{$order->updated_at}}
                        </p>
                    </div>
                    @else
                    @foreach($orderstatus as $ordersta)
                    @if ($ordersta->status_id < 5) @if ($ordersta->status_id == '1')
                        <div class="relative text-center w-1/4">
                            <div class="flex items-center justify-center w-10 h-10 mx-auto mb-4 rounded-full bg-indigo-50 sm:w-15 sm:h-15">
                                <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
                                    <path strokeLinecap="round" strokeLinejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                </svg>
                            </div>

                            <h6 class="mb-2 text-base">Đơn hàng đã đặt</h6>
                            <p class="max-w-md mb-1 text-xs text-gray-900 sm:mx-auto">
                                {{$ordersta->time}}
                            </p>
                            @if ($ordersta->status_id < 4) <div class="top-0 right-0 flex items-center justify-center h-10 lg:-mr-4 lg:absolute">
                                <svg class="w-5 text-gray-700 transform rotate-90 lg:rotate-0" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <line fill="none" stroke-miterlimit="10" x1="2" y1="12" x2="22" y2="12"></line>
                                    <polyline fill="none" stroke-miterlimit="10" points="15,5 22,12 15,19 "></polyline>
                                </svg>
                        </div>
                        @endif
                </div>
                @endif
                @if ($ordersta->status_id == '2')
                <div class="relative text-center w-1/4">
                    <div class="flex items-center justify-center w-10 h-10 mx-auto mb-4 rounded-full bg-indigo-50 sm:w-15 sm:h-15">
                        <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
                            <path strokeLinecap="round" strokeLinejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </div>

                    <h6 class="mb-2 text-base">Đã xác nhận đơn hàng</h6>
                    <p class="max-w-md mb-1 text-xs text-gray-900 sm:mx-auto">
                        {{$ordersta->time}}
                    </p>
                    @if ($ordersta->status_id < 4) <div class="top-0 right-0 flex items-center justify-center h-10 lg:-mr-4 lg:absolute">
                        <svg class="w-5 text-gray-700 transform rotate-90 lg:rotate-0" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <line fill="none" stroke-miterlimit="10" x1="2" y1="12" x2="22" y2="12"></line>
                            <polyline fill="none" stroke-miterlimit="10" points="15,5 22,12 15,19 "></polyline>
                        </svg>
                </div>
                @endif
            </div>
            @endif
            @if ($ordersta->status_id == '3')
            <div class="relative text-center w-1/4">
                <div class="flex items-center justify-center w-10 h-10 mx-auto mb-4 rounded-full bg-indigo-50 sm:w-15 sm:h-15">
                    <svg xmlns="http://www.w3.org/2000/svg" className="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                        <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z" />
                    </svg>
                </div>

                <h6 class="mb-2 text-base">Đã giao cho ĐVVC</h6>
                <p class="max-w-md mb-1 text-xs text-gray-900 sm:mx-auto">
                    {{$ordersta->time}}
                </p>
                @if ($ordersta->status_id < 4) <div class="top-0 right-0 flex items-center justify-center h-10 lg:-mr-4 lg:absolute">
                    <svg class="w-5 text-gray-700 transform rotate-90 lg:rotate-0" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <line fill="none" stroke-miterlimit="10" x1="2" y1="12" x2="22" y2="12"></line>
                        <polyline fill="none" stroke-miterlimit="10" points="15,5 22,12 15,19 "></polyline>
                    </svg>
            </div>
            @endif
        </div>
        @endif
        @if ($ordersta->status_id == '4')
        <div class="relative text-center w-1/4">
            <div class="flex items-center justify-center w-10 h-10 mx-auto mb-4 rounded-full bg-indigo-50 sm:w-15 sm:h-15">
                <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
                    <path strokeLinecap="round" strokeLinejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                </svg>
            </div>

            <h6 class="mb-2 text-base">Đã nhận</h6>
            <p class="max-w-md mb-1 text-xs text-gray-900 sm:mx-auto">
                {{$ordersta->time}}
            </p>
            @if ($ordersta->status_id < 4) <div class="top-0 right-0 flex items-center justify-center h-10 lg:-mr-4 lg:absolute">
                <svg class="w-5 text-gray-700 transform rotate-90 lg:rotate-0" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <line fill="none" stroke-miterlimit="10" x1="2" y1="12" x2="22" y2="12"></line>
                    <polyline fill="none" stroke-miterlimit="10" points="15,5 22,12 15,19 "></polyline>
                </svg>
        </div>
        @endif
    </div>
    @endif
    @endif
    @endforeach
    @endif
</div>

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
<div class="relative mt-5">
    @foreach ($orderdetails as $orderdetail)
    <div class="flex flex-wrap lg:flex-row gap-5 mb-4 p-1">
        <div class="w-2/5 lg:w-2/5 xl:w-2/4">
            <figure class="flex leading-5">
                <div>
                    <div class="block w-16 h-16 rounded border border-gray-200 overflow-hidden">
                        <img width="100" height="100" src="{{ $orderdetail->image }}">
                    </div>
                </div>
                <figcaption class="ml-3">
                    <p><a>{{$orderdetail ->product}} </a></p>
                    <small class="mt-1 text-black"> {{$orderdetail->productdetail}} </small>
                </figcaption>
            </figure>
        </div>
        <div class="w-1/5">
            <p class="text-center py-2 text-red-600">{{$orderdetail->number}}</p>
        </div>
        <div class="w-1/5">
            <div class="leading-5">
                <p class="font-semibold not-italic">{{$orderdetail->price * $orderdetail ->number}} ₫</p>
                <small class="text-black"> {{$orderdetail->price}} ₫ / sản phẩm </small>
            </div>
        </div>
    </div>
    @endforeach
</div>
</div>
</div>
</div>
@endauth
@endsection