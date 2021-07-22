$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });

    Pusher.logToConsole = true;

    var pusher = new Pusher("112f7a87d951cfe22faa", {
        cluster: "ap1"
    });

    var channel = pusher.subscribe("SendNotiForAdminWhenUserOrder");
    channel.bind("send-noti-user-order-admin", function (data) {
        $('#order_id_toast').text(data.order.id);
        $('#status_toast').text(data.order.status);
        $('#message_order_toast').text(data.message_to_admin);
        $('#toast_order_user').attr('data-id', data.order.id);
        $("#toast_order_user").toast("show");
        $('#nav_count_noti').text(parseInt($('#nav_count_noti').text()) + 1);
        $('#toast_order_user').css('z-index', '1');
    });

    $('#toast_order_user').on('click', function () {
        window.location = '/admin/orders/' + $(this).data('id');
    });

    $('#toast_order_user').on('hidden.bs.toast', function () {
        $('#toast_order_user').css('z-index', '-1');
    })

    // notification order have not been confirm.
    var channel = pusher.subscribe("SendNotifyOrderIsPendingForAdminEvent");
    channel.bind("send-notification-order-pending", function (data) {
        $('#message_order_pending').text(data.message);
        $("#toast_order_pending").toast("show");
        $('#toast_order_pending').css('z-index', '1');
        $('#toast_order_pending').css('cursor', 'pointer');
    });

    $('#toast_order_pending').on('click', function () {
        window.location = '/admin/orders';
    });

    $('#toast_order_pending').on('hidden.bs.toast', function () {
        $('#toast_order_pending').css('z-index', '-1');
    })
});
