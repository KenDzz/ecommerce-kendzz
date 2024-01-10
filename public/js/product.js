Notiflix.Notify.init({
    position: "right-bottom",
});


$(document).ready(function () {

    $("#form-reg-seller").submit(function (e) {
        e.preventDefault();
    });


    $("#form-info-ekyc").submit(function (e) {
        e.preventDefault();
    });


    getCostShipping();
    reloadFavourite();
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

    $(document).on("click", ".btn-delete-product-favourite", function () {
        console.log($(this).attr("data-product-id"));
        removeFavourite($(this).attr("data-product-id"));
    });

    $("#btn-modal-add-address").click(function () {
        $("#address-modal").toggleClass("hidden");
        var selectElement = $("#province-modal-address");
        if (selectElement.children().length < 2) {
            getProvince();
        }
    });

    if ($("#province-modal-address").children().length < 2) {
        getProvince();
    }

    $("#btn-close-modal-address").click(function () {
        $("#address-modal").toggleClass("hidden");
    });

    //Product Review
    $(".btn-open-product-review").click(function () {
        if (!$(this).hasClass("cursor-not-allowed")) {
            $("#data-product-id").val($(this).attr("data-product-id"));
            $("#data-order-id").val($(this).attr("data-order-id"));
            $("#product-review-modal").toggleClass("hidden");
        }
    });

    function isNumeric(str) {
        return /^\d+(\.\d+)?$/.test(str);
    }


    function containsCity(searchString) {
        var city = ["Thành phố Hà Nội","Tỉnh Hà Giang","Tỉnh Cao Bằng","Tỉnh Bắc Kạn","Tỉnh Tuyên Quang","Tỉnh Lào Cai","Tỉnh Điện Biên","Tỉnh Lai Châu","Tỉnh Sơn La","Tỉnh Yên Bái","Tỉnh Hoà Bình","Tỉnh Thái Nguyên","Tỉnh Lạng Sơn","Tỉnh Quảng Ninh","Tỉnh Bắc Giang","Tỉnh Phú Thọ","Tỉnh Vĩnh Phúc","Tỉnh Bắc Ninh","Tỉnh Hải Dương","Thành phố Hải Phòng","Tỉnh Hưng Yên","Tỉnh Thái Bình","Tỉnh Hà Nam","Tỉnh Nam Định","Tỉnh Ninh Bình","Tỉnh Thanh Hóa","Tỉnh Nghệ An","Tỉnh Hà Tĩnh","Tỉnh Quảng Bình","Tỉnh Quảng Trị","Tỉnh Thừa Thiên Huế","Thành phố Đà Nẵng","Tỉnh Quảng Nam","Tỉnh Quảng Ngãi","Tỉnh Bình Định","Tỉnh Phú Yên","Tỉnh Khánh Hòa","Tỉnh Ninh Thuận","Tỉnh Bình Thuận","Tỉnh Kon Tum","Tỉnh Gia Lai","Tỉnh Đắk Lắk","Tỉnh Đắk Nông","Tỉnh Lâm Đồng","Tỉnh Bình Phước","Tỉnh Tây Ninh","Tỉnh Bình Dương","Tỉnh Đồng Nai","Tỉnh Bà Rịa - Vũng Tàu","Thành phố Hồ Chí Minh","Tỉnh Long An","Tỉnh Tiền Giang","Tỉnh Bến Tre","Tỉnh Trà Vinh","Tỉnh Vĩnh Long","Tỉnh Đồng Tháp","Tỉnh An Giang","Tỉnh Kiên Giang","Thành phố Cần Thơ","Tỉnh Hậu Giang","Tỉnh Sóc Trăng","Tỉnh Bạc Liêu","Tỉnh Cà Mau"];
        var searchTerms = searchString.split(/[,\.]+/);
        for (var i = 0; i < city.length; i++) {
            var provinceName = city[i].toLowerCase();
            for (var j = 0; j < searchTerms.length; j++) {
                var searchTermsSecond = searchTerms[j].split(" ");
                if (searchTermsSecond.length > 1 && provinceName.includes(searchTerms[j].toLowerCase())) {
                    return true;
                }
            }
        }
        return false;
    }

    function containsLastNameCaseInsensitive(str) {
        var lastName = ['Nguyễn','Trần','Lê', 'Hoàng', 'Huỳnh', 'Phạm', 'Võ', 'Vũ', 'Phan', 'Trương', 'Bùi', 'Đặng', 'Đỗ', 'Ngô', 'Hồ', 'Dương', 'Đinh'];
        var lowerStr = str.toLowerCase();
        return lastName.some(function(name) {
          return lowerStr.includes(name.toLowerCase());
        });
    }


      function parseDateFromString(dateString) {
        var parts = dateString.split(/[-\.]/);
        if (parts.length === 3) {
          var day = parseInt(parts[0], 10);
          var month = parseInt(parts[1], 10);
          var year = parseInt(parts[2], 10);
          var date = new Date(year, month - 1, day);

          if (date.getFullYear() === year && date.getMonth() === month - 1 && date.getDate() === day) {
            return year.toString().padStart(4, '0') + '-' +
                   month.toString().padStart(2, '0') + '-' +
                   day.toString().padStart(2, '0');
          }
        }
        return null;
      }

    $("#file-upload").on("change", function () {
        var fileInput = $(this)[0].files[0];
        var formData = new FormData();
        formData.append("files", fileInput);
        $.ajax({
            url: "http://127.0.0.1:8000/eKYC/",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {
                Notiflix.Loading.standard();
            },
            complete: function () {
                Notiflix.Loading.remove();
            },
            success: function (response) {
                logEkyc(response);
                var isNumber = false;
                var isName = false;
                var isbirthday = false;
                var addressOne = false;
                var addressSecond = false;
                $('#animated-thumbnails').html('<a class="p-2 transition ease-in-out opacity-50 delay-10 hover:scale-110 item hover:opacity-100" href="'+response.imagecrop+'"><img class="img-cmnd" src="'+response.imagecrop+'"></a>');
                $.each(response.text, function (i, item) {
                    console.log(item);
                    if(isNumeric(item) && !isNumber){
                        isNumber = true;
                        $("#numbercmnd").val(item);
                    }
                    if(containsLastNameCaseInsensitive(item) && !isName){
                        isName = true;
                        $("#name-info-ekyc").val(item);
                    }
                    if(parseDateFromString(item) !== null && !isbirthday){
                        isbirthday = true;
                        $("#birthday").val(parseDateFromString(item));
                    }
                    if(containsCity(item) && !addressOne){
                        addressOne = true;
                        $("#addressone").val(item);
                    }
                    if(containsCity(item)  && !addressSecond){
                        addressSecond = true;
                        $("#addresssecond").val(item);
                    }
                });
            },
            error: function (data) {
                Notiflix.Loading.remove();
                Swal.fire({
                    title: "Xác minh không thành công!",
                    text: "Vui lòng sử dụng giấy tờ thật. Hãy đảm bảo ảnh chụp hoặc tải lên không bị mờ hoặc bóng, thông tin hiển thị rõ ràng, dễ đọc trong điều kiện đầy đủ ánh sáng.",
                    icon: "error"
                });
            },
        }).fail(function (jqXHR, ajaxOptions, thrownError) {
            Notiflix.Loading.remove();
            Swal.fire({
                title: "Xác minh không thành công!",
                text: "Vui lòng sử dụng giấy tờ thật. Hãy đảm bảo ảnh chụp hoặc tải lên không bị mờ hoặc bóng, thông tin hiển thị rõ ràng, dễ đọc trong điều kiện đầy đủ ánh sáng.",
                icon: "error"
            });
        });
    });


    $("#file-upload-face").on("change", function () {
        var fileInput = $(this)[0].files[0];
        var formData = new FormData();
        formData.append("upload", fileInput);
        $.ajax({
            url: "/user/reg/seller/add/face",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            beforeSend: function () {
                Notiflix.Loading.standard();
            },
            complete: function () {
                Notiflix.Loading.remove();
            },
            success: function (response) {
                if(response['result'] == true){
                    $(".face-img-ekyc").html('<a class="p-2 transition ease-in-out opacity-50 delay-10 hover:scale-110 item hover:opacity-100" href="'+response['path']+'"><img class="img-face" src="'+response['path']+'"></a>');
                }else{
                    Swal.fire({
                        title: "Xác minh không thành công!",
                        text: "Xác minh ảnh chân dung bằng cách chụp ảnh trên tay cầm CMND, một tờ giấy có chữ ký cùng dòng chữ “Bán hàng cùng Anon“ viết tay và ghi rõ ngày thực hiện",
                        icon: "error"
                    });
                }
            },
            error: function (data) {
                Notiflix.Loading.remove();
                Swal.fire({
                    title: "Xác minh không thành công!",
                    text: "Xác minh ảnh chân dung bằng cách chụp ảnh trên tay cầm CMND, một tờ giấy có chữ ký cùng dòng chữ “Bán hàng cùng Anon“ viết tay và ghi rõ ngày thực hiện",
                    icon: "error"
                });
            },
        }).fail(function (jqXHR, ajaxOptions, thrownError) {
            Notiflix.Loading.remove();
            Swal.fire({
                title: "Xác minh không thành công!",
                text: "Xác minh ảnh chân dung bằng cách chụp ảnh trên tay cầm CMND, một tờ giấy có chữ ký cùng dòng chữ “Bán hàng cùng Anon“ viết tay và ghi rõ ngày thực hiện",
                icon: "error"
            });
        });
    });


    function logEkyc(json) {
        $.ajax({
            url: "/user/reg/seller/log",
            method: "post",
            dataType: "json",
            data: json,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            beforeSend: function () {},
            complete: function () {},
            error: function (data) {
                var errors = $.parseJSON(data.responseText);
                Notiflix.Notify.failure(errors["message"]);
            },
        })
        .done(function (data) {})
        .fail(function (jqXHR, ajaxOptions, thrownError) {});
    }

    $(".next-face").click(function () {
        var formData = new FormData($("#form-info-ekyc")[0]);
        $.ajax({
            url: "/user/reg/seller/add/info/ekyc",
            method: "post",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            beforeSend: function () {
                Notiflix.Loading.standard();
            },
            complete: function () {
                Notiflix.Loading.remove();
            },
            success: function (response) {
                console.log(response);
                if(response["status"] == true){
                    $(".info-ekyc").addClass("hidden-important");
                    $(".add-face-ekyc").removeClass("hidden-important");
                }else{
                    Notiflix.Notify.failure(response["message"]);
                }
            },
            error: function (data) {
                var errors = $.parseJSON(data.responseText);
                Notiflix.Notify.failure(errors["message"]);
            },
        });
    });

    $(".next-info-ekyc").click(function () {
        if($(".img-cmnd")[0]){
            $(".info-ekyc").removeClass("hidden-important");
            $(".add-ekyc").addClass("hidden-important");
        }else{
            Swal.fire({
                title: "Xác minh không thành công!",
                text: "Vui lòng sử dụng giấy tờ thật. Hãy đảm bảo ảnh chụp hoặc tải lên không bị mờ hoặc bóng, thông tin hiển thị rõ ràng, dễ đọc trong điều kiện đầy đủ ánh sáng.",
                icon: "error"
            });
        }
    });

    $(".next-confirm-ekyc").click(function () {
        if($(".img-face")[0]){
            $(".confirm-ekyc").removeClass("hidden-important");
            $(".add-face-ekyc").addClass("hidden-important");
        }else{
            Swal.fire({
                title: "Xác minh không thành công!",
                text: "Xác minh ảnh chân dung bằng cách chụp ảnh trên tay cầm CMND, một tờ giấy có chữ ký cùng dòng chữ “Bán hàng cùng Anon“ viết tay và ghi rõ ngày thực hiện",
                icon: "error"
            });
        }
    });


    $(".next-step-ekyc").click(function () {
        var formData = new FormData($("#form-reg-seller")[0]);
        $.ajax({
            url: "/user/reg/seller/add/info",
            method: "post",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            beforeSend: function () {
                Notiflix.Loading.standard();
            },
            complete: function () {
                Notiflix.Loading.remove();
            },
            success: function (response) {
                console.log(response);
                if (response["status"] == "true") {
                    Swal.fire({
                        title: "Xác minh số điện thoại",
                        text: "Mã OTP đã được gửi đến số điện thoại của bạn",
                        input: "text",
                        inputAttributes: {
                          autocapitalize: "off"
                        },
                        showDenyButton: true,
                        showCancelButton: false,
                        confirmButtonText: "Xác nhận",
                        showLoaderOnConfirm: true,
                        denyButtonText: `Hủy`,
                        preConfirm: async (otp) => {
                            try {
                              const response = await fetch('/user/reg/seller/otp', {
                                method: 'POST',
                                headers: {
                                  'Content-Type': 'application/json',
                                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content"),
                                },
                                body: JSON.stringify({otp: otp})
                              });
                              if (!response.ok) {
                                const responseBody = await response.json();
                                return Swal.showValidationMessage(responseBody.message);
                              }
                              return response.json();
                            } catch (error) {
                              Swal.showValidationMessage(`
                                Request failed: ${error}
                              `);
                            }
                          },
                          allowOutsideClick: () => !Swal.isLoading()
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: "Xác minh thành công!",
                                icon: "success",
                                showCancelButton: false,
                                confirmButtonColor: "#3085d6",
                                confirmButtonText: "Tiếp tục xác minh"
                              }).then((result) => {
                                if (result.isConfirmed) {
                                    $(".add-info-seller").addClass("hidden-important");
                                    $(".add-ekyc").removeClass("hidden-important");
                                }
                              });
                        }
                    });
                } else {
                    Notiflix.Notify.failure(
                        "Lỗi! Vui lòng kiểm tra lại thông tin!"
                    );
                }
            },
            error: function (data) {
                var errors = $.parseJSON(data.responseText);
                Notiflix.Notify.failure(errors["message"]);
            },
        });
    });

    $("#btn-close-product-review").click(function () {
        $("#product-review-modal").toggleClass("hidden");
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

    $(".action-btn.btn-favourite").click(function () {
        reloadFavourite();
        $(".form-favourite").toggleClass("hidden");
    });

    $(".btn-hidden-favourite").click(function () {
        $(".form-favourite").toggleClass("hidden");
    });

    $(".btn-add-address").click(function () {
        var name = $("#name-modal-address").val();
        var phone = $("#phone-modal-address").val();
        var province = $("#province-modal-address").val();
        var city = $("#city-modal-address").val();
        var district = $("#district-modal-address").val();
        var address = $(".info-modal-address").val();
        var postalcode = $("#postal-modal-address").val();
        var note = $("#note-modal-address").val();
        if (checkAddAdress(name, phone, province, city, district, address)) {
            addAdress(
                name,
                phone,
                province,
                city,
                district,
                address,
                postalcode,
                note
            );
        } else {
            Notiflix.Notify.failure("Vui lòng đầy đủ thông tin!");
        }
    });

    $(".checkbox-shipping-address").on("change", function () {
        // Handle the change event here
        $(".checkbox-shipping-address").not(this).prop("checked", false);
        var isChecked = $(this).prop("checked");
        console.log("Checkbox state changed: ", isChecked);
        defaultShipAddress($(this).attr("attr-id"), isChecked);
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

    $("#price").on("keydown", function () {
        var price = $(this).val();
        var newPrice = new Intl.NumberFormat("vi-VN", {
            style: "currency",
            currency: "VND",
        }).format(price);
        $(this).val(newPrice);
    });

    const autoCompleteJS = new autoComplete({
        placeHolder: "Nhập địa chỉ",
        data: {
            src: async (query) => {
                try {
                    const province = $(
                        "#province-modal-address option:selected"
                    ).val();
                    const city = $("#city-modal-address option:selected").val();
                    const district = $(
                        "#district-modal-address option:selected"
                    ).val();
                    if (
                        province &&
                        province != null &&
                        city &&
                        city != null &&
                        district &&
                        district != null
                    ) {
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
                },
            },
        },
    });

    $(".btn-action-favourite").on("click", function () {
        var id = $(this).attr("data-product-id");
        $.ajax({
            url: "/user/product/favourite",
            method: "post",
            dataType: "json",
            data: {
                id: id,
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            beforeSend: function () {},
            complete: function () {},
            error: function (data) {
                var errors = $.parseJSON(data.responseText);
                Notiflix.Notify.failure(errors["message"]);
            },
        })
            .done(function (data) {
                if (data["status"] == "add") {
                    $(".icon-favourite-product-" + id).addClass("color-icon");
                    Notiflix.Notify.success("Thêm thành công!");
                } else {
                    $(".icon-favourite-product-" + id).removeClass(
                        "color-icon"
                    );
                    Notiflix.Notify.success("Thêm thành công!");
                    Notiflix.Notify.success("Hủy thành công!");
                }
                reloadFavourite();
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {});
    });

    $(".btn-post-review").on("click", function () {
        $.ajax({
            url: "review",
            method: "post",
            dataType: "json",
            data: $("#form-review").serialize(),
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            beforeSend: function () {},
            complete: function () {},
            error: function (data) {
                if (data.status === 422) {
                    var errors = $.parseJSON(data.responseText);
                    Notiflix.Notify.failure(errors["message"]);
                }
            },
        })
            .done(function (data) {
                location.reload();
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {});
    });

    $(".btn-buy-product").on("click", function () {
        var result = addCartClick();
        if (result) {
            setTimeout(() => {
                var url = "/user/checkout";
                $(location).attr("href", url);
            }, 1000);
        }
    });

    $("#coupons-text").on("keyup", function () {
        checkCoupons($(this).val());
    });

    function checkCoupons(id) {
        $.ajax({
            url: "/checkCoupons",
            method: "post",
            dataType: "json",
            data: {
                id: id,
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            beforeSend: function () {},
            complete: function () {},
        })
            .done(function (data) {
                var cost = $(".text-cost-shipping").attr("attr-price");
                var totalPrice = $(".text-total-price-checkout").attr(
                    "attr-price"
                );
                var priceProduct = $(".price-product").attr(
                    "attr-price"
                );

                if (data.status == true) {
                    $(".title-tooltip").text(data.data.name);
                    $(".desc-tooltip").text(data.data.describes);
                    $(".vaildate-coupons").text(" "+data.validate);
                    if (data.data.type == 0) {
                        $(".form-coupons").removeClass("hidden");
                        var costReduce = cost * (data.data.discount / 100);
                        totalPrice -= costReduce;
                        $(".text-total-price-checkout").html(
                            totalPrice
                                .toString()
                                .replace(/\B(?=(\d{3})+(?!\d))/g, ".") + "đ"
                        );
                        $(".title-coupons").html("");
                        $(".title-coupons").html(
                            data.data.name + " (-" + data.data.discount + "%)"
                        );
                        $(".text-coupons").html("");
                        $(".text-coupons").html(
                            "-" +
                                costReduce
                                    .toString()
                                    .replace(/\B(?=(\d{3})+(?!\d))/g, ".") +
                                "đ" +
                                ""
                        );
                    }else{
                        $(".form-coupons").removeClass("hidden");
                        var costReduce = priceProduct * (data.data.discount / 100);
                        totalPrice -= costReduce;
                        $(".text-total-price-checkout").html(
                            totalPrice
                                .toString()
                                .replace(/\B(?=(\d{3})+(?!\d))/g, ".") + "đ"
                        );
                        $(".title-coupons").html("");
                        $(".title-coupons").html(
                            data.data.name + " (-" + data.data.discount + "%)"
                        );
                        $(".text-coupons").html("");
                        $(".text-coupons").html(
                            "-" +
                                costReduce
                                    .toString()
                                    .replace(/\B(?=(\d{3})+(?!\d))/g, ".") +
                                "đ" +
                                ""
                        );
                    }
                } else {
                    $(".form-coupons").addClass("hidden");
                    $(".text-total-price-checkout").html(
                        totalPrice
                            .toString()
                            .replace(/\B(?=(\d{3})+(?!\d))/g, ".") + "đ"
                    );
                    Notiflix.Notify.failure("Mã giảm giá không tồn tại!");
                }
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {});
    }

    $(".btn-add-product-to-cart").on("click", function () {
        addCartClick();
    });

    function addCartClick() {
        var id = $(".product-content").attr("productId");
        var quantity = $(".custom-input-number-product").val();
        var size = $("input[type=radio][name=size-choice]:checked").val();
        var category = $(
            "input[type=radio][name=category-choice]:checked"
        ).val();
        if (quantity < 1) {
            Notiflix.Notify.failure("Số lượng sản phẩm phải lớn hơn 0");
            return false;
        }

        if ($(".choose-category").length > 0 && category == null) {
            Notiflix.Notify.failure("Vui lòng chọn loại sản phẩm!");
            return false;
        }

        if ($(".list-product-size").length > 0 && size == null) {
            Notiflix.Notify.failure("Vui lòng kích cở sản phẩm!");
            return false;
        }
        console.log("hi");
        addCart(id, quantity, category, size);
        return true;
    }

    function reloadFavourite() {
        $.ajax({
            url: "/reload-favourite",
            method: "get",
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            beforeSend: function () {},
            complete: function () {},
        })
            .done(function (data) {
                $(".list-product-favourite").html("");
                var data = data["favourite"];
                var totalPrice = 0;
                $.each(data, function (i, item) {
                    $(".list-product-favourite").append(
                        '<li class="flex py-6 li-product-cart" data-id="' +
                            i +
                            '"><div class="flex-shrink-0 w-24 h-24 overflow-hidden border border-gray-200 rounded-md"><img src="' +
                            data[i].image +
                            '" alt="" class="object-cover object-center w-24 h-full"></div><div class="flex flex-col flex-1 ml-4"><div><div class="flex justify-between text-base font-medium text-gray-900"><h3><a href="' +
                            data[i].link +
                            '">' +
                            data[i].name +
                            '</a></h3></div></div><div class="flex items-end justify-between flex-1 text-sm"><div class="flex"><button type="button" class="font-medium text-indigo-600 hover:text-indigo-500 btn-delete-product-favourite" data-product-id="' +
                            data[i].id +
                            '"">Xóa</button></div></div></div></li>'
                    );
                });
                $(".count-favourite").html(Object.keys(data).length);
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {});
    }

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
                            '"><div class="flex-shrink-0 w-24 h-24 overflow-hidden border border-gray-200 rounded-md"><img src="' +
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

    function pay() {
        var coupons = $("#coupons-text").val();
        console.log(coupons);
        $.ajax({
            url: "/user/pay",
            method: "post",
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                coupons: coupons,
            },
            beforeSend: function () {
                Notiflix.Block.standard(".showcase-container");
            },
            complete: function () {
                Notiflix.Block.remove(".showcase-container");
            },
        })
            .done(function (data) {
                if (data["status"] == false) {
                    Notiflix.Notify.failure(data["content"]);
                    return;
                }
                reloadCart();
                $(".form-payment").addClass("hidden");
                $(".btn-pay-cart").addClass("hidden");
                $(".payment-susses").removeClass("hidden");
                $(".tab-one").addClass("blur-box");
                console.log(data);
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {});
    }

    function getCostShipping() {
        if ($(".text-cost-shipping").length > 0) {
            $.ajax({
                url: "/user/checkout/cost/shipping",
                method: "post",
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                data: {},
                beforeSend: function () {
                    Notiflix.Block.standard(".form-choose-shipping");
                },
                complete: function () {
                    Notiflix.Block.remove(".form-choose-shipping");
                },
            })
                .done(function (data) {
                    $(".text-cost-shipping").html(
                        data["price"]
                            .toString()
                            .replace(/\B(?=(\d{3})+(?!\d))/g, ".") + "đ"
                    );
                    $(".text-cost-shipping").attr("attr-price", data["price"]);
                    var totalPrice = parseInt(
                        $(".text-total-price-checkout").attr("attr-price")
                    );
                    totalPrice += parseInt(data["price"]);
                    $(".text-total-price-checkout").attr(
                        "attr-price",
                        totalPrice
                    );
                    $(".text-total-price-checkout").html(
                        totalPrice
                            .toString()
                            .replace(/\B(?=(\d{3})+(?!\d))/g, ".") + "đ"
                    );
                    $("#coupons-text").prop("disabled", false);
                })
                .fail(function (jqXHR, ajaxOptions, thrownError) {});
        }
    }

    function defaultShipAddress(id, status) {
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
            .done(function (data) {})
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

    function removeFavourite(id) {
        $.ajax({
            url: "/user/product/favourite",
            method: "post",
            dataType: "json",
            data: {
                id: id,
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            beforeSend: function () {},
            complete: function () {},
            error: function (data) {
                var errors = $.parseJSON(data.responseText);
                Notiflix.Notify.failure(errors["message"]);
            },
        })
            .done(function (data) {
                reloadFavourite();
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {});
    }

    function checkAddAdress(name, phone, province, city, district, address) {
        if (
            name != null &&
            phone != null &&
            province != null &&
            city != null &&
            district != null &&
            address != null
        ) {
            return true;
        }
        return false;
    }

    function addAdress(
        name,
        phone,
        province,
        city,
        district,
        address,
        postalcode,
        note
    ) {
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
                if (data["status"] == true) {
                    loadUiShippingAdress(data["data"]);
                    $(".form-add-address").trigger("reset");
                    $("#address-modal").toggleClass("hidden");
                } else {
                    Notiflix.Notify.failure("Lỗi hệ thống!");
                }
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {});
    }

    function loadUiShippingAdress(data) {
        $(".tbody-shipping-adress").html("");
        data.forEach((element) => {
            var IsUsed =
                '<div class="h-2.5 w-2.5 rounded-full bg-red-500"></div>';
            var isChecked = "";
            if (element["is_used"]) {
                var IsUsed =
                    '<div class="h-2.5 w-2.5 rounded-full bg-green-500">';
                var isChecked = "checked";
            }
            $(".tbody-shipping-adress").append(
                '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"><th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white"><div class="pl-3"><div class="text-base font-semibold">' +
                    element["name"] +
                    '</div><div class="font-normal text-gray-500">+84 ' +
                    element["phone"] +
                    "</div></div>" +
                    IsUsed +
                    '</th><td class="px-6 py-4">' +
                    element["province"] +
                    ", " +
                    element["city"] +
                    ", " +
                    element["district"] +
                    '</td><td class="px-6 py-4">' +
                    element["address"] +
                    '</td><td class="px-6 py-4"></td><td class="px-6 py-4"><label class="relative inline-flex items-center cursor-pointer"><input type="checkbox" value="" attr-id="' +
                    element["id"] +
                    '" class="sr-only peer checkbox-shipping-address" ' +
                    isChecked +
                    '><div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-pink-300 dark:peer-focus:ring-pink-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-pink-600"></div></label></td></tr>'
            );
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
            url: "/provinces/depth/1",
            method: "get",
            dataType: "json",
            headers: {
                'Access-Control-Allow-Origin': '*',
                'Content-Type':'application/json'
            },
            beforeSend: function () {},
            complete: function () {},
            success: function (data) {
                $("#province-modal-address").html("");
                data.forEach((element) => {
                    var name = element.name
                        .replace("Tỉnh ", "")
                        .replace("Thành phố ", "");
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
                if (TomSelectProvince) {
                    TomSelectProvince.clear(); // unselect previously selected elements
                    TomSelectProvince.clearOptions(); // remove existing options
                    TomSelectProvince.sync(); // synchronise with the underlying SELECT
                } else {
                    TomSelectProvince = new TomSelect(
                        "#province-modal-address",
                        {
                            create: true,
                            sortField: {
                                field: "text",
                                direction: "asc",
                            },
                        }
                    );
                }
            },
            error: function (xhr, status, error) {},
        });
    }

    function getCity(code) {
        $.ajax({
            url: "/city/depth/" + code,
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
                if (TomSelectCity) {
                    TomSelectCity.clear(); // unselect previously selected elements
                    TomSelectCity.clearOptions(); // remove existing options
                    TomSelectCity.sync(); // synchronise with the underlying SELECT
                } else {
                    TomSelectCity = new TomSelect("#city-modal-address", {
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
            url: "/district/depth/" + code,
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
                if (TomSelectDistrict) {
                    TomSelectDistrict.clear(); // unselect previously selected elements
                    TomSelectDistrict.clearOptions(); // remove existing options
                    TomSelectDistrict.sync(); // synchronise with the underlying SELECT
                } else {
                    TomSelectDistrict = new TomSelect(
                        "#district-modal-address",
                        {
                            create: true,
                            sortField: {
                                field: "text",
                                direction: "asc",
                            },
                        }
                    );
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

const button = document.querySelector('.title-coupons');
const tooltip = document.querySelector('#tooltip');

const popperInstance = Popper.createPopper(button, tooltip);

function show() {
    console.log("show");
    tooltip.setAttribute("data-show", "");

    // We need to tell Popper to update the tooltip position
    // after we show the tooltip, otherwise it will be incorrect
    popperInstance.update();
}

function hide() {
    console.log("hide");

    tooltip.removeAttribute("data-show");
}

const showEvents = ["mouseenter", "focus"];
const hideEvents = ["mouseleave", "blur"];

showEvents.forEach((event) => {
    button.addEventListener(event, show);
});

hideEvents.forEach((event) => {
    button.addEventListener(event, hide);
});
