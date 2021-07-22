@extends('layouts.app')

@section('content')
    <!-- Start Menu -->
    <div class="menu-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="heading-title text-center">
                        <h2>@lang('homepage.detail-order')</h2>
                    </div>
                </div>
            </div>

            <div class="row inner-menu-box">
                <div class="col-md-12 card">
                    <div class="card-header">
                        @lang('homepage.order-status')
                    </div>
                    <div class="card-body">
                        <div class="cart-list">
                            <table class="table">
                                <tbody class="show-cart">
                                    <tr>
                                        <td class="shoping__cart__item">
                                            <h5 class="text-center"><strong>@lang('homepage.order-date')</strong></h5>
                                        </td>
                                        <td class="shoping__cart__price">
                                            <h5 class="text-center">{{ $order->created_at }}</h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="shoping__cart__item">
                                            <h5 class="text-center"><strong>@lang('homepage.order-status')</strong</h5>
                                        </td>
                                        <td class="shoping__cart__price">
                                            <h5 class="text-center">{{ $order->status }}</h5>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row inner-menu-box mt-5">
                <div class="col-md-12 card">
                    <div class="card-header">
                        @lang('homepage.detail-order')
                    </div>
                    <div class="card-body">
                        <div class="cart-list">
                            <table class="table">
                                <thead class="thead-primary">
                                <tr class="text-center">
                                    <th>@lang('homepage.product-id')</th>
                                    <th>@lang('products.name-product')</th>
                                    <th>@lang('products.price')</th>
                                    <th>@lang('checkout.quantity')</th>
                                    <th>@lang('checkout.total')</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody class="show-cart">
                                    @foreach ($order->orderDetails as $product)
                                        <tr>
                                            <td class="shoping__cart__item">
                                                <a href="{{ route('products.show', $product->id) }}"><h5 class="text-center">#{{ $product->id }}</h5></a>
                                            </td>
                                            <td class="shoping__cart__item">
                                                <a href="{{ route('products.show', $product->id) }}"><h5 class="text-center">{{ $product->name }}</h5></a>
                                            </td>
                                            <td class="shoping__cart__price">
                                                <h5 class="text-center">{{ $product->price }}</h5>
                                            </td>
                                            <td class="shoping__cart__price">
                                                <h5 class="text-center">{{ $product->pivot->quantity }}</h5>
                                            </td>
                                            <td class="shoping__cart__price">
                                                <h5 class="text-center">{{ $product->pivot->quantity * $product->price }}</h5>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td class="shoping__cart__price">
                                        </td>
                                        <td class="shoping__cart__price">
                                        </td>
                                        <td class="shoping__cart__price">
                                        </td>
                                        <td class="shoping__cart__price">
                                            <h5 class="text-center">@lang('checkout.total')</h5>
                                        </td>
                                        <td class="shoping__cart__price">
                                            <h5 class="text-center">{{ $order->total_price }}</h5>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
