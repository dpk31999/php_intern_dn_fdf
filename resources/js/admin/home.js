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

    $('#type_cate').on('change', function () {
        if (this.value == '0') {
            $('#chose_parent').addClass('d-none');
        } else {
            $('#chose_parent').removeClass('d-none');
        }
    });

    $('.btn-delete-cate').on('click', function () {
        var id = $(this).data('id');

        var locale = $('meta[name="locale"]').attr('content');

        var message;

        locale == 'en' ? message = 'Do you want to delete this category?' : message = 'Có phải bạn muốn xoá danh mục này?';

        if (!confirm(message)) {
            return false;
        }

        $.ajax({
            method: 'DELETE',
            url: '/admin/categories/' + id,
            success: function (data) {
                $('#category-' + id).remove();
                $('#message').html('<div class="alert alert-success" role="alert">' + data.message + '</div>');
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('#message').html('<div class="alert alert-warning" role="alert">' + thrownError + '</div>');
            },
        });
    });

    // product
    $('.btn-delete-image').on('click', function () {
        var id = $(this).data('id');

        var locale = $('meta[name="locale"]').attr('content');

        var message;

        locale == 'en' ? message = 'Do you want to delete this image?' : message = 'Có phải bạn muốn xoá hình ảnh này?';

        if (!confirm(message)) {
            return false;
        }

        $.ajax({
            method: 'DELETE',
            url: '/admin/products/' + id + '/image',
            success: function (data) {
                $('#image-' + id).remove();
                $('#message').html('<div class="alert alert-success" role="alert">' + data.message + '</div>');
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('#message').html('<div class="alert alert-warning" role="alert">' + thrownError + '</div>');
            },
        });
    });

    $('.btn-delete-product').on('click', function () {
        var id = $(this).data('id');

        var locale = $('meta[name="locale"]').attr('content');

        var message;

        locale == 'en' ? message = 'Do you want to delete this product?' : message = 'Có phải bạn muốn xoá sản phẩm này?';

        if (!confirm(message)) {
            return false;
        }

        $.ajax({
            method: 'DELETE',
            url: '/admin/products/' + id,
            success: function (data) {
                $('#image-' + id).remove();
                $('#message').html('<div class="alert alert-success" role="alert">' + data.message + '</div>');
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('#message').html('<div class="alert alert-warning" role="alert">' + thrownError + '</div>');
            },
        });
    });

});
