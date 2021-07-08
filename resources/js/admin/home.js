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

    $('.btn-delete').on('click', function () {
        var id = $(this).data('id');

        var locale = $('meta[name="locale"]').attr('content');

        var message;

        locale == 'en' ? message = 'Do you want to delete this account?' : message = 'Có phải bạn muốn xoá tài khoản này?';

        if (!confirm(message)) {
            return false;
        }

        $.ajax({
            method: 'DELETE',
            url: '/admin/users/' + id,
            success: function (data) {
                $('#user-' + id).remove();
                $('#message').html('<div class="alert alert-success" role="alert">' + data.message + '</div>');
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('#message').html('<div class="alert alert-warning" role="alert">' + thrownError + '</div>');
            },
        });
    });
});
