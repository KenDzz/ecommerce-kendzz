$(document).ready(function () {
    $.ajax({
        url: "product/sale",
        method: "get",
        dataType: "json",
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
            $.each(data, function (i, item) {
                countDownTimer(item);
            });
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {});

    $(".owl-carousel").owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 1,
            },
            1000: {
                items: 1,
            },
        },
    });

    function countDownTimer(item) {
        var time = item.date + ' ' + item.h + ':' + item.m + ':' + item.s;
        var countDownDate = new Date(time).getTime();
        var x = setInterval(function () {
            var now = new Date().getTime();
            var distance = countDownDate - now;
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor(
                (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
            );
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            $(".display-number-day-"+item.product_id).html(days);
            $(".display-number-hour-"+item.product_id).html(hours);
            $(".display-number-min-"+item.product_id).html(minutes);
            $(".display-number-sec-"+item.product_id).html(seconds);
            if (distance < 0) {
                clearInterval(x);
                console.log("EXPIRED");
            }
        }, 1000);
    }
});

