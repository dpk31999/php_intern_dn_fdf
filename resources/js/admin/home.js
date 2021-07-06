import $ from "jquery";

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#admin-logout-form').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            method: 'POST',
            url: '/admin/logout',
            success: function (data) {
                location.reload();
            }
        });
    });

    $('#btn_login').on('click', function () {
        $('#admin-logout-form').submit();
    })
});
