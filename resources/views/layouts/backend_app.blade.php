<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Css -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js" integrity="sha256-xKeoJ50pzbUGkpQxDYHD7o7hxe0LaOGeguUidbq6vis=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://code.jquery.com/jquery-latest.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,600i,700,700i" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>

    <title>Admin</title>
</head>

<body>
    <!--Container -->
    <div class="mx-auto bg-grey-lightest">
        <!--Screen-->
        <div class="min-h-screen flex flex-col">
            <!--Header Section Starts Here-->
            <header class="bg-nav">
                <div class="flex justify-between">
                    <div class="p-1 mx-3 inline-flex items-center">
                        <i class="fas fa-bars pr-2 text-white" onclick="sidebarToggle()"></i>
                        <h1 class="text-white p-2">Akatsuki-Shop</h1>
                    </div>
                    <form method="POST" action="{{ route('backend_auth.logout') }}">
                        @csrf
                        <div class="p-3 flex flex-row items-center">
                            <img onclick="profileToggle()" class="inline-block h-8 w-8 rounded-full" src="https://avatars0.githubusercontent.com/u/4323180?s=460&v=4" alt="">
                            <a href="#" onclick="profileToggle()" class="text-white p-2 no-underline hidden md:block lg:block">{{Auth::user()->name}}</a>
                            <div id="ProfileDropDown" class="rounded hidden shadow-md bg-white absolute pin-t mt-12 mr-1 pin-r">
                                <ul class="list-reset">
                                    <li><a href="#" class="no-underline px-4 py-2 block text-black hover:bg-grey-light">My account</a></li>
                                    <li><a href="#" class="no-underline px-4 py-2 block text-black hover:bg-grey-light">Notifications</a></li>
                                    <li>
                                        <hr class="border-t mx-2 border-grey-ligght">
                                    </li>
                                    <li><button type="submit" class="no-underline px-4 py-2 block text-black hover:bg-grey-light w-full">Logout</button></li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </header>
            <!--/Header-->
            <div class="flex flex-1">
                <!--Sidebar-->
                <aside id="sidebar" class="fixed -left-full top-0 bottom-0 md:static z-40 w-60 overflow-y-auto bg-blue-800 flex-shrink-0">
                    <ul>
                        <li class="hover:bg-blue-100 relative">
                            <a href="{{route('backend_dashboard.index')}}" class="flex px-5 py-3 items-center w-full text-white hover:text-white hover:bg-blue-700">
                                <span aria-hidden="true">
                                    <svg class="text-white opacity-50" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg>
                                </span>
                                <span class="ml-3">Dashboard</span>
                            </a>
                        </li>

                        <li class="hover:bg-blue-100 relative">
                            <a href="{{route('backend_product.index')}}" class="flex px-5 py-3 items-center w-full text-white hover:text-white hover:bg-blue-700">
                                <span aria-hidden="true">
                                    <svg class="text-white opacity-50" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                        <line x1="3" y1="6" x2="21" y2="6"></line>
                                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                                    </svg>
                                </span>
                                <span class="ml-3">Products</span>
                            </a>
                        </li>
                        <li class="hover:bg-blue-100 relative">
                            <a href="{{route('backend_brand.index')}}" class="flex px-5 py-3 items-center w-full text-white hover:text-white hover:bg-blue-700">
                                <span aria-hidden="true">
                                    <svg class="text-white opacity-50" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                        <line x1="3" y1="6" x2="21" y2="6"></line>
                                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                                    </svg>
                                </span>
                                <span class="ml-3">Brands</span>
                            </a>
                        </li>
                        <li class="hover:bg-blue-100 relative">
                            <a href="{{route('backend_category.index')}}" class="flex px-5 py-3 items-center w-full text-white hover:text-white hover:bg-blue-700">
                                <span aria-hidden="true">
                                    <svg class="text-white opacity-50" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                        <line x1="3" y1="6" x2="21" y2="6"></line>
                                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                                    </svg>
                                </span>
                                <span class="ml-3">Categories</span>
                            </a>
                        </li>

                        <li class="hover:bg-blue-100 relative">
                            <a href="{{route('backend_order.index')}}" class="flex px-5 py-3 items-center w-full text-white hover:text-white hover:bg-blue-700">
                                <span aria-hidden="true">
                                    <svg class="text-white opacity-50" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="9" cy="21" r="1"></circle>
                                        <circle cx="20" cy="21" r="1"></circle>
                                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                                    </svg>
                                </span>
                                <span class="ml-3">Orders</span>
                            </a>
                        </li>

                        <li class="hover:bg-blue-100 relative">
                            <a href="{{route('backend_user.index')}}" class="flex px-5 py-3 items-center w-full text-white hover:text-white hover:bg-blue-700">
                                <span aria-hidden="true">
                                    <svg class="text-white opacity-50" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    </svg>
                                </span>
                                <span class="ml-3">Customers</span>
                            </a>
                        </li>
                    </ul>

                    <hr class="border-blue-600">
                </aside>
                <!--/Sidebar-->
                <!--Main-->
                <main class="bg-red-300 flex-1 p-3 overflow-hidden">
                    <div>
                        @yield('content')
                    </div>
                </main>
                <!--/Main-->
            </div>
            <!--Footer-->
            <footer class="bg-grey-darkest text-white p-2">
                <div class="flex flex-1 mx-auto">&copy; My Design</div>
            </footer>
            <!--/footer-->

        </div>

    </div>
    @include('sweetalert::alert')
    <script src="{{asset('js/main.js')}}"></script>

</body>

</html>