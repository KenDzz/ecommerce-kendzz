@extends('user.layout')

@section('content-user')
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="bg-white">
        <div class="max-w-3xl">
            <div class="max-w-xl">
                <h1 id="your-orders-heading" class="text-3xl font-extrabold tracking-tight text-gray-900">Đơn đặt hàng của bạn
                </h1>
                <p class="mt-2 text-sm text-gray-500">Kiểm tra trạng thái của các đơn đặt hàng gần đây, quản lý trả lại và
                    khám phá các sản phẩm tương tự.</p>
            </div>

            <div class="mt-12 space-y-16 sm:mt-16">
                <section aria-labelledby="4376-heading">
                    @foreach ($datas as $data)
                        <div class="mt-2 space-y-1 md:flex md:items-baseline md:space-y-0 md:space-x-4">
                            <h2 id="4376-heading" class="text-lg font-medium text-gray-900 md:flex-shrink-0">Order #{{ $data->id }}</h2>
                            <div
                                class="space-y-5 md:flex-1 md:min-w-0 sm:flex sm:items-baseline sm:justify-between sm:space-y-0">
                                <p class="text-sm font-medium text-gray-500">{{ $data->created_at }}</p>
                                <div class="flex text-sm font-medium">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-500">Chi tiết</a>
                                    <div class="pl-4 ml-4 border-l border-gray-200 sm:ml-6 sm:pl-6">
                                        <a href="#" class="text-indigo-600 hover:text-indigo-500">in hóa đơn</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flow-root mt-6 -mb-6 border-t border-gray-200 divide-y divide-gray-200">
                            <div class="py-6 sm:flex">
                                <div class="flex space-x-4 sm:min-w-0 sm:flex-1 sm:space-x-6 lg:space-x-8">
                                    <img src="{{ url($data->url_img) }}"
                                        alt="{{ $data->describes }}"
                                        class="flex-none object-cover object-center w-20 h-20 rounded-md sm:w-48 sm:h-48">
                                    <div class="pt-1.5 min-w-0 flex-1 sm:pt-0">
                                        <h3 class="text-sm font-medium text-gray-900">
                                            <a href="#">{{ $data->products->name }}</a>
                                        </h3>
                                        <p class="text-sm text-gray-500 truncate">
                                            <span>{{ $data->describes }}</span>
                                        </p>
                                        <p class="mt-1 font-medium text-gray-900">Giá trị đơn hàng: {{ number_format($data->total_price, 0, ',', '.') . ' đ' }}</p>
                                        <p class="mt-1 font-medium text-gray-900">Tiền vận chuyển: {{ number_format($data->cost_shipping, 0, ',', '.') . ' đ' }}</p>
                                    </div>
                                </div>
                                <div class="mt-6 space-y-4 sm:mt-0 sm:ml-6 sm:flex-none sm:w-40">
                                    <button type="button"
                                        class="w-full flex items-center justify-center bg-indigo-600 py-2 px-2.5 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:w-full sm:flex-grow-0">Mua lại</button>
                                    <button type="button"
                                        class="w-full flex items-center justify-center bg-white py-2 px-2.5 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:w-full sm:flex-grow-0">Xem cửa hàng</button>
                                </div>
                            </div>

                            <!-- More products... -->
                        </div>
                    @endforeach

                </section>

                <!-- More orders... -->
            </div>
        </div>
    </div>
@endsection
