@extends('admin.layouts.app')

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-md-7">
            <h3 id="title_order_month">@lang('homepage.chart_month_order')</h3>
            <h3 id="title_order_week" class="d-none">@lang('homepage.chart_week_order')</h3>
        </div>
        <div class="col-md-3">
            <select id="select_order" class="custom-select">
                <option value="month" selected>@lang('homepage.view_in_month')</option>
                <option value="week">@lang('homepage.view_in_week')</option>
            </select>
        </div>
    </div>
    <!-- Chart's container -->
    <div id="chart_order" style="height: 400px;"></div>
    <div class="row d-flex justify-content-center">
        <div class="col-md-7">
            <h3 id="title_order_month">@lang('homepage.chart_statistic_revenue')</h3>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="d-flex">
                <select id="select_month" class="custom-select">
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ $i == date('m') ? 'selected' : '' }}>@lang('homepage.month') {{ $i }}</option>
                    @endfor
                </select>
                <select id="select_year" class="custom-select">
                    @for ($i = date('Y') - 3; $i <= date('Y'); $i++)
                        <option value="{{ $i }}" {{ $i == date('Y') ? 'selected' : '' }}>@lang('homepage.year') {{ $i }}</option>
                    @endfor
                </select>
                <button id="btn_filter_revenue" class="btn btn-primary">@lang('homepage.filter')</button>
            </div>
        </div>
        <div class="col-md-5"></div>
    </div>
    <!-- Chart's container -->
    <div id="chart_statistics_revenue" style="height: 400px;"></div>
    <div class="row d-flex justify-content-center mt-3">
        <div class="col-md-5">
            <h3 id="title_order_month">@lang('homepage.chart_rate_status')</h3>
            <div id="chart_rate_status"style="height: 300px;"></div>
        </div>
        <div class="col-md-5">
            <h3 id="title_order_month">@lang('homepage.chart_rate_order_bought')</h3>
            <div id="chart_rate_order_by_category"style="height: 300px;"></div>
        </div>
    </div>
@endsection
