@extends('layouts.app')

@section('content')
    <!-- Start All Pages -->
    <div class="all-page-title page-breadcrumb">
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-12">
                    <h1>@lang('homepage.special-menu')</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Pages -->

    <!-- Start Menu -->
    <div class="menu-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="heading-title text-center">
                        <h2>@lang('homepage.special-menu')</h2>
                        <p>@lang('homepage.menu-discription')</p>
                    </div>
                </div>
            </div>

            <div class="row inner-menu-box">
                <div class="col-3">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-parent-home"
                            role="tab" aria-controls="v-pills-home" aria-selected="true">@lang('homepage.all')</a>
                        @foreach ($categories as $cate)
                            <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill"
                                href="#v-pills-parent-{{ $cate->id }}" role="tab"
                                aria-controls="v-pills-parent-{{ $cate->id }}"
                                aria-selected="false">{{ $cate->name }}</a>
                        @endforeach
                    </div>
                </div>

                <div class="col-9">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-parent-home" role="tabpanel"
                            aria-labelledby="v-pills-home-tab">
                            <div class="row justify-content-around">
                                @foreach ($categories as $category)
                                    @foreach ($category->childCategories as $cate)
                                        <button data-cate-id="{{ $cate->id }}" class="col-md-3 btn-show-product btn btn-success">{{ $cate->name }}</button>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                        @foreach ($categories as $category)
                            <div class="tab-pane fade" id="v-pills-parent-{{ $category->id }}" role="tabpanel"
                                aria-labelledby="v-pills-parent-{{ $category->id }}-tab">
                                <div class="row justify-content-around">
                                    @foreach ($category->childCategories as $cate)
                                        <button data-cate-id="{{ $cate->id }}" class="col-md-3 btn-show-product btn btn-success">{{ $cate->name }}</button>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="row inner-menu-box justify-content-center mt-5">
                <div class="col-9">
                    <div class="row justify-content-around" id="list_products">

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
