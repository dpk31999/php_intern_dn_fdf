const { data } = require("jquery");

$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });

    const chart_order = new Chartisan({
        el: "#chart_order",
        url: "/api/chart/tracking_user_order",
        hooks: new ChartisanHooks()
            .colors(["#4299E1", "#67C560", "#ECC94B"])
            .datasets("bar")
            .legend({ position: "bottom" })
            .axis(true)
    });

    $("#select_order").on("change", function() {
        var select = $(this).val();

        if (select == "week") {
            chart_order.update({url: "/api/chart/tracking_user_order_in_week"})
            $('#title_order_month').addClass('d-none');
            $('#title_order_week').removeClass('d-none');
        } else {
            chart_order.update({url: "/api/chart/tracking_user_order"})
            $('#title_order_week').addClass('d-none');
            $('#title_order_month').removeClass('d-none');
        }
    });

    const chart_rate_status = new Chartisan({
        el: "#chart_rate_status",
        url: "/api/chart/rate_status_of_order",
        hooks: new ChartisanHooks()
            .colors(["#4299E1", "#67C560", "#ECC94B"])
            .datasets("pie")
            .legend({ position: "bottom" })
            .axis(false)
    });

    const chart_rate_order_by_category = new Chartisan({
        el: "#chart_rate_order_by_category",
        url: "/api/chart/order_rate_of_category",
        hooks: new ChartisanHooks()
            .datasets("pie")
            .legend({ position: "bottom" })
            .axis(false)
    });
    var date = new Date();

    const chart_statistics_revenue = new Chartisan({
        el: "#chart_statistics_revenue" ,
        url: "/api/chart/statistics_revenue?month=" + (date.getMonth() + 1) + "&year=" + date.getFullYear(),
        hooks: new ChartisanHooks()
            .datasets("bar")
            .legend({ position: "bottom" })
            .axis(true)
    });

    $('#btn_filter_revenue').on('click', function () {
        var month = $('#select_month').val();
        var year = $('#select_year').val();

        chart_statistics_revenue.update({url: "/api/chart/statistics_revenue?month=" + month + "&year=" + year})
    })
});
