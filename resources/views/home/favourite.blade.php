<div tabindex="-1" aria-hidden="true" class="relative z-10 hidden duration-500 ease-in-out form-favourite">
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
                                <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">Danh sách yêu thích</h2>
                                <div class="flex items-center ml-3 h-7">
                                    <button type="button"
                                        class="relative p-2 -m-2 text-gray-400 hover:text-gray-500 btn-hidden-favourite">
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
                                    <ul role="list" class="-my-6 divide-y divide-gray-200 list-product-favourite">
                                        @if (session('favourite'))
                                            @foreach (session('favourite') as $id => $details)
                                                <li class="flex py-6 li-product-favourite" data-id="{{ $id }}">
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
                                                                    <a href="{{ $details['link'] }}">{{ $details['name'] }}</a>
                                                                </h3>
                                                            </div>
                                                        </div>
                                                        <div class="flex items-end justify-between flex-1 text-sm">
                                                            <div class="flex">
                                                                <button type="button"
                                                                    class="font-medium text-indigo-600 hover:text-indigo-500 btn-delete-product-favourite"  data-product-id="{{ $details['id'] }}">Xóa</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
