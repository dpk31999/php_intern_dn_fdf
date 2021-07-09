@extends('layouts.app')

@section('content')
    <!-- Start All Pages -->
    <div class="all-page-title page-breadcrumb">
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-12">
                    <h1>@lang('homepage.suggest-title')</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5 main-1">
        <div class="row block-9">
            <div class="col-md-4 contact-info ftco-animate">
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <h2 class="h4">@lang('homepage.contact-info')</h2>
                    </div>
                    <div class="col-md-12 mb-3">
                        <p><span>@lang('users.address')</span> Sun* Inc</sp>
                    </div>
                    <div class="col-md-12 mb-3">
                        <p><span>@lang('users.phone-number')</span> <a href="tel://0826792146">+ 0826792146</a></p>
                    </div>
                    <div class="col-md-12 mb-3">
                        <p><span>@lang('homepage.email-address')</span> <a href="mailto:hvd.03.12.99@gmail.com">hvd.03.12.99@gmail.com</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-6 ftco-animate">
                <form method="POST" id="form_suggest" class="contact-form">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input name="name" id="nameInputSuggest" type="text" value="{{ $user->name }}" class="form-control" placeholder="@lang('users.fullname')">
                            </div>
                            <span class="invalid-feedback" role="alert" id="nameErrorSuggest">
                                <strong></strong>
                            </span>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input name="email" id="emailInputSuggest" value="{{ $user->email }}" type="text" class="form-control" placeholder="@lang('homepage.email-address')">
                            </div>
                            <span class="invalid-feedback" role="alert" id="emailErrorSuggest">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="cate">@lang('categories.parent') </label>
                            <select id="cateInputSuggest" class="form-control">
                                <option value="">@lang('categories.chose-parent')</option>
                                @forelse ($categories as $cate)
                                    <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                                @empty
                                    <option disabled selected>@lang('products.there-no-parent')</option>
                                @endforelse
                            </select>
                        </div>
                        <span class="invalid-feedback" role="alert" id="cateErrorSuggest">
                            <strong></strong>
                        </span>
                    </div>
                    <div id="cate-hidden" class="form-group d-none">
                        <div class="form-group">
                            <label for="cate">@lang('homepage.child-cate') </label>
                            <select name="cate" id="cate_child" class="form-control">
                                <option value="">@lang('homepage.chose-child-cate')</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <input id="productInputSuggest" name="product" type="text" class="form-control" placeholder="@lang('products.name-product')">
                        </div>
                        <span class="invalid-feedback" role="alert" id="productErrorSuggest">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="alert alert-primary alert-suggest d-none" role="alert">
                        <strong></strong>
                    </div>
                    <div class="form-group">
                        <button type="submit" id="submit" class="btn btn-primary py-3 px-5">@lang('homepage.send-suggest')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
