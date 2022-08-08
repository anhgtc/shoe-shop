<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/tailwind.css') }}" rel="stylesheet">
    <link href="{{asset('css/tailwind.min.css')}}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,600i,700,700i" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://code.jquery.com/jquery-latest.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
</head>

<body>
    <div class="container mx-auto p-5">

        <nav class="bg-black border-gray-200 px-2 sm:px-4 py-2.5 rounded dark:bg-gray-800">
            <div class="container flex flex-wrap items-center mx-auto justify-end">
                <div class="hidden w-full md:block md:w-auto " id="#">
                    <ul class="flex justify-end flex-col mt-4 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium">
                        <li>
                            <a href="{{route('home')}}" class="block py-2 pr-4 pl-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white" aria-current="page">Home</a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 pr-4 pl-3 text-white border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">About</a>
                        </li>
                        <li>
                            <a href="{{route('products.index')}}" class="block py-2 pr-4 pl-3 text-white border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Shop</a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 pr-4 pl-3 text-white border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Contact</a>
                        </li>
                        @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <div class="items-center">
                                <a onclick="profileToggle()" class="block py-2 pr-4 pl-3 text-white border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Xin chào, {{Auth::user()->name}}</a>
                                <div id="ProfileDropDown" class="rounded hidden shadow-md bg-white absolute pin-t mt-1 mr-1 pin-r">
                                    <ul class="list-reset">
                                        <li><a href="#" class="no-underline px-4 py-2 block text-black hover:bg-grey-light">Tài khoản của tôi</a></li>
                                        <li><a href="{{route('orders.index')}}" class="no-underline px-4 py-2 block text-black hover:bg-grey-light">Đơn mua</a></li>
                                        <li>
                                            <hr class="border-t mx-2 border-grey-ligght">
                                        </li>
                                        <li><button type="submit" class="no-underline px-4 py-2 block text-black hover:bg-grey-light w-full">Đăng xuất</button></li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                        @else
                        <li>
                            <a href="{{route('login')}}" class="block py-2 pr-4 pl-3 text-white border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Đăng nhập</a>
                        </li>
                        <li>
                            <a href="{{route('register')}}" class="block py-2 pr-4 pl-3 text-white border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Đăng ký</a>
                        </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <div class="flex md:flex-row text-sm sm:text-base pt-5">
            <div class="flex justify-center md:flex md:flex-row"> 
            <div>
                <a class="flex justify-center">
                <img src="https://inkythuatso.com/uploads/thumbnails/800/2021/12/akatsuki-logo-inkythuatso-20-14-09-07.jpg" alt="Akatsuki" width="100" height="100">
                </a>
                <div class="text-red-400 text-xs text-center">
                <div>Akatsuki shop</div>
                </div>
            </div>
            </div>
            <div class="md:flex md:flex-row">
                @foreach ($categories as $category)
                <div class="flex justify-center p-1 ml-10" val>
                    <a href="{{route('products.classify', $category->category_id)}}" class="text-2xl">{{$category->name}}</a>
                </div>
                @endforeach
            </div>

            <div class="md:flex md:flex-row pl-40 p-1">
                <form method="GET" action="{{route('products.search')}}">
                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-gray-300">Search</label>
                    <div class="relatives">
                        <div class="flex absolute items-center p-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" id="search_product" name="search_product" class="px-2 py-3 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tìm kiếm sản phẩm" required="">
                        <button type="submit" class="px-2 py-3 text-white absolute bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tìm kiếm</button>
                    </div>
                </form>
            </div>
            <div class="p-1 pl-80">

                <a href="{{route('carts.index')}}" class="text-gray-50 bg-blue-500 hover:bg-purple-600 p-3 px-3 sm:px-5 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Cart
                </a>

            </div>
        </div>
        <main>
            <div>
                @yield('content')
            </div>
        </main>

        <div class="border-t-2 border-gray-300 flex flex-col md:flex-row md:justify-between text-center py-5 text-sm">
            <div class="mb-4">
                <a href="#" class="mx-2.5">About</a>
                <a href="#" class="mx-2.5">Privacy Policy</a>
                <a href="#" class="mx-2.5">Terms of Services</a>
            </div>
            <p>&copy; Copyright Reserved 2022</p>
        </div><!-- Footer Section -->
    </div>
    @include('sweetalert::alert')
    <script src="{{asset('js/main.js')}}"></script>
</body>

</html>