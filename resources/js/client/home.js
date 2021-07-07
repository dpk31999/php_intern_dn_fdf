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
                                    '<a href="/products/'+ data[key].id +'"><i class="fas fa-eye cursor"></i></a>' +
                                    '<a href="#"><i class="fas fa-shopping-cart cursor"></i></a>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                        '</div>';
                });
                $('#list_products').html(html);
            }
        });
    });

    // rating
    $('#form_add_rating').on('submit', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        let formData = $(this).serializeArray();
        $(".invalid-feedback").children("strong").text("");
        $("#form_add_rating input").removeClass("is-invalid");
        $.ajax({
            method: "POST",
            headers: {
                Accept: "application/json"
            },
            url: '/products/'+ id +'/rating',
            data: formData,
            success: function (data) {
                $("#form_add_rating textarea").val('');
                var star = '';
                for (var i = 1; i <= 5; i++) {
                    if (i <= data.pivot.num_rated) {
                        star += '<button type="button" class="btn btn-warning btn-xs mr-1" aria-label="Left Align">' +
                            '<i class="fas fa-star"></i>' +
                        '</button>';
                    } else {
                        star += '<button type="button" class="btn btn-warning btn-grey btn-xs mr-1" aria-label="Left Align">' +
                            '<i class="fas fa-star"></i>' +
                        '</button>';
                    }
                }

                var formattedDate = new Date(data.pivot.created_at);
                var d = formattedDate.getDate();
                var m =  formattedDate.getMonth();
                m += 1;
                var y = formattedDate.getFullYear();
                var result = d + "-" + m + "-" + y;

                var html = '<div class="review-block">' +
                        '<div class="row">' +
                        '<div class="col-sm-3">' +
                        '<img src="http://dummyimage.com/60x60/666/ffffff&text=No+Image" class="img-rounded">' +
                        '<div class="review-block-name">'+ data.name +'</div>' +
                        '<div class="review-block-date">'+ result +'<br />Just now</div>' +
                        '</div>' +
                        '<div class="col-sm-9">' +
                        '<div class="review-block-rate">' +
                        star +
                        '</div>' +
                        '<div class="review-block-title">'+ data.pivot.content +'</div>' +
                        '</div>' +
                        '</div>' +
                        '<hr />' +
                        '</div>';
                var avg_rate = parseInt($('#avg_rate').text());
                var count_rate = parseInt($('#count_rate').text());

                var last_avg = (avg_rate * count_rate + data.pivot.num_rated) / (count_rate + 1);

                $('#avg_rate').text(last_avg.toFixed(1));
                $('#count_rate').text(count_rate + 1);
                $('#list_ratings').prepend(html);
            },
            error: (response) => {
                $("#form_add_rating textarea").val('');
                if (response.status === 422) {
                    let errors = response.responseJSON.errors;
                    console.log(errors);
                    Object.keys(errors).forEach(function (key) {
                        $("#" + key + "InputRating").addClass("is-invalid");
                        $("#" + key + "ErrorRating").children("strong").text(errors[key][0]);
                    });
                } else if (response.status === 401) {
                    $('#modalLogin').modal('show');
                }
            }
        })
    })
});
