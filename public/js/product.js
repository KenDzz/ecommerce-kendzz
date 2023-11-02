Notiflix.Notify.init({
    position: 'right-bottom'
});

$(document).ready(function () {

    // Sử dụng event delegation cho các nút size-choice
    $(document).on("change","input[type=radio][name=size-choice]",
        function () {
            $(".choose-size label").removeClass("active-choose");
            if ($(this).is(":checked")) {
                console.log("size-choice" + $(this).val());
                $(this).closest(".choose-size label").addClass("active-choose");
            }
        }
    );

    $(document).on("click",".btn-delete-product-cart",function () {
        removeCart($('.li-product-cart').attr('data-id'));
    }
);

    $("input[type=radio][name=category-choice]").change(function () {
        $(".choose-category label").removeClass("active-choose");
        if ($(this).is(":checked")) {
            console.log($(this).val());
            $(this).closest(".choose-category label").addClass("active-choose");
            if ($(this).val() != null && $(this).val() > 0) {
                getsize($(this).val());
            }
        }
    });

    $(".btn-add-product-to-cart").on("click", function() {
        var id = $('.product-content').attr('productId');
        var quantity = $('.custom-input-number-product').val();
        var size = $('input[type=radio][name=size-choice]:checked').val();
        var category = $('input[type=radio][name=category-choice]:checked').val();
        if(quantity < 1){
            Notiflix.Notify.failure(
                "Số lượng sản phẩm phải lớn hơn 0"
            );
            return;
        }

        if($('.choose-category').length > 0 && category == null){
            Notiflix.Notify.failure(
                "Vui lòng chọn loại sản phẩm!"
            );
            return;
        }

        if($('.list-product-size').length > 0 && size == null){
            Notiflix.Notify.failure(
                "Vui lòng kích cở sản phẩm!"
            );
            return;
        }
        addCart(id,quantity,category,size);
    });

    function reloadCart() {
        $.ajax({
            url: "/reload-cart",
            method: "get",
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            beforeSend: function () {
            },
            complete: function () {
            },
        })
        .done(function (data) {
            $(".list-product-cart").html("");
            var data = data["cart"];
            var totalPrice = 0;
            $.each(data, function(i, item) {
                var price = data[i].quantity * data[i].price;
                totalPrice += price;
                var totalPriceFormat = price.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
                var htmlSize = "";
                if(data[i].size != null){
                    htmlSize += ","+data[i].size;
                }
                $(".list-product-cart").append('<li class="flex py-6 li-product-cart" data-id="'+i+'"><div class="flex-shrink-0 w-24 h-24 overflow-hidden border border-gray-200 rounded-md"><img src="/'+data[i].image+'" alt="" class="object-cover object-center w-full h-full"></div><div class="flex flex-col flex-1 ml-4"><div><div class="flex justify-between text-base font-medium text-gray-900"><h3><a href="#">'+data[i].name+'</a></h3><p class="ml-4">'+totalPriceFormat+'</p></div><p class="mt-1 text-sm text-gray-500">'+data[i].category+' '+htmlSize+' </p></div><div class="flex items-end justify-between flex-1 text-sm"><p class="text-gray-500">'+data[i].quantity+'</p><div class="flex"><button type="button" class="font-medium text-indigo-600 hover:text-indigo-500 btn-delete-product-cart">Xóa</button></div></div></div></li>');
            })
            $(".total-price-cart").html(totalPrice.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }));
            $(".count-cart").html(Object.keys(data).length);
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {
        });

    }

    function removeCart(id) {
        $.ajax({
            url: "/remove-from-cart",
            method: "delete",
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                id: id,
            },
            beforeSend: function () {
            },
            complete: function () {
            },
        })
        .done(function (data) {
            if(data["status"] == true){
                reloadCart();
            }
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {
        });

    }

    function addCart(id,quantity,category,size) {
        $.ajax({
            url: "/add-to-cart",
            method: "post",
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                id: id,
                quantity: quantity,
                category: category,
                size: size
            },
            beforeSend: function () {
                Notiflix.Loading.standard();
            },
            complete: function () {
                Notiflix.Loading.remove();
            },
        })
        .done(function (data) {
            if(data["status"] == true){
                reloadCart();
            }
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {

        });

    }

    function getsize(id) {
        $.ajax({
            url: "/getsize",
            method: "post",
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                id: id,
            },
            beforeSend: function () {},
            complete: function () {},
        })
            .done(function (data) {
                $(".choose-size").html("");
                if (data["status"] == true) {
                    $(".choose-size").html(
                        '<div class="flex-initial w-32 mt-auto mb-auto"><p class="inline-block text-sm align-middle text-zinc-400">Kích cỡ</p></div><div class="flex-none ml-2"><div class="mt-10"><div class="flex items-center justify-between"><a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">Size guide</a></div><fieldset class="mt-4"><legend class="sr-only">Choose a size</legend><div class="grid grid-cols-4 gap-4 list-product-size"></div></fieldset></div></div>'
                    );
                    var obj = data["data"];
                    $.each(obj, function (key, value) {
                        if (value.quantity > 0) {
                            $(".list-product-size").append(
                                '<label class="relative flex items-center justify-center px-4 py-3 text-sm font-medium text-gray-900 uppercase transition duration-300 ease-in-out bg-white border rounded-md shadow-sm cursor-pointer active:bg-indigo-500 active:text-white hover:scale-105 group hover:bg-gray-50 focus:outline-none sm:flex-1"><input type="radio" name="size-choice" id="size-choice" value="' +
                                    value.id +
                                    '" class="sr-only" aria-labelledby="size-choice-6-label"><span id="size-choice-6-label">' +
                                    value.name +
                                    '</span><span class="absolute rounded-md pointer-events-none -inset-px" aria-hidden="true"></span></label>'
                            );
                        } else {
                            $(".list-product-size").append(
                                '<label class="relative flex items-center justify-center px-4 py-3 text-sm font-medium text-gray-200 uppercase transition duration-300 ease-in-out border rounded-md cursor-not-allowed active:bg-indigo-500 active:text-white hover:scale-105 group hover:bg-gray-50 focus:outline-none sm:flex-1 bg-gray-50"><input type="radio" name="size-choice" id="size-choice" value="' +
                                    value.id +
                                    '" disabled="disabled" class="sr-only" aria-labelledby="size-choice-7-label"><span id="size-choice-7-label">' +
                                    value.name +
                                    '</span><span aria-hidden="true" class="absolute border-2 border-gray-200 rounded-md pointer-events-none -inset-px"><svg class="absolute inset-0 w-full h-full text-gray-200 stroke-2" viewBox="0 0 100 100" preserveAspectRatio="none" stroke="currentColor"><line x1="0" y1="100" x2="100" y2="0" vector-effect="non-scaling-stroke"/></svg></span></label>'
                            );
                        }
                    });
                }
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {});
    }


    $('.radio-input-recharge').change(function() {
        $('.radio-label-recharge').removeClass('active-card-recharge');
        if ($(this).is(':checked')) {
            $("#selectedMoney").val($(this).val());
            $(this).next('.radio-label-recharge').addClass('active-card-recharge');
            console.log($(this).val());
            showInfoRecharge();
        }
    });

    $('.card-recharge').on('click', function() {
        $('.card-recharge').removeClass('active-card-recharge');
        $(this).addClass('active-card-recharge');
        $('#selectedCard').val($(this).find('span').text().trim());
        console.log($(this).find('span').text().trim());
        showInfoRecharge();
    });

    function showInfoRecharge() {
        var bankCode = $('#selectedCard').val();
        var moneySelect = $('#selectedMoney').val();
        if(bankCode == ""){
            Notiflix.Notify.failure(
                "Vui lòng chọn hình thức thanh toán!"
            );
            return;
        }
        if(moneySelect == ""){
            Notiflix.Notify.failure(
                "Vui lòng chọn mệnh giá tiền!"
            );
            return;
        }
        var formatMoney = parseInt(moneySelect, 10);
        var moneySelectFormat = formatMoney.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
        $('.form-info-recharge').removeClass('hidden');
        $('.form-sussces-recharge').addClass('hidden');
        $.ajax({
            url: "/user/info/recharge",
            method: "post",
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                code: bankCode,
                amount: formatMoney,
            },
            beforeSend: function () {
                Notiflix.Block.standard(".form-info-recharge");
            },
            complete: function () {
                Notiflix.Block.remove(".form-info-recharge");
            },
        })
            .done(function (data) {
                $('.text-money').html(moneySelectFormat);
                $('.text-bank').html(bankCode);
                $(".qr-pay-img").attr("src",data.redirectLink);
                $(".text-name-bank-transfer").html(data.bankname);
                $(".text-content-bank-transfer").html(data.content);
                $("#tranid").val(data.tranid);
                checkQR();
                console.log(data);
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {});
    }

    function checkQR() {
        $.ajax({
            url: 'qrpay/check',
            method: "post",
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                id: $("#tranid").val(),
            },
            beforeSend: function () {
            },
            complete: function () {
            },
            success: function(data) {
                console.log(data);
                if(data.code == 9){
                    $('.form-info-recharge').addClass('hidden');
                    $('.form-sussces-recharge').removeClass('hidden');
                }else{
                    setTimeout(checkQR, 30000);
                }
            },
            error: function(xhr, status, error) {
            }
        });
    }

    // Gọi hàm runAjax() để bắt đầu quá trình
    runAjax();


});



