$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });

    const chart_month_order = new Chartisan({
        el: "#chart_month_order",
        url: "/api/chart/tracking_user_order",
        hooks: new ChartisanHooks()
            .colors(["#4299E1", "#67C560", "#ECC94B"])
            .datasets("bar")
            .legend({ position: "bottom" })
            .axis(true)
    });
    const chart_week_order = new Chartisan({
        el: "#chart_week_order",
        url: "/api/chart/tracking_user_order_in_week",
        hooks: new ChartisanHooks()
            .colors(["#4299E1", "#67C560", "#ECC94B"])
            .datasets("bar")
            .legend({ position: "bottom" })
            .axis(true)
    });

    $("#select_order").on("change", function() {
        var select = $(this).val();

        if (select == "week") {
            $("#chart_month_order").addClass("d-none");
            $("#title_order_month").addClass("d-none");
            $("#title_order_week").removeClass("d-none");
            $("#chart_week_order").removeClass("d-none");
        } else {
            $("#chart_week_order").addClass("d-none");
            $("#title_order_week").addClass("d-none");
            $("#title_order_month").removeClass("d-none");
            $("#chart_month_order").removeClass("d-none");
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
});
