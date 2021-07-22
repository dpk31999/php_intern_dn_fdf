@extends('layouts.app')

@section('content')
    <!-- Start All Pages -->
    <div class="all-page-title page-breadcrumb">
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-12">
                    <h1>@lang('homepage.checkout')</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container main-1">
        <div class="row">
            <div class="col-xl-8 ftco-animate bg-dark">
                <form id="form_check_out" class="billing-form ftco-bg-dark p-3 p-md-5">
                    @csrf
                    <h3 class="mb-4 billing-heading text-light">@lang('checkout.bill-detail')</h3>
                    <div class="row align-items-end">
                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">@lang('users.fullname')</label>
                                <input id="nameInputCheckout" name="name" type="text" value="{{ $user->name }}" class="form-control" placeholder="@lang('users.fullname')">
                                <span class="invalid-feedback" role="alert" id="nameErrorCheckout">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">@lang('users.phone-number')</label>
                                <input id="phoneInputCheckout" name="phone" value="{{ $user->phone == '' ? '' : $user->phone }}" type="text" class="form-control" placeholder="@lang('users.phone-number')">
                                <span class="invalid-feedback" role="alert" id="phoneErrorCheckout">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">@lang('homepage.email-address')</label>
                                <input id="emailInputCheckout" name="email" type="text" value="{{ $user->email }}" class="form-control" placeholder="@lang('homepage.email-address')">
                                <span class="invalid-feedback" role="alert" id="emailErrorCheckout">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="country">@lang('users.city')</label>
                                <div class="select-wrap">
                                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                    <select id="cityInputCheckout" name="city" class="form-control">
                                        <option class="text-dark" value="">@lang('checkout.not-chose')</option>
                                        @foreach ($data as $key => $value)
                                            <option class="text-dark" value="{{ $value }}"
                                                {{ $value == $user->city ? 'selected' : '' }}>{{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="invalid-feedback" role="alert" id="cityErrorCheckout">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="streetaddress">@lang('users.address')</label>
                                <input id="addressInputCheckout" name="address" type="text" value="{{ $user->address == '' ? '' : $user->address }}" class="form-control" placeholder="@lang('users.address')">
                                <span class="invalid-feedback" role="alert" id="addressErrorCheckout">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>
                        <div class="w-100"></div>
                    </div>
                    <div class="row mt-5 pt-3 d-flex">
                        <div class="col-md-6 d-flex">
                            <div class="cart-detail cart-total ftco-bg-dark p-3 p-md-4">
                                <h3 class="billing-heading mb-4 text-light">@lang('checkout.cart-total')</h3>
                                <p class="d-flex justify-content-between">
                                    <span class="text-light">@lang('checkout.sub-total') </span>
                                    <span class="text-light">{{ $cart->totalPrice }}</span>
                                </p>
                                <p class="d-flex justify-content-between">
                                    <span class="text-light">@lang('checkout.delivery') </span>
                                    <span class="text-light">$0.00</span>
                                </p>
                                <p class="d-flex justify-content-between">
                                    <span class="text-light">@lang('checkout.discount') </span>
                                    <span class="text-light">$0.00</span>
                                </p>
                                <hr>
                                <p class="d-flex justify-content-between total-price">
                                    <span class="text-light">@lang('checkout.total')</span>
                                    <span class="text-light">{{ $cart->totalPrice }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="cart-detail ftco-bg-dark p-3 p-md-4">
                                <h3 class="billing-heading mb-4 text-light">@lang('checkout.payment-method')</h3>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="radio">
                                            <label><input type="radio" name="optradio" class="mr-2">COD</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="radio">
                                            <label><input type="radio" name="optradio" class="mr-2">VNPay</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="radio">
                                            <label><input type="radio" name="optradio" class="mr-2">Momo</label>
                                        </div>
                                    </div>
                                </div>
                                <button id="check_out" type="submit"
                                    class="btn btn-primary py-3 px-4 text-decoration-none text-dark"
                                    style="cursor: pointer">@lang('checkout.order')</button>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="alert alert-primary alert-checkout d-none" role="alert">
                                <strong></strong>
                            </div>
                        </div>
                    </div>
                </form><!-- END -->
            </div> <!-- .col-md-8 -->




            <div class="col-md-4 sidebar ftco-animate">
                <div class="sidebar-box ftco-animate">
                    <div class="categories">
                        <h3>Categories</h3>
                        {{-- @foreach ($categories as $cate)
                            <li><a href="{{ route('cate', $cate->id) }}">{{ $cate->name }}
                                    <span>({{ $cate->products->count() }})</span></a></li>
                        @endforeach --}}
                    </div>
                </div>

                <div class="sidebar-box ftco-animate">
                    <h3>Recent Blog</h3>
                    {{-- @foreach ($posts as $post)
                        <div class="block-21 mb-4 d-flex">
                            <a class="blog-img mr-4" href="{{ route('blog.single', $post->slug) }}"
                                style="background-image: url(/storage/{{ $post->url_thumb }});"></a>
                            <div class="text">
                                <h3 class="heading"><a href="{{ route('blog.single', $post->slug) }}">{{ $post->title }}</a>
                                </h3>
                                <div class="meta">
                                    <div><a class="text-decoration-none"><span class="icon-calendar"></span>
                                            {{ $post->created_at }}</a></div>
                                    <div><a class="text-decoration-none"><span class="icon-person"></span>
                                            {{ $post->admin->username }}</a></div>
                                    <div><a class="text-decoration-none"><span class="icon-chat"></span>
                                            {{ $post->comments->count() }}</a></div>
                                </div>
                            </div>
                        </div>
                    @endforeach --}}
                </div>

                <div class="sidebar-box ftco-animate">
                    <h3>Tag Cloud</h3>
                    <div class="tagcloud">
                        {{-- @foreach ($bestSeller as $product)
                            <a href="{{ route('product.show', $product->id) }}"
                                class="tag-cloud-link">{{ $product->name }}</a>
                        @endforeach
                        @foreach ($categories as $category)
                            <a href="{{ route('cate', $category->id) }}" class="tag-cloud-link">{{ $category->name }}</a>
                        @endforeach --}}
                    </div>
                </div>

                <div class="sidebar-box ftco-animate">
                    <h3>Paragraph</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus itaque, autem necessitatibus
                        voluptate quod mollitia delectus aut, sunt placeat nam vero culpa sapiente consectetur similique,
                        inventore eos fugit cupiditate numquam!</p>
                </div>
            </div>
        </div>
    </div>
@endsection