const cartButton = document.querySelector('.action-btn.btn-cart');
const cartSlideOver = document.querySelector('.form-cart');
const closeCart = document.querySelector('.btn-hidden-cart');

cartButton.addEventListener('click', () => {
  cartSlideOver.classList.toggle('hidden');
});

closeCart.addEventListener('click', () => {
    cartSlideOver.classList.toggle('hidden');
});

document.addEventListener("DOMContentLoaded", function () {
    var splide = new Splide("#main-carousel", {
        pagination: false,
    });

    var thumbnails = document.getElementsByClassName("thumbnail");
    var current;

    for (var i = 0; i < thumbnails.length; i++) {
        initThumbnail(thumbnails[i], i);
    }

    function initThumbnail(thumbnail, index) {
        thumbnail.addEventListener("click", function () {
            splide.go(index);
        });
    }

    splide.on("mounted move", function () {
        var thumbnail = thumbnails[splide.index];

        if (thumbnail) {
            if (current) {
                current.classList.remove("is-active");
            }

            thumbnail.classList.add("is-active");
            current = thumbnail;
        }
    });

    splide.mount();
});

function decrement(e) {
    const btn = e.target.parentNode.parentElement.querySelector(
        'button[data-action="decrement"]'
    );
    const target = btn.nextElementSibling;
    let value = Number(target.value);
    value--;
    target.value = value;
}

function increment(e) {
    const btn = e.target.parentNode.parentElement.querySelector(
        'button[data-action="decrement"]'
    );
    const target = btn.nextElementSibling;
    let value = Number(target.value);
    value++;
    target.value = value;
}

const decrementButtons = document.querySelectorAll(
    `button[data-action="decrement"]`
);

const incrementButtons = document.querySelectorAll(
    `button[data-action="increment"]`
);

decrementButtons.forEach((btn) => {
    btn.addEventListener("click", decrement);
});

incrementButtons.forEach((btn) => {
    btn.addEventListener("click", increment);
});
