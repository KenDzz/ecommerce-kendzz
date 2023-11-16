Notiflix.Notify.init({
    position: "right-bottom",
});

$(document).ready(function () {
    getCostShipping();

    // Sử dụng event delegation cho các nút size-choice
    $(document).on(
        "change",
        "input[type=radio][name=size-choice]",
        function () {
            $(".choose-size label").removeClass("active-choose");
            if ($(this).is(":checked")) {
                console.log("size-choice" + $(this).val());
                $(this).closest(".choose-size label").addClass("active-choose");
            }
        }
    );

    $(document).on("click", ".btn-delete-product-cart", function () {
        removeCart($(".li-product-cart").attr("data-id"));
    });

    $("#btn-modal-add-address").click(function () {
        $("#address-modal").toggleClass("hidden");
        var selectElement = $("#province-modal-address");
        if (selectElement.children().length < 2) {
            getProvince();
        }
    });

    $("#btn-close-modal-address").click(function () {
        $("#address-modal").toggleClass("hidden");
    });

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

    $(".btn-pay-cart").click(function () {
        pay();
    });

    $(".btn-add-address").click(function () {
        var name = $('#name-modal-address').val();
        var phone = $('#phone-modal-address').val();
        var province = $('#province-modal-address').val();
        var city = $('#city-modal-address').val();
        var district = $('#district-modal-address').val();
        var address = $('.info-modal-address').val();
        var postalcode = $('#postal-modal-address').val();
        var note = $('#note-modal-address').val();
        if(checkAddAdress(name,phone,province,city,district,address)){
            addAdress(name,phone,province,city,district,address,postalcode,note);
        }else{
            Notiflix.Notify.failure("Vui lòng đầy đủ thông tin!");
        }
    });


    $('.checkbox-shipping-address').on('change', function() {
        // Handle the change event here
        $('.checkbox-shipping-address').not(this).prop('checked', false);
        var isChecked = $(this).prop('checked');
        console.log('Checkbox state changed: ', isChecked);
        defaultShipAddress($(this).attr('attr-id'),isChecked)
    });

    $(document).on("change", "#province-modal-address", function () {
        var element = $(this).find("option:selected");
        var code = element.attr("attr-code");
        getCity(code);
    });

    $(document).on("change", "#city-modal-address", function () {
        var element = $(this).find("option:selected");
        var code = element.attr("attr-code");
        getDistrict(code);
    });

    $('#price').on('keydown', function() {
        var price = $(this).val();
        var newPrice = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(price);
        $(this).val(newPrice);
    });

    const autoCompleteJS = new autoComplete({
        placeHolder: "Nhập địa chỉ",
        data: {
            src: async (query) => {
                try {
                    const province = $("#province-modal-address option:selected").val();
                    const city = $("#city-modal-address option:selected").val();
                    const district = $("#district-modal-address option:selected").val();
                    if ((province && province != null) && (city && city != null) && (district && district != null)) {
                        const source = await fetch(
                            `/user/shipping/addresses/${query}/${province}/${city}/${district}`
                        );
                        const dataRes = await source.json();
                        return dataRes;
                    }
                } catch (error) {
                    return error;
                }
            },
            cache: false,
        },
        resultItem: {
            highlight: true,
        },
        events: {
            input: {
                selection: (event) => {
                    const selection = event.detail.selection.value;
                    autoCompleteJS.input.value = selection;
                    console.log("selection!");

                },
                focus: (event) => {
                    console.log("Input Field in focus!");
                  }
            },
        },
    });

    $(".btn-add-product-to-cart").on("click", function () {
        var id = $(".product-content").attr("productId");
        var quantity = $(".custom-input-number-product").val();
        var size = $("input[type=radio][name=size-choice]:checked").val();
        var category = $(
            "input[type=radio][name=category-choice]:checked"
        ).val();
        if (quantity < 1) {
            Notiflix.Notify.failure("Số lượng sản phẩm phải lớn hơn 0");
            return;
        }

        if ($(".choose-category").length > 0 && category == null) {
            Notiflix.Notify.failure("Vui lòng chọn loại sản phẩm!");
            return;
        }

        if ($(".list-product-size").length > 0 && size == null) {
            Notiflix.Notify.failure("Vui lòng kích cở sản phẩm!");
            return;
        }
        addCart(id, quantity, category, size);
    });

    function reloadCart() {
        $.ajax({
            url: "/reload-cart",
            method: "get",
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            beforeSend: function () {},
            complete: function () {},
        })
            .done(function (data) {
                $(".list-product-cart").html("");
                var data = data["cart"];
                var totalPrice = 0;
                $.each(data, function (i, item) {
                    var price = data[i].quantity * data[i].price;
                    totalPrice += price;
                    var totalPriceFormat = price.toLocaleString("vi-VN", {
                        style: "currency",
                        currency: "VND",
                    });
                    var htmlSize = "";
                    if (data[i].size != null) {
                        htmlSize += "," + data[i].size;
                    }
                    $(".list-product-cart").append(
                        '<li class="flex py-6 li-product-cart" data-id="' +
                            i +
                            '"><div class="flex-shrink-0 w-24 h-24 overflow-hidden border border-gray-200 rounded-md"><img src="/' +
                            data[i].image +
                            '" alt="" class="object-cover object-center w-full h-full"></div><div class="flex flex-col flex-1 ml-4"><div><div class="flex justify-between text-base font-medium text-gray-900"><h3><a href="#">' +
                            data[i].name +
                            '</a></h3><p class="ml-4">' +
                            totalPriceFormat +
                            '</p></div><p class="mt-1 text-sm text-gray-500">' +
                            data[i].category +
                            " " +
                            htmlSize +
                            ' </p></div><div class="flex items-end justify-between flex-1 text-sm"><p class="text-gray-500">' +
                            data[i].quantity +
                            '</p><div class="flex"><button type="button" class="font-medium text-indigo-600 hover:text-indigo-500 btn-delete-product-cart">Xóa</button></div></div></div></li>'
                    );
                });
                $(".total-price-cart").html(
                    totalPrice.toLocaleString("vi-VN", {
                        style: "currency",
                        currency: "VND",
                    })
                );
                $(".count-cart").html(Object.keys(data).length);
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {});
    }

    function pay(){
        $.ajax({
            url: "/user/pay",
            method: "post",
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
            },
            beforeSend: function () {
                Notiflix.Block.standard(".showcase-container");
            },
            complete: function () {
                Notiflix.Block.remove(".showcase-container");
            },
        })
            .done(function (data) {
                if (data['status'] == false) {
                    Notiflix.Notify.failure(data['content']);
                    return;
                }
                reloadCart()
                $(".form-payment").addClass("hidden");
                $(".btn-pay-cart").addClass("hidden");
                $(".payment-susses").removeClass("hidden");
                $(".tab-one").addClass("blur-box");
                console.log(data);
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {});
    }


    function getCostShipping() {
        if ($('.text-cost-shipping').length > 0) {
            $.ajax({
                url: "/user/checkout/cost/shipping",
                method: "post",
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                data: {
                },
                beforeSend: function () {
                    Notiflix.Block.standard(".form-choose-shipping");
                },
                complete: function () {
                    Notiflix.Block.remove(".form-choose-shipping");
                },
            })
                .done(function (data) {
                    $('.text-cost-shipping').html(data['price'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + "đ");
                    var totalPrice = parseInt($('.text-total-price-checkout').attr('attr-price'));
                    totalPrice += parseInt(data['price']);
                    $('.text-total-price-checkout').html(totalPrice.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + "đ");
                })
                .fail(function (jqXHR, ajaxOptions, thrownError) {});
        }
    }


    function defaultShipAddress(id,status) {
        status = status ? 1 : 0;
        $.ajax({
            url: "/user/shipping/add/addresses/default",
            method: "post",
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                id: id,
                status: status,
            },
            beforeSend: function () {},
            complete: function () {},
        })
            .done(function (data) {
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {});
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
            beforeSend: function () {},
            complete: function () {},
        })
            .done(function (data) {
                if (data["status"] == true) {
                    reloadCart();
                }
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {});
    }

    function checkAddAdress(name,phone,province,city,district,address){
        if(name != null && phone != null && province != null && city != null && district != null && address != null){
            return true;
        }
        return false;
    }

    function addAdress(name,phone,province,city,district,address,postalcode,note) {
        $.ajax({
            url: "/user/shipping/add/addresses",
            method: "post",
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                name: name,
                phone: phone,
                province: province,
                city: city,
                district: district,
                address: address,
                postalcode: postalcode,
                note: note,
            },
            beforeSend: function () {
                Notiflix.Block.standard(".modal-add-address");

            },
            complete: function () {
                Notiflix.Block.remove(".modal-add-address");

            },
        })
            .done(function (data) {
                if(data["status"] == true){
                    loadUiShippingAdress(data['data']);
                    $('.form-add-address').trigger("reset");
                    $("#address-modal").toggleClass("hidden");
                }else{
                    Notiflix.Notify.failure("Lỗi hệ thống!");
                }
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {});
    }

    function loadUiShippingAdress(data){
        $(".tbody-shipping-adress").html('');
        data.forEach(element => {
            var IsUsed = '<div class="h-2.5 w-2.5 rounded-full bg-red-500"></div>';
            var isChecked = '';
            if(element['is_used']){
                var IsUsed = '<div class="h-2.5 w-2.5 rounded-full bg-green-500">';
                var isChecked = 'checked';

            }
            $(".tbody-shipping-adress").append('<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"><th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white"><div class="pl-3"><div class="text-base font-semibold">'+element['name']+'</div><div class="font-normal text-gray-500">+84 '+element['phone']+'</div></div>'+IsUsed+'</th><td class="px-6 py-4">'+element['province']+', '+element['city']+', '+element['district']+'</td><td class="px-6 py-4">'+element['address']+'</td><td class="px-6 py-4"></td><td class="px-6 py-4"><label class="relative inline-flex items-center cursor-pointer"><input type="checkbox" value="" attr-id="'+element['id']+'" class="sr-only peer checkbox-shipping-address" '+isChecked+'><div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-pink-300 dark:peer-focus:ring-pink-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-pink-600"></div></label></td></tr>');
        });
    }

    function addCart(id, quantity, category, size) {
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
                size: size,
            },
            beforeSend: function () {
                Notiflix.Loading.standard();
            },
            complete: function () {
                Notiflix.Loading.remove();
            },
        })
            .done(function (data) {
                if (data["status"] == true) {
                    reloadCart();
                }
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {});
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

    $(".radio-input-recharge").change(function () {
        $(".radio-label-recharge").removeClass("active-card-recharge");
        if ($(this).is(":checked")) {
            $("#selectedMoney").val($(this).val());
            $(this)
                .next(".radio-label-recharge")
                .addClass("active-card-recharge");
            console.log($(this).val());
            showInfoRecharge();
        }
    });

    $(".card-recharge").on("click", function () {
        $(".card-recharge").removeClass("active-card-recharge");
        $(this).addClass("active-card-recharge");
        $("#selectedCard").val($(this).find("span").text().trim());
        console.log($(this).find("span").text().trim());
        showInfoRecharge();
    });

    function showInfoRecharge() {
        var bankCode = $("#selectedCard").val();
        var moneySelect = $("#selectedMoney").val();
        if (bankCode == "") {
            Notiflix.Notify.failure("Vui lòng chọn hình thức thanh toán!");
            return;
        }
        if (moneySelect == "") {
            Notiflix.Notify.failure("Vui lòng chọn mệnh giá tiền!");
            return;
        }
        var formatMoney = parseInt(moneySelect, 10);
        var moneySelectFormat = formatMoney.toLocaleString("vi-VN", {
            style: "currency",
            currency: "VND",
        });
        $(".form-info-recharge").removeClass("hidden");
        $(".form-sussces-recharge").addClass("hidden");
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
                $(".text-money").html(moneySelectFormat);
                $(".text-bank").html(bankCode);
                $(".qr-pay-img").attr("src", data.redirectLink);
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
            url: "qrpay/check",
            method: "post",
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                id: $("#tranid").val(),
            },
            beforeSend: function () {},
            complete: function () {},
            success: function (data) {
                console.log(data);
                if (data.code == 9) {
                    $(".form-info-recharge").addClass("hidden");
                    $(".form-sussces-recharge").removeClass("hidden");
                } else {
                    setTimeout(checkQR, 30000);
                }
            },
            error: function (xhr, status, error) {},
        });
    }

    // Gọi hàm runAjax() để bắt đầu quá trình
    runAjax();


    var TomSelectProvince;
    var TomSelectCity;
    var TomSelectDistrict;
    //Search Select
    function getProvince() {
        $.ajax({
            url: "https://provinces.open-api.vn/api/?depth=1",
            method: "get",
            dataType: "json",
            beforeSend: function () {},
            complete: function () {},
            success: function (data) {
                $("#province-modal-address").html("");
                data.forEach((element) => {
                    var name = element.name.replace("Tỉnh ", "").replace("Thành phố ", "");
                    $("#province-modal-address").append(
                        '<option value="' +
                            name +
                            '" attr-code="' +
                            element.code +
                            '">' +
                            name +
                            "</option>"
                    );
                });
                if(TomSelectProvince){
                    TomSelectProvince.clear(); // unselect previously selected elements
                    TomSelectProvince.clearOptions(); // remove existing options
                    TomSelectProvince.sync(); // synchronise with the underlying SELECT
                }else{
                    TomSelectProvince =  new TomSelect("#province-modal-address", {
                        create: true,
                        sortField: {
                            field: "text",
                            direction: "asc",
                        },
                    });
                }

            },
            error: function (xhr, status, error) {},
        });
    }

    function getCity(code) {
        $.ajax({
            url: "https://provinces.open-api.vn/api/p/" + code + "?depth=2",
            method: "get",
            dataType: "json",
            beforeSend: function () {},
            complete: function () {},
            success: function (data) {
                const districts = data.districts;
                $("#city-modal-address").html("");
                districts.forEach((element) => {
                    $("#city-modal-address").append(
                        '<option value="' +
                            element.name +
                            '" attr-code="' +
                            element.code +
                            '">' +
                            element.name +
                            "</option>"
                    );
                });
                if(TomSelectCity){
                    TomSelectCity.clear(); // unselect previously selected elements
                    TomSelectCity.clearOptions(); // remove existing options
                    TomSelectCity.sync(); // synchronise with the underlying SELECT
                }else{
                    TomSelectCity =  new TomSelect("#city-modal-address", {
                        create: true,
                        sortField: {
                            field: "text",
                            direction: "asc",
                        },
                    });
                }
            },
            error: function (xhr, status, error) {},
        });
    }

    function getDistrict(code) {
        $.ajax({
            url: "https://provinces.open-api.vn/api/d/" + code + "?depth=2",
            method: "get",
            dataType: "json",
            beforeSend: function () {},
            complete: function () {},
            success: function (data) {
                const wards = data.wards;
                $("#district-modal-address").html("");
                wards.forEach((element) => {
                    $("#district-modal-address").append(
                        '<option value="' +
                            element.name +
                            '" attr-code="' +
                            element.code +
                            '">' +
                            element.name +
                            "</option>"
                    );
                });
                if(TomSelectDistrict){
                    TomSelectDistrict.clear(); // unselect previously selected elements
                    TomSelectDistrict.clearOptions(); // remove existing options
                    TomSelectDistrict.sync(); // synchronise with the underlying SELECT
                }else{
                    TomSelectDistrict =  new TomSelect("#district-modal-address", {
                        create: true,
                        sortField: {
                            field: "text",
                            direction: "asc",
                        },
                    });
                }
            },
            error: function (xhr, status, error) {},
        });
    }

});

const cartButton = document.querySelector(".action-btn.btn-cart");
const cartSlideOver = document.querySelector(".form-cart");
const closeCart = document.querySelector(".btn-hidden-cart");

cartButton.addEventListener("click", () => {
    cartSlideOver.classList.toggle("hidden");
});

closeCart.addEventListener("click", () => {
    cartSlideOver.classList.toggle("hidden");
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
