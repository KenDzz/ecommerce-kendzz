const notyf = new Notyf({
    duration: 1000,
    position: {
        x: "left",
        y: "bottom",
    },
    types: [
        {
            type: "product",
            background: "white",
            duration: 3000,
            dismissible: false,
            icon: false
        },
    ],
});

const originalTitle = document.title;


Echo.private("channel-user-order").listen("BuyProductEvent", (e) => {
    notyf.open({
        type: 'product',
        message: '<div class="toast"><div class="toast-banner"><img src="'+e.usersOrder.url_img+'" alt="'+e.usersOrder.describes+'" width="80" height="70"></div><div class="toast-detail"><p class="toast-message">Có người mới mua</p><p class="toast-title truncate ">'+e.usersOrder.describes+'</p><p class="toast-meta"><time datetime="PT2M">'+timeAgo(e.usersOrder.created_at)+'</time></p></div></div>'
      });
});

Echo.private("user."+$("body").attr('attr-data-id')).listen("NewMessageUserEvent", (e) => {
    console.log(e);
    var audio = new Audio("/sound/livechat.mp3");
    audio.play();
    displayNotification("Bạn có tin nhắn mới");
    if($('.full-chat-ul').attr('data-seller-id') == e.chat.senderID){
        $('.full-chat-ul').append('<li class="flex justify-start"><div class="relative max-w-xl px-4 py-2 text-gray-700 rounded shadow"><span class="block">'+e.chat.message+'</span></div></li>');
        scrollToBottom();
    }
    getListUserNoLoading();
});

$(".btn-sender-chat").click(function () {
    event.preventDefault();
    var sellerID = $(this).attr("data-seller-id");
    var productID = $(".product-content").attr("productId");
    $.ajax({
        url: "/user/chat/default",
        method: "post",
        dataType: "json",
        data: {
            productID: productID,
            sendID: sellerID,
        },
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        beforeSend: function () {},
        complete: function () {},
        error :function( data ) {
            var errors = $.parseJSON(data.responseText);
            Notiflix.Notify.failure(errors['message']);
        }
    })
    .done(function (data) {
        if(data.status == true){
            $('#open-chat').click();
            $('.cell-user-info[seller-id="'+sellerID+'"]').delay(1000).click();
        }
    })
    .fail(function (jqXHR, ajaxOptions, thrownError) {});
});


$("#open-chat").click(function () {
    $("#form-chat").toggleClass("hidden-important");
    getListUser();
});

$("#btn-hidden-chat").click(function () {
    $("#form-chat").toggleClass("hidden-important");
});

$(".btn-send-chat").click(function () {
    $.ajax({
        url: "/user/send/chat",
        method: "post",
        dataType: "json",
        data: {
            msg : $('.message-chat').val(),
            id: $('.full-chat-ul').attr('data-seller-id')
        },
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        beforeSend: function () {
        },
        complete: function () {
        },
        error :function( data ) {
            var errors = $.parseJSON(data.responseText);
            Notiflix.Notify.failure(errors['message']);
        }
    })
    .done(function (data) {
        if(data.status == true){
            $('.full-chat-ul').append('<li class="flex justify-end"><div class="relative max-w-xl px-4 py-2 text-gray-700 bg-gray-100 rounded shadow"><span class="block">'+$('.message-chat').val()+'</span></div></li>');
            $('.message-chat').val('');
            scrollToBottom();
            getListUserNoLoading();
        }
    })
    .fail(function (jqXHR, ajaxOptions, thrownError) {});
});

