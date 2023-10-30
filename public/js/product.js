$(document).ready(function () {
    // Sử dụng event delegation cho các nút size-choice
    $(document).on("change","input[type=radio][name=size-choice]",
        function () {
            // Xóa lớp CSS 'active' từ tất cả các nút kích thước
            $(".choose-size label").removeClass("active");

            // Thêm lớp CSS 'active' vào nút kích thước đã chọn
            if ($(this).is(":checked")) {
                console.log("size-choice" + $(this).val());
                $(this).closest(".choose-size label").addClass("active");
            }
        }
    );

    $("input[type=radio][name=category-choice]").change(function () {
        // Xóa lớp CSS 'active' từ tất cả các nút kích thước
        $(".choose-category label").removeClass("active");

        // Thêm lớp CSS 'active' vào nút kích thước đã chọn
        if ($(this).is(":checked")) {
            console.log($(this).val());
            $(this).closest(".choose-category label").addClass("active");
            if ($(this).val() != null && $(this).val() > 0) {
                getsize($(this).val());
            }
        }
    });

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
                } else {
                }
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {});
    }
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
