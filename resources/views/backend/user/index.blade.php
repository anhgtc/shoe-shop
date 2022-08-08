@extends('layouts.backend_app')
@section('content')
@auth
<!--List user-->
<div class="flex bg-white flex-1  flex-col md:flex-row lg:flex-row mx-2 rounded">
    <div class="mb-2 border-solid border-gray-300 rounded border shadow-sm w-full">
        <div class="bg-gray-400 px-2 py-3 border-solid border-gray-200 border-b">
            <strong class="flex justify-center">Danh sách tài khoản</strong>
        </div>
        <div class="relative mb-2 border-solid rounded border shadow-sm w-full">
            <a class="absolute inset-y-0 right-0">
                <button data-modal='centeredFormModal' class="modal-trigger px-2 py-3 bg-blue-500 hover:bg-blue-700 text-white font-bold rounded">Thêm mới tài khoản</button>
            </a>
            <!-- Form search -->
            <form method="GET" action="{{route('backend_user.search')}}">
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-gray-300">Search</label>
                <div class="relatives">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" id="search_user" name="search_user" class="px-2 py-3 pl-10 w-1/5 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tìm kiếm tài khoản" required="">
                    <button type="submit" class="px-2 py-3 text-white absolute bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tìm kiếm</button>
                </div>
            </form>
        </div>
        <div class="relative">
            <table class="table-fixed w-full rounded">
                <thead>
                    <tr>
                        <th class="border w-1/6 px-4 py-2">Tên</th>
                        <th class="border w-1/6 px-4 py-2">Email</th>
                        <th class="border w-1/6 px-4 py-2">Ngày tạo tài khoản</th>
                        <th class="border w-1/6 px-4 py-2">Ngày sửa tài khoản</th>
                        <th class="border w-1/5 px-4 py-2 text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td class="border px-4 py-2">{{$user->name}}</td>
                        <td class="border px-4 py-2">{{$user->email}}</td>
                        <td class="border px-4 py-2">{{$user->created_at}}</td>
                        <td class="border px-4 py-2">{{$user->updateted_at}}</td>
                        <td class="border px-4 py-2">
                            <div class="flex justify-center">
                                <div>
                                    <a href="{{ route('backend_user.edit', $user->id) }}" class="bg-teal-300 cursor-pointer rounded p-1 mx-1 text-white">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                                <div>
                                    <form action="{{ route('backend_user.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">
                                            <a class="bg-teal-300 cursor-pointer rounded p-1 mx-1 text-red-500">
                                                <i class="fas fa-trash"></i></a>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="pt-4">
            {{ $users->onEachSide(1)->appends(request()->except('page'))->links() }}
        </div>
    </div>
</div>
<!--/Grid Form-->
<div id='centeredFormModal' class="modal-wrapper">
    <div class="overlay close-modal"></div>
    <div class="modal modal-centered">
        <div class="modal-content shadow-lg p-5">
            <div class="border-b p-2 pb-3 pt-0 mb-4">
                <div class="flex justify-between items-center">
                    Thêm mới tài khoản
                    <span class='close-modal cursor-pointer px-3 py-1 rounded-full bg-gray-100 hover:bg-gray-200'>
                        <i class="fas fa-times text-gray-700"></i>
                    </span>
                </div>
            </div>
            <!-- Modal content -->
            <form id='form_user' class="w-full" method="POST" action="{{ route('backend_user.store') }}">
                @csrf
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1" for="name">
                            Name
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white-500" id="name" name="name" type="text" placeholder="Long">
                        @error('name')
                        <div class="text-xs text-red-900 py-1 px-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1" for="email">
                            Email
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white-500" id="email" name="email" type="text" placeholder="Long@gmail.com">
                        @error('email')
                        <div class="text-xs text-red-900 py-1 px-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1" for="password">
                            Password
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white-500" id="password" name="password" type="password" placeholder="12345678">
                        @error('password')
                        <div class="text-xs text-red-900 py-1 px-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1" for="password_confirmation">
                            Confirm Password
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white-500" id="password_confirmation" name="password_confirmation" type="password" placeholder="12345678">
                    </div>
                </div>
                <div class="mt-5">
                    <button type="submit" class='bg-green-500 hover:bg-green-800 text-white font-bold py-2 px-4 rounded'> Thêm </button>
                    <span class='close-modal cursor-pointer bg-red-200 hover:bg-red-500 text-red-900 font-bold py-2 px-4 rounded'>
                        Đóng
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- <script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    } 
</script> -->

 

@endauth
@endsection