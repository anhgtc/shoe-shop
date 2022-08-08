@extends('layouts.backend_app')
@section('content')
<!--Grid Form-->
<div class="flex flex-1  flex-col md:flex-row lg:flex-row mx-2">
    <div class="mb-2 border-solid border-gray-300 rounded border shadow-sm w-full">
        <div class="bg-gray-200 px-2 py-3 border-solid border-gray-200 border-b">
            Full Table
        </div>
        <div class="p-3">
            <table class="table-responsive w-full rounded">
                <thead>
                    <tr>
                        <th class="border w-1/4 px-4 py-2">Id</th>
                        <th class="border w-1/6 px-4 py-2">Tên</th>
                        <th class="border w-1/5 px-4 py-2">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border px-4 py-2">1</td>
                        <td class="border px-4 py-2">Admin</td>
                        <td class="border px-4 py-2">
                            <a class="bg-teal-300 cursor-pointer rounded p-1 mx-1 text-white">
                            <i class="fas fa-eye"></i></a>
                            <a class="bg-teal-300 cursor-pointer rounded p-1 mx-1 text-white">
                            <i class="fas fa-edit"></i></a>
                            <a class="bg-teal-300 cursor-pointer rounded p-1 mx-1 text-red-500">
                            <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!--/Grid Form-->
@endsection