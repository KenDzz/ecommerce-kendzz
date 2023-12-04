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
                            <h2 id="4376-heading" class="text-lg font-medium text-gray-900 md:flex-shrink-0">Order
                                #{{ $data->id }}</h2>
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
                                    <img src="{{ url($data->url_img) }}" alt="{{ $data->describes }}"
                                        class="flex-none object-cover object-center w-20 h-20 rounded-md sm:w-48 sm:h-48">
                                    <div class="pt-1.5 min-w-0 flex-1 sm:pt-0">
                                        <h3 class="text-sm font-medium text-gray-900">
                                            <a href="{{ route('detail-product', ['slug'=>urlencode($data->products->slug), 'id' => $data->products->id]) }}">{{ $data->products->name }}</a>
                                        </h3>
                                        <p class="text-sm text-gray-500 truncate">
                                            <span>{{ $data->describes }}</span>
                                        </p>
                                        <p class="mt-1 font-medium text-gray-900">Giá trị đơn hàng:
                                            {{ number_format($data->total_price, 0, ',', '.') . ' đ' }}</p>
                                        <p class="mt-1 font-medium text-gray-900">Tiền vận chuyển:
                                            {{ number_format($data->cost_shipping, 0, ',', '.') . ' đ' }}</p>
                                    </div>
                                </div>
                                <div class="mt-6 space-y-4 sm:mt-0 sm:ml-6 sm:flex-none sm:w-40">
                                    <button type="button"
                                        class="w-full flex items-center justify-center bg-indigo-600 py-2 px-2.5 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:w-full sm:flex-grow-0">Mua
                                        lại</button>
                                    <button data-product-id="{{$data->product_id}}" data-order-id="{{ $data->id }}" type="button"
                                        class="btn-open-product-review w-full flex items-center justify-center bg-indigo-600 py-2 px-2.5 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:w-full sm:flex-grow-0 {{ !$data->is_review ? "" : "cursor-not-allowed opacity-50" }}" >Đánh
                                        giá</button>
                                    <button type="button"
                                        class=" w-full flex items-center justify-center bg-white py-2 px-2.5 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:w-full sm:flex-grow-0">Xem
                                        cửa hàng</button>

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
    <!-- Main modal -->
    <div id="product-review-modal" tabindex="-1" aria-hidden="true"
        class="flex justify-center items-center bg-gray-500 bg-opacity-75 fixed top-0 left-0 right-0 z-10 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] h-full">
        <div class="relative w-full max-w-md max-h-full modal-add-address">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" id="btn-close-product-review"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="authentication-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>

                <div class="px-6 py-6 lg:px-8">
                    <form action="#" method="POST" id="form-review">
                        @csrf
                        <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Đánh giá sản phẩm</h3>
                        <input type="hidden" name="id" id="data-product-id">
                        <input type="hidden" name="oderID" id="data-order-id">
                        <div class="flex justify-center mb-5">
                            <select class="star-rating w-52" name="rate">
                                <option value="">Select a rating</option>
                                <option value="5">Excellent</option>
                                <option value="4">Very Good</option>
                                <option value="3">Average</option>
                                <option value="2">Poor</option>
                                <option value="1">Terrible</option>
                            </select>
                        </div>

                        <div class="mx-auto">
                            <input type="file" id="file" name="file[]" class="filepond" multiple />
                        </div>
                        <div class="flex items-start mt-4 space-x-4">
                            <div class="flex-1 min-w-0">
                                <div
                                    class="p-2 overflow-hidden border border-gray-300 rounded-lg shadow-sm focus-within:border-indigo-500 focus-within:ring-1 focus-within:ring-slate-400 ">
                                    <label for="comment" class="sr-only">Add your comment</label>
                                    <textarea rows="3" name="comment" id="comment"
                                        class="w-full py-3 border-0 resize-none fblock focus:ring-0 sm:text-sm focus:outline-0"
                                        placeholder="Add your comment..."></textarea>

                                    <!-- Spacer element to match the height of the toolbar -->
                                    <div class="py-2" aria-hidden="true">
                                        <!-- Matches height of button in toolbar (1px border + 36px content height) -->
                                        <div class="py-px">
                                            <div class="h-9"></div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="flex-shrink-0">
                            <button type="button"
                                class="items-center w-full px-4 py-2 mt-5 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 btn-post-review"
                                id="btn-post-review">Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
