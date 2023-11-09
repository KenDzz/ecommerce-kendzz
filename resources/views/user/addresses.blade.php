@extends('user.layout')

@section('content-user')
    <div class="relative overflow-x-auto">
        <button id="btn-modal-add-address"
            class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-500 to-blue-500 group-hover:from-cyan-500 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-cyan-200 dark:focus:ring-cyan-800">
            <span
                class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                Thêm địa chỉ mới
            </span>
        </button>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Thông tin người nhận
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tỉnh-Thành Phố/Quận-Huyện/Phường-Xã
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Địa chỉ chi tiết
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Chỉ dẫn giao hàng
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Địa chỉ mặc định
                    </th>
                </tr>
            </thead>
            <tbody>
                @if (!$datas->isEmpty() && $datas->count() > 0)
                    @foreach ($datas as $data)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="pl-3">
                                    <div class="text-base font-semibold">{{ $data->name }}</div>
                                    <div class="font-normal text-gray-500">+84 {{ $data->phone }}</div>
                                </div>
                                {!! $data->getIsUsed() !!}
                            </th>
                            <td class="px-6 py-4">
                                {{ $data->province . ', ' . $data->city . ', ' . $data->district }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $data->address }}
                            </td>
                            <td class="px-6 py-4">
                            </td>
                            <td class="px-6 py-4">
                                <label class="relative inline-flex items-center cursor-pointer">

                                    <input type="checkbox" value="" class="sr-only peer"
                                        {{ $data->is_used ? 'checked' : '' }}>
                                    <div
                                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-pink-300 dark:peer-focus:ring-pink-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-pink-600">
                                    </div>
                                </label>

                            </td>
                        </tr>
                    @endforeach
                @endif

            </tbody>
        </table>
    </div>
    <!-- Main modal -->
<div id="address-modal" tabindex="-1" aria-hidden="true" class="flex justify-center items-center bg-gray-500 bg-opacity-75 fixed top-0 left-0 right-0 z-10 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] h-full">
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" id="btn-close-modal-address" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Thêm địa chỉ mới</h3>
                <form class="space-y-6" action="#">
                    <div>
                        <label for="name-modal-address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tên <span class="text-red-600">*</span></label>
                        <input type="text" id="name-modal-address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div>
                        <label for="phone-modal-address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Số địa thoại <span class="text-red-600">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-2 pointer-events-none">
                              +84
                            </div>
                            <input type="text" id="phone-modal-address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                    </div>
                    <div>
                        <label for="province-modal-address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tỉnh</label>
                        <select id="province-modal-address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Chọn Tỉnh" autocomplete="off">
                        </select>
                    </div>
                    <div>
                        <label for="city-modal-address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quận/Huyện</label>
                        <select id="city-modal-address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Chọn Quận/Huyện" autocomplete="off">

                        </select>
                    </div>
                    <div>
                        <label for="district-modal-address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phường/Xã</label>
                        <select id="district-modal-address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Chọn Phường/Xã" autocomplete="off">
                        </select>
                    </div>
                    <div>
                        <label for="info-modal-address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Địa chỉ</label>
                        <input id="autoComplete" class="bg-gray-50 border name-modal-address border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" type="search" dir="ltr" spellcheck=false autocorrect="off" autocomplete="off" autocapitalize="off">
                    </div>
                    <div>
                        <label for="note-modal-address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lưu ý</label>
                        <textarea id="note-modal-address" class="p-2.5 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"></textarea>
                    </div>
                    <div>
                        <label for="postal-modal-address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Postal Code</label>
                        <input type="text" id="postal-modal-address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                    </div>
                    <button class="w-full add-cart-btn">Thêm địa chỉ mới</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
