<div tabindex="-1" aria-hidden="true" class="relative z-10 hidden duration-500 ease-in-out form-cart">
    <!--
      Background backdrop, show/hide based on slide-over state.

      Entering: "ease-in-out duration-500"
        From: "opacity-0"
        To: "opacity-100"
      Leaving: "ease-in-out duration-500"
        From: "opacity-100"
        To: "opacity-0"
    -->
    <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"></div>

    <div class="fixed inset-0 overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="fixed inset-y-0 right-0 flex max-w-full pl-10 pointer-events-none">
                <!--
            Slide-over panel, show/hide based on slide-over state.

            Entering: "transform transition ease-in-out duration-500 sm:duration-700"
              From: "translate-x-full"
              To: "translate-x-0"
            Leaving: "transform transition ease-in-out duration-500 sm:duration-700"
              From: "translate-x-0"
              To: "translate-x-full"
          -->
                <div class="w-screen max-w-md pointer-events-auto">
                    <div class="flex flex-col h-full overflow-y-scroll bg-white shadow-xl">
                        <div class="flex-1 px-4 py-6 overflow-y-auto sm:px-6">
                            <div class="flex items-start justify-between">
                                <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">Giỏ hàng</h2>
                                <div class="flex items-center ml-3 h-7">
                                    <button type="button"
                                        class="relative p-2 -m-2 text-gray-400 hover:text-gray-500 btn-hidden-cart">
                                        <span class="absolute -inset-0.5"></span>
                                        <span class="sr-only">Close panel</span>
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="mt-8">
                                <div class="flow-root">
                                    <ul role="list" class="-my-6 divide-y divide-gray-200 list-product-cart">
                                        @if (session('cart'))
                                            @foreach (session('cart') as $id => $details)
                                                <li class="flex py-6 li-product-cart" data-id="{{ $id }}">
                                                    <div
                                                        class="flex-shrink-0 w-24 h-24 overflow-hidden border border-gray-200 rounded-md">
                                                        <img src="{{ url($details['image']) }}" alt=""
                                                            class="object-cover object-center w-24 h-full">
                                                    </div>

                                                    <div class="flex flex-col flex-1 ml-4">
                                                        <div>
                                                            <div
                                                                class="flex justify-between text-base font-medium text-gray-900">
                                                                <h3>
                                                                    <a href="#">{{ $details['name'] }}</a>
                                                                </h3>
                                                                <p class="ml-4">
                                                                    {{ number_format($details['quantity'] * $details['price'], 0, ',', '.') . ' vnđ' }}
                                                                </p>
                                                            </div>
                                                            <p class="mt-1 text-sm text-gray-500">
                                                                {{ $details['category'] }}

                                                                @if ($details['size'] != null)
                                                                    {{ ',' . $details['size'] }}
                                                                @endif
                                                            </p>
                                                        </div>
                                                        <div class="flex items-end justify-between flex-1 text-sm">
                                                            <p class="text-gray-500">{{ $details['quantity'] }}</p>

                                                            <div class="flex">
                                                                <button type="button"
                                                                    class="font-medium text-indigo-600 hover:text-indigo-500 btn-delete-product-cart">Xóa</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @else
                                            <div class="grid place-items-center">
                                                <img src="/images/logo/cart-emty.png"
                                                    class="h-auto max-w-xs mx-auto mr-4" alt="">
                                            </div>
                                        @endif

                                        <!-- More products... -->
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="px-4 py-6 border-t border-gray-200 sm:px-6">
                            <div class="flex justify-between text-base font-medium text-gray-900">
                                @php $total = 0 @endphp
                                @foreach ((array) session('cart') as $id => $details)
                                    @php
                                        $total += $details['price'] * $details['quantity'];
                                    @endphp
                                @endforeach
                                <p>Tổng</p>
                                <p class="total-price-cart">{{ number_format($total, 0, ',', '.') . ' đ' }}</p>
                            </div>
                            <p class="mt-0.5 text-sm text-gray-500">Vận chuyển và thuế được tính khi thanh toán.</p>
                            <div class="mt-6">
                                <a href="{{ route('user-checkout') }}"
                                    class="flex items-center justify-center px-6 py-3 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700">Thanh
                                    Toán</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
