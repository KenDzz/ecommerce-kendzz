@extends('layouts.default')

@section('title', 'Đăng ký bán hàng')

@section('content')
    <!-- This example requires Tailwind CSS v2.0+ -->
    <nav aria-label="Progress">
        <ol role="list" class="border border-gray-300 divide-y divide-gray-300 rounded-md md:flex md:divide-y-0">
            <li class="relative md:flex-1 md:flex">
                <!-- Completed Step -->
                <a href="#" class="flex items-center w-full group">
                    <span class="flex items-center px-6 py-4 text-sm font-medium">
                        <span
                            class="flex items-center justify-center flex-shrink-0 w-10 h-10 bg-indigo-600 rounded-full group-hover:bg-indigo-800">
                            <!-- Heroicon name: solid/check -->
                            <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                        <span class="ml-4 text-sm font-medium text-gray-900">Thông tin</span>
                    </span>
                </a>

                <!-- Arrow separator for lg screens and up -->
                <div class="absolute top-0 right-0 hidden w-5 h-full md:block" aria-hidden="true">
                    <svg class="w-full h-full text-gray-300" viewBox="0 0 22 80" fill="none" preserveAspectRatio="none">
                        <path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke" stroke="currentcolor"
                            stroke-linejoin="round" />
                    </svg>
                </div>
            </li>

            <li class="relative md:flex-1 md:flex">
                <!-- Current Step -->
                <a href="#" class="flex items-center px-6 py-4 text-sm font-medium" aria-current="step">
                    <span
                        class="flex items-center justify-center flex-shrink-0 w-10 h-10 border-2 border-indigo-600 rounded-full">
                        <span class="text-indigo-600">02</span>
                    </span>
                    <span class="ml-4 text-sm font-medium text-indigo-600">Xác minh danh tính</span>
                </a>

                <!-- Arrow separator for lg screens and up -->
                <div class="absolute top-0 right-0 hidden w-5 h-full md:block" aria-hidden="true">
                    <svg class="w-full h-full text-gray-300" viewBox="0 0 22 80" fill="none" preserveAspectRatio="none">
                        <path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke" stroke="currentcolor"
                            stroke-linejoin="round" />
                    </svg>
                </div>
            </li>

            <li class="relative md:flex-1 md:flex">
                <!-- Upcoming Step -->
                <a href="#" class="flex items-center group">
                    <span class="flex items-center px-6 py-4 text-sm font-medium">
                        <span
                            class="flex items-center justify-center flex-shrink-0 w-10 h-10 border-2 border-gray-300 rounded-full group-hover:border-gray-400">
                            <span class="text-gray-500 group-hover:text-gray-900">03</span>
                        </span>
                        <span class="ml-4 text-sm font-medium text-gray-500 group-hover:text-gray-900">Xác nhận</span>
                    </span>
                </a>
            </li>
        </ol>
    </nav>
    <div class="p-5 px-4 py-16 overflow-hidden bg-white sm:px-6 lg:px-8 lg:py-24 add-info-seller hidden-important">
        <div class="relative max-w-xl mx-auto">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">Vui lòng nhập thông tin cá nhân
                </h2>
                <p class="mt-4 text-lg leading-6 text-gray-500">Trở thành người bán trên Anon.</p>
            </div>
            <div class="mt-12">
                <form action="#" method="POST" id="form-reg-seller">
                    <div class="shadow sm:rounded-md sm:overflow-hidden">
                        <div class="px-4 py-6 space-y-6 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                                    <label class="block text-sm font-medium text-gray-700">Họ và tên đệm</label>
                                    <input type="text" name="lastname"
                                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                                <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                                    <label class="block text-sm font-medium text-gray-700">Tên</label>
                                    <input type="text" name="firstname"
                                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                                <div class="col-span-6">
                                    <label for="postal-code" class="block text-sm font-medium text-gray-700">Số điện
                                        thoại</label>
                                    <div class="flex rounded-md">
                                        <span
                                            class="inline-flex items-center px-3 py-2 text-gray-500 border border-r-0 border-gray-300 rounded-l-md bg-gray-50 sm:text-sm">
                                            +84 </span>
                                        <input type="text" name="phone"
                                            class="flex-1 block w-full min-w-0 px-3 py-2 border border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 rounded-r-md sm:text-sm">
                                    </div>
                                </div>
                                <div class="col-span-6 ">
                                    <label class="block text-sm font-medium text-gray-700">Tên cửa hàng</label>
                                    <input type="text" name="name"
                                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                                <div class="col-span-6 ">
                                    <label class="block text-sm font-medium text-gray-700">Tỉnh</label>
                                    <select id="province-modal-address" name="province"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Chọn Tỉnh" autocomplete="off">
                                    </select>
                                </div>
                                <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                                    <label class="block text-sm font-medium text-gray-700">Quận/Huyện</label>
                                    <select id="city-modal-address" name="city"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Chọn Quận/Huyện" autocomplete="off">
                                    </select>
                                </div>
                                <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                                    <label class="block text-sm font-medium text-gray-700">Phường/Xã</label>
                                    <select id="district-modal-address" name="district"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Chọn Phường/Xã" autocomplete="off">
                                    </select>
                                </div>
                                <div class="col-span-6">
                                    <label class="block text-sm font-medium text-gray-700">Địa Chỉ</label>
                                    <input id="autoComplete"
                                        class="bg-gray-50 border info-modal-address border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                        type="search" dir="ltr" name="address" spellcheck=false autocorrect="off"
                                        autocomplete="off" autocapitalize="off">
                                </div>
                                <div class="col-span-6">
                                    <label for="postal-code" class="block text-sm font-medium text-gray-700">ZIP / Postal
                                        code</label>
                                    <input type="text" name="postalcode" id="postal-code" autocomplete="postal-code"
                                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
                            <button type="submit"
                                class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 next-step-ekyc">Tiếp
                                tục</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="p-5 px-4 py-16 overflow-hidden bg-white sm:px-6 lg:px-8 lg:py-24 add-ekyc ">
        <div class="relative max-w-xl mx-auto">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">Vui lòng cung cấp hình ảnh
                    CMND
                </h2>
                <p class="mt-4 text-lg leading-6 text-gray-500">Cung cấp hình ảnh mặt trước của CMND</p>
                <p class="mt-4 text-lg leading-6 text-gray-500">Vui lòng sử dụng giấy tờ thật. Hãy đảm bảo ảnh chụp hoặc
                    tải lên không bị mờ hoặc bóng, thông tin hiển thị rõ ràng, dễ đọc trong điều kiện đầy đủ ánh sáng.</p>

            </div>
            <div class="mt-12">
                <div id="animated-thumbnails" class="flex justify-center">
                </div>
                    <div class="shadow sm:rounded-md sm:overflow-hidden">
                        <div class="px-4 py-6 space-y-6 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6">
                                    <label class="block text-sm font-medium text-gray-700"> </label>
                                    <div
                                        class="flex justify-center px-6 pt-5 pb-6 mt-1 border-2 border-gray-300 border-dashed rounded-md">
                                        <div class="space-y-1 text-center">
                                            <svg class="w-12 h-12 mx-auto text-gray-400" stroke="currentColor"
                                                fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                <path
                                                    d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <div class="flex text-sm text-gray-600">
                                                <label for="file-upload"
                                                    class="relative font-medium text-indigo-600 bg-white rounded-md cursor-pointer hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                    <span>Upload a file </span>
                                                    <input id="file-upload" name="file-upload" type="file"
                                                        class="sr-only">
                                                </label>
                                                <p class="pl-1">or drag and drop</p>
                                            </div>
                                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
                        <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 next-info-ekyc">Tiếp
                            tục</button>
                    </div>
            </div>
        </div>
    </div>
    <div class="p-5 px-4 py-16 overflow-hidden bg-white sm:px-6 lg:px-8 lg:py-24 info-ekyc hidden-important">
        <div class="relative max-w-xl mx-auto">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">Xác nhận thông tin CMND
                </h2>
                <p class="mt-4 text-lg leading-6 text-gray-500">Vui lòng kiểm tra và chỉnh sửa thông tin chính xác</p>
            </div>
            <div class="mt-12">
                <form action="#" method="POST" id="form-info-ekyc">
                    <div class="shadow sm:rounded-md sm:overflow-hidden">
                        <div class="px-4 py-6 space-y-6 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 ">
                                    <label class="block text-sm font-medium text-gray-700">Họ và Tên</label>
                                    <input type="text" name="name" id="name-info-ekyc"
                                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                                <div class="col-span-6 ">
                                    <label class="block text-sm font-medium text-gray-700">Số CMND</label>
                                    <input type="text" name="numbercmnd" id="numbercmnd"
                                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                                <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                                    <label class="block text-sm font-medium text-gray-700">Ngày Sinh</label>
                                    <input type="date" name="birthday" id="birthday"
                                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                                <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                                    <label class="block text-sm font-medium text-gray-700">Giới tính</label>
                                    <div class="mt-1">
                                      <select id="sex" name="sex" autocomplete="country-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="1">Nam</option>
                                        <option value="2">Nữ</option>
                                      </select>
                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <label for="postal-code" class="block text-sm font-medium text-gray-700">Nguyên quán</label>
                                    <input type="text" name="addressone" id="addressone" autocomplete="postal-code"
                                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                                <div class="col-span-6">
                                    <label for="postal-code" class="block text-sm font-medium text-gray-700">Địa chỉ thường trú</label>
                                    <input type="text" name="addresssecond" id="addresssecond" autocomplete="postal-code"
                                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
                            <button type="submit"
                                class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 next-face">Tiếp
                                tục</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="p-5 px-4 py-16 overflow-hidden bg-white sm:px-6 lg:px-8 lg:py-24 add-face-ekyc hidden-important">
        <div class="relative max-w-xl mx-auto">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">Xác minh chân dung</h2>
                <p class="mt-4 text-lg leading-6 text-gray-500">Cung cấp hình ảnh mặt trước của CMND</p>
                <p class="mt-4 text-lg leading-6 text-gray-500">Xác minh ảnh chân dung bằng cách chụp ảnh trên tay cầm CMND, một tờ giấy có chữ ký cùng dòng chữ “Bán hàng cùng Anon“ viết tay và ghi rõ ngày thực hiện. Ví dụ:</p>
                <img src="{{ url('images/ekyc-face.png') }}" alt="">
            </div>
            <div class="mt-12">
                <div id="animated-thumbnails" class="flex justify-center face-img-ekyc">
                </div>
                    <div class="shadow sm:rounded-md sm:overflow-hidden">
                        <div class="px-4 py-6 space-y-6 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6">
                                    <label class="block text-sm font-medium text-gray-700"> </label>
                                    <div
                                        class="flex justify-center px-6 pt-5 pb-6 mt-1 border-2 border-gray-300 border-dashed rounded-md">
                                        <div class="space-y-1 text-center">
                                            <svg class="w-12 h-12 mx-auto text-gray-400" stroke="currentColor"
                                                fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                <path
                                                    d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <div class="flex text-sm text-gray-600">
                                                <label for="file-upload-face"
                                                    class="relative font-medium text-indigo-600 bg-white rounded-md cursor-pointer hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                    <span>Upload a file </span>
                                                    <input id="file-upload-face" name="file-upload-face" type="file"
                                                        class="sr-only">
                                                </label>
                                                <p class="pl-1">or drag and drop</p>
                                            </div>
                                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
                        <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 next-confirm-ekyc">Tiếp
                            tục</button>
                    </div>
            </div>
        </div>
    </div>
    <div class="p-5 px-4 py-16 overflow-hidden bg-white sm:px-6 lg:px-8 lg:py-24 confirm-ekyc hidden-important">
        <div class="relative max-w-xl mx-auto">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">Đăng ký bán hành thành công</h2>
                <p class="mt-4 text-lg leading-6 text-gray-500">Thông tin sẽ được kiểm tra và xác minh. Kết quả sẽ được thông báo trễ nhất vòng 36 giờ làm việc </p>
                <svg viewBox="0 0 24 24" class="w-16 h-16 mx-auto my-6 text-green-600">
                    <path fill="currentColor"
                        d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z">
                    </path>
                </svg>
            </div>
        </div>
    </div>
@endsection
