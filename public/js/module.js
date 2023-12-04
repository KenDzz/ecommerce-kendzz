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



Echo.private("channel-user-order").listen("BuyProductEvent", (e) => {
    notyf.open({
        type: 'product',
        message: '<div class="toast"><div class="toast-banner"><img src="'+e.usersOrder.url_img+'" alt="'+e.usersOrder.describes+'" width="80" height="70"></div><div class="toast-detail"><p class="toast-message">Có người mới mua</p><p class="toast-title truncate ">'+e.usersOrder.describes+'</p><p class="toast-meta"><time datetime="PT2M">'+timeAgo(e.usersOrder.created_at)+'</time></p></div></div>'
      });
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