$(document).on("click", ".cell-user-info", function () {
    $('.full-chat-ul').attr('data-seller-id',$(this).attr('seller-id'));
    $.ajax({
        url: "/user/chat/detail",
        method: "post",
        dataType: "json",
        data: {
            sellerID: $(this).attr('seller-id')
        },
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        beforeSend: function () {
            Notiflix.Block.standard(".overflow-full-chat");

        },
        complete: function () {
            Notiflix.Block.remove(".overflow-full-chat");

        },
        error :function( data ) {
            var errors = $.parseJSON(data.responseText);
            Notiflix.Notify.failure(errors['message']);

        }
    })
        .done(function (data) {
            $('.full-chat-ul').html("");
            $('.avatar-chat-detail').attr("src",data['logo']);
            $('.name-chat-detail').text(data['name']);
            $.each(data['msg'], function (i, item) {
                if(item.user_type == "seller"){
                    $('.full-chat-ul').append('<li class="flex justify-start"><div class="relative max-w-xl px-4 py-2 text-gray-700 rounded shadow"><span class="block">'+item.message+'</span></div></li>');
                }else{
                    $('.full-chat-ul').append('<li class="flex justify-end"><div class="relative max-w-xl px-4 py-2 text-gray-700 bg-gray-100 rounded shadow"><span class="block">'+item.message+'</span></div></li>');
                }
            });
            scrollToBottom();
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {});
});

function getListUser() {
    $.ajax({
        url: "/user/chat/list",
        method: "get",
        dataType: "json",
        data: {},
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        beforeSend: function () {
            Notiflix.Block.standard(".overflow-list-user-chat");

        },
        complete: function () {
            Notiflix.Block.remove(".overflow-list-user-chat");

        },
        error :function( data ) {
            var errors = $.parseJSON(data.responseText);
            Notiflix.Notify.failure(errors['message']);
        }
    })
    .done(function (data) {
        $(".list-user-chat").html("");
        $.each(data, function (i, item) {
            $(".list-user-chat").append('<a seller-id="'+data[i].seller_id+'" class="cell-user-info flex items-center px-3 py-2 text-sm transition duration-150 ease-in-out border-b border-gray-300 cursor-pointer hover:bg-gray-100 focus:outline-none"><img class="object-cover w-10 h-10 rounded-full" src="'+data[i].logo+'" alt="username"><div class="w-full pb-2"><div class="flex justify-between"><span class="block ml-2 font-semibold text-gray-600">'+data[i].name+'</span><span class="block ml-2 text-sm text-gray-600">'+data[i].timeago+'</span></div><span class="block ml-2 text-sm text-gray-600">'+data[i].msg+'</span></div></a>');
        });
    })
    .fail(function (jqXHR, ajaxOptions, thrownError) {});
}

function getListUserNoLoading() {
    $.ajax({
        url: "/user/chat/list",
        method: "get",
        dataType: "json",
        data: {},
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        beforeSend: function () {
        },
        complete: function () {
        },
        error :function( data ) {
            var errors = $.parseJSON(data.responseText);
            Notiflix.Notify.failure(errors['message']);
        }
    })
    .done(function (data) {
        $(".list-user-chat").html("");
        $.each(data, function (i, item) {
            $(".list-user-chat").append('<a seller-id="'+data[i].seller_id+'" class="cell-user-info flex items-center px-3 py-2 text-sm transition duration-150 ease-in-out border-b border-gray-300 cursor-pointer hover:bg-gray-100 focus:outline-none"><img class="object-cover w-10 h-10 rounded-full" src="'+data[i].logo+'" alt="username"><div class="w-full pb-2"><div class="flex justify-between"><span class="block ml-2 font-semibold text-gray-600">'+data[i].name+'</span><span class="block ml-2 text-sm text-gray-600">'+data[i].timeago+'</span></div><span class="block ml-2 text-sm text-gray-600">'+data[i].msg+'</span></div></a>');
        });
    })
    .fail(function (jqXHR, ajaxOptions, thrownError) {});
}

function scrollToBottom() {
    var chatContainer = $('.overflow-full-chat');
    chatContainer.scrollTop(chatContainer.prop('scrollHeight'));
}


function displayNotification(message) {
    document.title = message + " - " + originalTitle;
    setTimeout(function () {
        document.title = originalTitle;
    }, 5000);
}

function timeAgo(dateString) {
    const currentDate = new Date();
    const pastDate = new Date(dateString);

    const timeDifference = currentDate - pastDate;
    const seconds = Math.floor(timeDifference / 1000);
    const minutes = Math.floor(seconds / 60);
    const hours = Math.floor(minutes / 60);
    const days = Math.floor(hours / 24);

    if (days > 0) {
        return `${days} ngày trước`;
    } else if (hours > 0) {
        return `${hours} giờ trước`;
    } else if (minutes > 0) {
        return `${minutes} phút trước`;
    } else {
        return `${seconds} giây trước`;
    }
}
