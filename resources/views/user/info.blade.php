@extends('user.layout')

@section('content-user')
    <form>
        <div class="space-y-12">
            <div class="pb-12 ">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Thông tin tài khoản</h2>
                <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-6">
                        <label for="last-name" class="block text-sm font-medium leading-6 text-gray-900">Họ và tên</label>
                        <div class="mt-2">
                            <input type="text" id="last-name" value="{{$user->name}}" class="px-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Địa Chỉ Email</label>
                        <div class="mt-2">
                            <input id="email" value="{{$email}}" type="email" disabled autocomplete="email"
                                class="disabled:opacity-75 px-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Số điện thoại</label>
                        <div class="mt-2">
                            <input id="email" value="{{$phone}}" disabled name="email" type="email" autocomplete="email"
                                class="disabled:opacity-75 px-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="flex items-center justify-end mt-6 gap-x-6">
            <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Hủy</button>
            <button type="submit" class="px-3 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Lưu</button>
            <a href="{{ route('auth-logout') }}" class="px-3 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Đăng xuất</a>
        </div>
    </form>
@endsection
