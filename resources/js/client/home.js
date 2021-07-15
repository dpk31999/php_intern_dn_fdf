import $ from "jquery";

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#logout-form').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            method: 'POST',
            url: '/logout',
            success: function (data) {
                location.reload();
            }
        })
    });

    // login
    $('#loginForm').on('submit', function (e) {
        e.preventDefault();
        let formData = $(this).serializeArray();
        $(".invalid-feedback").children("strong").text("");
        $("#loginForm input").removeClass("is-invalid");
        $.ajax({
            method: "POST",
            headers: {
                Accept: "application/json"
            },
            url: '/login',
            data: formData,
            success: () => window.location.reload(),
            error: (response) => {
                $("#loginForm #passwordInput").val('');
                if (response.status === 422) {
                    let errors = response.responseJSON.errors;
                    Object.keys(errors).forEach(function (key) {
                        $("#" + key + "Input").addClass("is-invalid");
                        $("#" + key + "Error").children("strong").text(errors[key][0]);
                    });
                } else {
                    window.location.reload();
                }
            }
        })
    });

    //register
    $('#registerForm').on('submit', function (e) {
        e.preventDefault();
        let formData = $(this).serializeArray();
        $(".invalid-feedback").children("strong").text("");
        $("#registerForm input").removeClass("is-invalid");
        $.ajax({
            method: "POST",
            headers: {
                Accept: "application/json"
            },
            url: '/register',
            data: formData,
            success: () => window.location.reload(),
            error: (response) => {
                if (response.status === 422) {
                    let errors = response.responseJSON.errors;
                    Object.keys(errors).forEach(function (key) {
                        $("#" + key + "Input").addClass("is-invalid");
                        $("#" + key + "Error").children("strong").text(errors[key][0]);
                    });
                } else {
                    window.location.reload();
                }
            }
        })
    });

    //forgot password
    $('#forgotPassForm').on('submit', function (e) {
        e.preventDefault();
        let formData = $(this).serializeArray();
        $(".invalid-feedback").children("strong").text("");
        $("#forgotPassForm input").removeClass("is-invalid");
        $.ajax({
            method: "POST",
            headers: {
                Accept: "application/json"
            },
            url: '/password/email',
            data: formData,
            success: function (data) {
                $('#message').children("strong").text(data.message)
            },
            error: (response) => {
                if (response.status === 422) {
                    let errors = response.responseJSON.errors;
                    Object.keys(errors).forEach(function (key) {
                        $("#" + key + "InputForgot").addClass("is-invalid");
                        $("#" + key + "ErrorForgot").children("strong").text(errors[key][0]);
                    });
                } else {
                    window.location.reload();
                }
            }
        })
    });

    // In menu
    $('.btn-show-product').on('click', function () {
        var id = $(this).data('cate-id');

        var locale = $('meta[name="locale"]').attr('content');

        var message;

        locale == 'en' ? message = 'Avarage rate of product' : message = 'Đánh giá trung bình';

        $.ajax({
            method: 'GET',
            url: '/menu/get-product-by-cate-id/' + id,
            success: function (data) {
                var html = '';
                Object.keys(data).forEach(key => {
                    html += '<div class="col-md-4 special-grid drinks">' +
                            '<div class="gallery-single fix">' +
                                '<img src="/storage/'+ data[key].image +'" alt="Image" width="254" height="152">' +
                                '<div class="why-text">' +
                                    '<h4>'+ data[key].name +'</h4>' +
                                    '<p>'+ message + ': ' + data[key].avg_rating + '* (' + data[key].ratings.length + ')' + '</p>' +
                                    '<div class="d-flex justify-content-around">' +
                                    '<h5>'+ data[key].price +' vnd</h5>' +
                                    '<i class="fas fa-shopping-cart cursor"></i></a>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                        '</div>';
                });
                $('#list_products').html(html);
            }
        });
    });
});
