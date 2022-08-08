<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/tailwind.css') }}" rel="stylesheet">
    <link href="{{asset('css/tailwind.min.css')}}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,600i,700,700i" rel="stylesheet">
</head>

<body>
    <section class="h-auto gradient-form bg-gray-200 md:h-auto">
        <div class="container py-12 px-6 h-full">
            <div class="flex justify-center items-center flex-wrap h-full g-6 text-gray-800">
                <div class="xl:w-10/12">
                    <div class="block bg-white shadow-lg rounded-lg">
                        <div class="lg:flex lg:flex-wrap g-0">
                            <div class="lg:w-6/12 px-4 md:px-0">
                                <div class="md:p-12 md:mx-6">
                                    <div class="text-center">

                                        <img src="https://yome.vn/logo-cac-hang-giay-noi-tieng/imager_16_36862_700.jpg" class="w-full" />

                                        <h4 class="text-xl font-semibold mt-1 mb-12 pb-1">We are The Akatsuki Team</h4>
                                    </div>
                                    <form method="POST" action="{{ route('signup') }}">
                                        @csrf
                                        <p class="mb-4 text-2xl">Đăng ký</p>
                                        <div class="mb-3">
                                            <input type="text" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="name" name="name" placeholder="Tên người dùng" required="" />
                                        </div>
                                        @if($errors->has('email'))
                                        <div role="alert">
                                            @foreach ($errors->get('email') as $error)
                                            <p class="text-red-400">{{ $error }}</p>
                                            @endforeach
                                        </div>
                                        @endif
                                        <div class="mb-3">
                                            <input type="email" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="email" name="email" placeholder="Email" required="" />
                                        </div>
                                        @if($errors->has('password'))
                                        <div role="alert">
                                            @foreach ($errors->get('password') as $error)
                                            <p class="text-red-400">{{ $error }}</p>
                                            @endforeach
                                        </div>
                                        @endif
                                        <div class="mb-3">
                                            <input type="password" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="password" name="password" placeholder="Mật khẩu" required="" />
                                        </div>
                                        <div class="mb-3">
                                            <input type="password" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="password_confirmation" name="password_confirmation" placeholder="Nhập lại mật khẩu" required="" />
                                        </div>
                                        <div class="text-center pt-1 mb-12 pb-1">
                                            <button type="submit" class="inline-block px-6 py-2.5 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out w-full mb-3" type="button" data-mdb-ripple="true" data-mdb-ripple-color="light" style="
                        background: linear-gradient(
                          to right,
                          #ee7724,
                          #d8363a,
                          #dd3675,
                          #b44593
                        );
                      ">
                                                Đăng ký
                                            </button>
                                        </div>
                                        <div class="flex items-center justify-between pb-6">
                                            <p class="mb-0 mr-2">Bạn đã có tài khoản?</p>
                                            <a href="{{route('login')}}" type="button" class="inline-block px-6 py-2 border-2 border-red-600 text-red-600 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out" data-mdb-ripple="true" data-mdb-ripple-color="light">
                                                Đăng nhập
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="lg:w-6/12 flex items-center lg:rounded-r-lg rounded-b-lg lg:rounded-bl-none" style="
                background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
              ">
                                <div class="text-white px-2 py-4 md:p-12 md:mx-6 w-full">
                                    <h4 class="text-xl font-semibold mb-6 justify-center flex">Sống trọn với đam mê</h4>
                                    <p class="text-2xl justify-center flex w-full">
                                        Bạn cần gì chúng tôi đều có!
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>