(function () {
    'use strict'

    const originalTitle = document.title;

    Echo.private("seller."+$("body").attr('attr-data-id')).listen("NewMessageSellerEvent", (e) => {
        const audio = new Audio("/sound/livechat.mp3");
        audio.autoplay = true;
        audio.play();
        displayNotification("Bạn có tin nhắn mới");
        loadListChat();
        let messages = $('.chat-block .chat-content .messages');
        if(e.chat.senderID == messages.attr('data-user-id')){
            messages.append('<div class="message-item"><div class="message-item-content">'+e.chat.message+'</div><span class="time small text-muted font-italic">'+timeAgo(e.chat.created_at)+'</span></div>');
            messages.niceScroll();
            messages.scrollTop(messages.prop("scrollHeight"));
        }
    });


    function displayNotification(message) {
        document.title = message + " - " + originalTitle;
        setTimeout(function () {
            document.title = originalTitle;
        }, 5000);
    }

    $(document).on('click', '.btn-send-chat', function () {
        event.preventDefault();
        let messages = $('.chat-block .chat-content .messages');
        var msg  = $(".text-msg-chat").val();
        var id = messages.attr("data-user-id");
        $.ajax({
            url: "chat/send",
            method: "post",
            dataType: "json",
            data: {
                id : id,
                msg: msg
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            beforeSend: function () {

            },
            complete: function () {

            },
            error :function( data ) {
            }
        })
        .done(function (data) {
            $(".text-msg-chat").val("");
            messages.append('<div class="message-item me"><div class="message-item-content">'+msg+'</div><span class="time small text-muted font-italic"></span></span></div>');
            messages.niceScroll();
            messages.scrollTop(messages.prop("scrollHeight"));
            loadListChat();
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {});
    });

    $(document).on('click', '.chat-lists .list-group .list-group-item', function () {
        let messages = $('.chat-block .chat-content .messages');
        $('.chat-block .chat-content').removeClass('empty-chat-wrapper');
        $('.empty-chat').remove();
        $(this).parent().find('> *').removeClass('active');
        $(this).addClass('active').removeClass('unread-message');
        var userID = $(this).attr('data-user-id');
        $.ajax({
            url: "chat/list/detail",
            method: "post",
            dataType: "json",
            data: {
                userID : userID
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            beforeSend: function () {

            },
            complete: function () {

            },
            error :function( data ) {
            }
        })
        .done(function (data) {
            messages.attr('data-user-id',userID);
            messages.html("");
            $.each(data['msg'], function (i, item) {
                if(item.user_type == "user"){
                    messages.append('<div class="message-item"><div class="message-item-content">'+item.message+'</div><span class="time small text-muted font-italic">'+timeAgo(item.created_at)+'</span></div>');
                }else{
                    messages.append('<div class="message-item me"><div class="message-item-content">'+item.message+'</div><span class="time small text-muted font-italic">'+timeAgo(item.created_at)+'</span></div>');
                }
            });
            messages.niceScroll();
            messages.scrollTop(messages.prop("scrollHeight"));
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {});
        return false;
    });



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

    $(document).ready(function() {
        loadListChat();
    });

    function loadListChat() {
        $.ajax({
            url: "chat/list",
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
            }
        })
        .done(function (data) {

            $(".list-group-flush-chat").html("");
            $.each(data, function (i, item) {
                $(".list-group-flush-chat").append('<div data-user-id="'+item.user_id+'" class="list-group-item d-flex align-items-center unread-message"><div class="pe-3"><div class="avatar avatar-state-success"><img src="'+item.logo+'" class="rounded-circle" alt="image"></div></div><div><p class="mb-1">'+item.name+'</p><span class="text-muted">'+item.msg+'</span></div><div class="text-end ms-auto d-flex flex-column"><span class="small text-muted">'+item.timeago+'</span></div></div>');
            });
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {});
    }

    $('.chat-block .chat-sidebar .chat-sidebar-content').niceScroll();

    /*------------- Mobile chat sidebar -------------*/
    $(document).on('click', '.chat-block .chat-sidebar .chat-sidebar-content .list-group .list-group-item', function () {
        $('.chat-block .chat-content').addClass('chat-mobile-open');
        $('[data-close-chat]').toggleClass('show');
        return false;
    });

    /*------------- Mobile chat sidebar close btn -------------*/
    $(document).on('click', '[data-close-chat]', function () {
        $('.chat-block .chat-content').removeClass('chat-mobile-open');
        $(this).toggleClass('show');
        return false;
    });
})()
