@extends('layouts.frontend_app')
@section('content')
@auth
<div class="flex flex-col md:flex-row p-3 h-screen">
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
    <main class="md:w-2/3 lg:w-3/4 px-4">

        <article class="border border-gray-200 bg-white shadow-sm rounded mb-5 p-3 lg:p-5">

            <figure class="flex items-start sm:items-center">
                <figcaption>
                    <h5 class="font-semibold text-lg">Hồ sơ của tôi</h5>
                    <h3>Quản lý thông tin hồ sơ để bảo mật tài khoản</h3>
                </figcaption>
            </figure>

            <hr class="my-4">

            <div class="sm:flex mb-5 gap-4">
                
            </div>
        </article>
    </main>
</div>
@endauth
@endsection