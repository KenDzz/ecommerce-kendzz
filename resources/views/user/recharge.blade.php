@extends('user.layout')

@section('content-user')
    <div id="cardList" class="flex space-x-4">
        <div class="p-4 border border-4 border-gray-300 cursor-pointer card-recharge ">
            <img src="{{ url('images/pay/momo.jpg') }}" class="object-cover h-20 w-28" />
            <span class="hidden">MOMO</span>
        </div>
        <div class="p-4 border border-4 border-gray-300 cursor-pointer card-recharge ">
            <img src="{{ url('images/pay/vcb.jpg') }}" class="object-cover h-20 w-28" />
            <span class="hidden">VCB</span>
        </div>
        <div class="p-4 border border-4 border-gray-300 cursor-pointer card-recharge ">
            <img src="{{ url('images/pay/bidv.jpg') }}" class="object-cover h-20 w-28" />
            <span class="hidden">BIDV</span>
        </div>
    </div>
    <input type="hidden" id="selectedCard" value="">
    <input type="hidden" id="selectedMoney" value="">
    <div class="flex mt-5 space-x-4 overflow-x-auto ">
        <div class="flex-auto cursor-pointer">
            <input id="recharge-10" type="radio" name="price" class="hidden radio-input-recharge" value="10000">
            <label for="recharge-10"
                class="flex items-center justify-center h-12 p-4 transition duration-300 border border-2 border-gray-300 cursor-pointer w-max radio-label-recharge hover:border-gray-500">
                10.000 VNĐ
            </label>
        </div>
        <div class="flex-auto cursor-pointer">
            <input id="recharge-20" type="radio" name="price" class="hidden radio-input-recharge" value="20000">
            <label for="recharge-20"
                class="flex items-center justify-center h-12 p-4 transition duration-300 border border-2 border-gray-300 cursor-pointer w-max radio-label-recharge hover:border-gray-500">
                20.000 VNĐ
            </label>
        </div>
        <div class="flex-auto cursor-pointer">
            <input id="recharge-30" type="radio" name="price" class="hidden radio-input-recharge" value="30000">
            <label for="recharge-30"
                class="flex items-center justify-center h-12 p-4 transition duration-300 border border-2 border-gray-300 cursor-pointer w-max hover:border-gray-500 radio-label-recharge">
                30.000 VNĐ
            </label>
        </div>

        <div class="flex-auto cursor-pointer ">
            <input id="recharge-50" type="radio" name="price" class="hidden radio-input-recharge" value="50000">
            <label for="recharge-50"
                class="flex items-center justify-center h-12 p-4 transition duration-300 border border-2 border-gray-300 cursor-pointer w-max hover:border-gray-500 radio-label-recharge">
                50.000 VNĐ
            </label>
        </div>

        <div class="flex-auto cursor-pointer">
            <input id="recharge-100" type="radio" name="price" class="hidden radio-input-recharge" value="100000">
            <label for="recharge-100"
                class="flex items-center justify-center h-12 p-4 transition duration-300 border border-2 border-gray-300 cursor-pointer w-max hover:border-gray-500 radio-label-recharge">
                100.000 VNĐ
            </label>
        </div>

        <div class="flex-auto cursor-pointer">
            <input id="recharge-200" type="radio" name="price" class="hidden radio-input-recharge" value="200000">
            <label for="recharge-200"
                class="flex items-center justify-center h-12 p-4 transition duration-300 border border-2 border-gray-300 cursor-pointer w-max hover:border-gray-500 radio-label-recharge">
                200.000 VNĐ
            </label>
        </div>

        <div class="flex-auto cursor-pointer">
            <input id="recharge-300" type="radio" name="price" class="hidden radio-input-recharge" value="300000">
            <label for="recharge-300"
                class="flex items-center justify-center h-12 p-4 transition duration-300 border border-2 border-gray-300 cursor-pointer w-max hover:border-gray-500 radio-label-recharge">
                300.000 VNĐ
            </label>
        </div>

        <div class="flex-auto cursor-pointer">
            <input id="recharge-500" type="radio" name="price" class="hidden radio-input-recharge" value="500000">
            <label for="recharge-500"
                class="flex items-center justify-center h-12 p-4 transition duration-300 border border-2 border-gray-300 cursor-pointer w-max hover:border-gray-500 radio-label-recharge">
                500.000 VNĐ
            </label>
        </div>

        <div class="flex-auto cursor-pointer">
            <input id="recharge-1000" type="radio" name="price" class="hidden radio-input-recharge" value="1000000">
            <label for="recharge-1000"
                class="flex items-center justify-center h-12 p-4 transition duration-300 border border-2 border-gray-300 cursor-pointer w-max hover:border-gray-500 radio-label-recharge">
                1.000.000 VNĐ
            </label>
        </div>
        <div class="flex-auto cursor-pointer">
            <input id="recharge-2000" type="radio" name="price" class="hidden radio-input-recharge" value="2000000">
            <label for="recharge-2000"
                class="flex items-center justify-center h-12 p-4 transition duration-300 border border-2 border-gray-300 cursor-pointer w-max hover:border-gray-500 radio-label-recharge">
                2.000.000 VNĐ
            </label>
        </div>
    </div>

    <div class="grid hidden grid-flow-col grid-cols-2 gap-2 mt-5 form-info-recharge">
        <div class="info">
            <input type="hidden" id="tranid" value="">
            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
            <h1>Thông tin giao dịch</h1>
            <div class="flex mt-3">
                <div class="flex-initial w-64 mt-auto mb-auto">
                    <p class="inline-block text-sm align-middle text-zinc-400">Mệnh giá</p>
                </div>
                <div class="flex-none ml-2">
                    <p class="inline-block text-sm align-middle text-zinc-600 text-money"></p>
                </div>
            </div>
            <div class="flex mt-3">
                <div class="flex-initial w-64 mt-auto mb-auto">
                    <p class="inline-block text-sm align-middle text-zinc-400">Phương thức thanh toán </p>
                </div>
                <div class="flex-none ml-2">
                    <p class="inline-block text-sm align-middle text-zinc-600 text-bank"></p>
                </div>
            </div>
            <div class="flex mt-3">
                <div class="flex-initial w-64 mt-auto mb-auto">
                    <p class="inline-block text-sm align-middle text-zinc-400">Tài khoản</p>
                </div>
                <div class="flex-none ml-2">
                    <p class="inline-block text-sm align-middle text-zinc-600">{{ Auth::user()->name }}</p>
                </div>
            </div>
            <div class="flex mt-3">
                <div class="flex-initial w-64 mt-auto mb-auto">
                    <p class="inline-block text-sm align-middle text-zinc-400">Tên người nhận</p>
                </div>
                <div class="flex-none ml-2">
                    <p class="inline-block text-sm text-red-600 align-middle text-name-bank-transfer"></p>
                </div>
            </div>
            <div class="flex mt-3">
                <div class="flex-initial w-64 mt-auto mb-auto">
                    <p class="inline-block text-sm align-middle text-zinc-400">Nội dung chuyển khoản</p>
                </div>
                <div class="flex-none ml-2">
                    <p class="inline-block text-sm text-red-600 align-middle text-content-bank-transfer"></p>
                </div>
            </div>
        </div>
        <div class="flex flex-col items-center justify-center px-0 py-0 qr-img">
            <img src="" class="object-cover w-64 qr-pay-img">
        </div>
    </div>

    <div class="hidden form-sussces-recharge">
            <div class="p-6 bg-white md:mx-auto">
              <svg viewBox="0 0 24 24" class="w-16 h-16 mx-auto my-6 text-green-600">
                  <path fill="currentColor"
                      d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z">
                  </path>
              </svg>
              <div class="text-center">
                  <h3 class="text-base font-semibold text-center text-gray-900 md:text-2xl">Giao dịch thành công!</h3>
                  <p class="my-2 text-gray-600">Cảm ơn bạn đã hoàn tất thanh toán trực tuyến an toàn của mình.</p>
              </div>
          </div>
    </div>
@endsection
