@extends('layouts.default')

@section('title', 'Thanh Toán')

@section('content')
    <div class="container mx-auto">
        <div class="product-featured">
            <div class="showcase-container">
                <div class="flex flex-col items-center py-4 bg-white border-b sm:flex-row sm:px-10 lg:px-20 xl:px-32">
                    <div class="py-2 mt-4 text-xs sm:mt-0 sm:ml-auto sm:text-base">
                        <div class="relative">
                            <ul class="relative flex items-center justify-between w-full space-x-2 sm:space-x-4">
                                <li class="flex items-center space-x-3 text-left sm:space-x-4">
                                    <a class="flex items-center justify-center w-6 h-6 text-xs font-semibold rounded-full bg-emerald-200 text-emerald-700"
                                        href="#"><svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg></a>
                                    <span class="font-semibold text-gray-900">Shop</span>
                                </li>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                                <li class="flex items-center space-x-3 text-left sm:space-x-4">
                                    <a class="flex items-center justify-center w-6 h-6 text-xs font-semibold text-white bg-gray-600 rounded-full ring ring-gray-600 ring-offset-2"
                                        href="#">2</a>
                                    <span class="font-semibold text-gray-900">Shipping</span>
                                </li>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                                <li class="flex items-center space-x-3 text-left sm:space-x-4">
                                    <a class="flex items-center justify-center w-6 h-6 text-xs font-semibold text-white bg-gray-400 rounded-full"
                                        href="#">3</a>
                                    <span class="font-semibold text-gray-500">Payment</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="grid sm:px-10 lg:grid-cols-2 lg:px-20 xl:px-32">
                    <div class="px-4 pt-8 tab-one" >
                        <p class="text-xl font-medium">Đơn hàng</p>
                        <p class="text-gray-400">Kiểm tra các mục của bạn. Và lựa chọn phương thức vận chuyển phù hợp.</p>
                        <div class="px-2 py-4 mt-8 space-y-3 overflow-y-auto bg-white border rounded-lg h-96 sm:px-6" >
                            @foreach (session('cart') as $id => $details)
                            <div class="flex flex-col bg-white rounded-lg sm:flex-row">
                                <img class="object-cover object-center h-24 m-2 border rounded-md w-28"
                                    src="{{ url($details['image']) }}"
                                    alt="" />
                                <div class="flex flex-col w-full px-4 py-4">
                                    <span class="font-semibold">{{ $details['name'] }}</p>
                                    </span>
                                    <span class="float-right text-gray-400">
                                        {{ $details['category'] }}
                                        @if ($details['size'] != null)
                                                {{ ',' . $details['size'] }}
                                         @endif
                                         , SL: {{ $details['quantity'] }}
                                    </span>
                                    <p class="text-lg font-bold">{{ number_format($details['quantity'] * $details['price'], 0, ',', '.') . ' vnđ' }}</p>

                                </div>
                            </div>
                            @endforeach

                        </div>

                        <p class="mt-8 text-lg font-medium">Phương thức vận chuyển</p>
                        <form class="grid gap-6 mt-5 form-choose-shipping">
                            <div class="relative">
                                <input class="hidden peer" id="radio_1" type="radio" name="radio" disabled />
                                <span
                                    class="box-content absolute block w-3 h-3 -translate-y-1/2 bg-white border-8 border-gray-300 rounded-full peer-checked:border-gray-700 right-4 top-1/2"></span>
                                <label
                                    class="flex p-4 border border-gray-300 rounded-lg cursor-pointer select-none peer-checked:border-2 peer-checked:border-gray-700 peer-checked:bg-gray-50"
                                    for="radio_1">
                                    <img class="object-contain w-14" src="/images/ship/ghn.png"
                                        alt="" />
                                    <div class="ml-5">
                                        <span class="mt-2 font-semibold">Giao Hàng Nhanh</span>
                                        <p class="text-sm leading-6 text-slate-500">Delivery: 2-4 Days</p>
                                    </div>
                                </label>
                            </div>
                            <div class="relative">
                                <input class="hidden peer" id="radio_2" type="radio" name="radio" checked />
                                <span
                                    class="box-content absolute block w-3 h-3 -translate-y-1/2 bg-white border-8 border-gray-300 rounded-full peer-checked:border-gray-700 right-4 top-1/2"></span>
                                <label
                                    class="flex p-4 border border-gray-300 rounded-lg cursor-pointer select-none peer-checked:border-2 peer-checked:border-gray-700 peer-checked:bg-gray-50"
                                    for="radio_2">
                                    <img class="object-contain w-14" src="/images/ship/spx.jpg"
                                        alt="" />
                                    <div class="ml-5">
                                        <span class="mt-2 font-semibold">SPX</span>
                                        <p class="text-sm leading-6 text-slate-500">Delivery: 2-4 Days</p>
                                    </div>
                                </label>
                            </div>
                        </form>
                    </div>

                    <div class="px-4 pt-8 mt-10 bg-gray-50 lg:mt-0">

                        <p class="text-xl font-medium">Chi tiết thanh toán</p>
                        <p class="text-gray-400">Hoàn tất đơn đặt hàng của bạn bằng cách cung cấp chi tiết thanh toán của bạn.</p>
                        <div class="hidden mt-5 payment-susses">
                            <svg viewBox="0 0 24 24" class="w-16 h-16 mx-auto my-6 text-green-600">
                                <path fill="currentColor"
                                    d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z">
                                </path>
                            </svg>
                            <div class="text-center">
                                <h3 class="text-base font-semibold text-center text-gray-900 md:text-2xl">Thanh toán thành công</h3>
                                <p class="my-2 text-gray-600">Cảm ơn bạn đã hoàn tất thanh toán trực tuyến an toàn của mình.</p>
                                <p> Chúc bạn có một ngày tuyệt vời!  </p>
                                <div class="py-10 text-center">
                                    <a href="{{ route('index') }}" class="px-12 py-3 font-semibold text-white bg-indigo-600 hover:bg-indigo-500">
                                        Trang chủ
                                   </a>
                                </div>
                            </div>
                        </div>
                        <div class="form-payment">

                            <p class="mt-8 text-lg font-medium">Địa chỉ giao hàng</p>
                            <div class="relative py-2 mt-4 border-b ">
                                <a href="{{ route('user-shipping-addresses') }}" class="absolute block w-24 px-2 py-1 mb-2 text-sm font-medium text-center text-blue-700 -translate-y-1/2 border border-blue-700 border-solid rounded-lg bborder-gray-300 hover:text-white hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 me-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800 right-4 top-1/2">Thay đổi</a>
                                <label
                                    class="flex p-4 border border-gray-300 rounded-lg cursor-pointer select-none peer-checked:border-2 peer-checked:border-gray-700 peer-checked:bg-gray-50"
                                    for="radio_2">
                                    <div class="ml-2">
                                        @if ($dataShipping != null && $dataShipping->count() > 0)
                                            <span class="mt-1 font-semibold">{{ $dataShipping->name }}, +84 {{ $dataShipping->phone }}</span>
                                            <p class="w-2/3 text-sm leading-6 text-slate-500">{{ $dataShipping->getAdress() }}</p>
                                        @else
                                            <span class="mt-1 font-semibold">Địa chỉ không tồn tại</span>
                                            <p class="w-2/3 text-sm leading-6 text-slate-500">Vui lòng thêm địa chỉ mới hoặc thêm địa chỉ vào mặc định</p>
                                        @endif
                                    </div>
                                </label>
                            </div>

                            <p class="mt-8 text-lg font-medium">Phương thức thanh toán</p>
                            <div class="flex">
                                <div class="relative p-2">
                                    <input class="hidden peer" id="radio_2" type="radio" name="radio" checked />
                                    <label
                                        class="flex p-4 border border-gray-300 rounded-lg cursor-pointer select-none peer-checked:border-2 peer-checked:border-gray-700 peer-checked:bg-white"
                                        for="radio_2">
                                        <span class="mt-2 font-semibold">Số dư tài khoản</span>
                                    </label>
                                </div>
                            </div>


                            <div class="flex items-center justify-between mt-6">
                                <p class="text-sm font-medium text-gray-900">Mã giảm giá</p>
                                <input type="text" name="credit-cvc" class="flex-shrink-0 w-3/6 px-2 py-3 text-sm border border-gray-200 rounded-md shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"/>
                            </div>
                            <!-- Total -->
                            @php $total = 0 @endphp
                            @foreach ((array) session('cart') as $id => $details)
                                @php
                                    $total += $details['price'] * $details['quantity'];
                                @endphp
                            @endforeach
                            <div class="py-2 mt-6 border-t border-b">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm font-medium text-gray-900">Subtotal</p>
                                    <p class="font-semibold text-gray-900">{{ number_format($total, 0, ',', '.') . ' đ' }}</p>
                                </div>
                                <div class="flex items-center justify-between">
                                    <p class="text-sm font-medium text-gray-900">Shipping</p>
                                    <p class="font-semibold text-gray-900 text-cost-shipping"></p>
                                </div>
                            </div>
                            <div class="flex items-center justify-between mt-6">
                                <p class="text-sm font-medium text-gray-900">Total</p>
                                <p class="text-2xl font-semibold text-gray-900 text-total-price-checkout" attr-price="{{$total}}">{{ number_format($total, 0, ',', '.') . ' đ' }}</p>
                            </div>
                        </div>
                        <button class="w-full px-6 py-3 mt-4 mb-8 font-medium text-white bg-gray-900 rounded-md btn-pay-cart">Thanh Toán</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
