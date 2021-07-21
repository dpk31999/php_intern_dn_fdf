@extends('layouts.app')

@section('content')
    <!-- Start Menu -->
    <div class="menu-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="heading-title text-center">
                        <h2>@lang('homepage.total_order_in_website')</h2>
                    </div>
                </div>
            </div>

            <div class="row inner-menu-box">
                <div class="col-3">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active order-bar cursor" data-type="Total" data-toggle="pill" role="tab" aria-selected="false">@lang('homepage.all')</a>
                        <a class="nav-link order-bar cursor" data-type="Done" data-toggle="pill" role="tab" aria-selected="false">
                            @lang('homepage.order_done')
                        </a>
                        <a class="nav-link order-bar cursor" data-type="Pending" data-toggle="pill" role="tab" aria-selected="false">
                            @lang('homepage.order_pending')
                        </a>
                        <a class="nav-link order-bar cursor" data-type="Cancel" data-toggle="pill" role="tab" aria-selected="false">
                            @lang('homepage.order_cancel')
                        </a>
                    </div>
                </div>

                <div class="col-9">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active">
                            <table class="table table-image">
                                <thead>
                                    <tr>
                                        <th scope="col">@lang('homepage.order_id')</th>
                                        <th scope="col">@lang('homepage.order_date')</th>
                                        <th scope="col">@lang('products.price')</th>
                                        <th scope="col">@lang('homepage.order_status')</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody id="list_order">
                                    @foreach ($orders as $order)
                                        <tr id="order-{{ $order->id }}">
                                            <td><a href="{{ route('order.show', $order->id) }}">#{{ $order->id }}</a></td>
                                            <td>{{ $order->created_at }}</td>
                                            <td>{{ $order->total_price }}</td>
                                            <td>{{ $order->status }}</td>
                                            @if ($order->status == config('app.status_order.pending'))
                                                <td>
                                                    <a class="btn btn-danger cursor btn-cancel-order" data-order-id="{{ $order->id }}">
                                                        @lang('homepage.cancel_order')
                                                    </a>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Menu -->

    <!-- Start QT -->
    <div class="qt-box qt-background">
        <div class="container">
            <div class="row">
                <div class="col-md-8 ml-auto mr-auto text-center">
                    <p class="lead ">
                        " @lang('homepage.slogan') "
                    </p>
                    <span class="lead">Michael Strahan</span>
                </div>
            </div>
        </div>
    </div>
    <!-- End QT -->
@endsection
