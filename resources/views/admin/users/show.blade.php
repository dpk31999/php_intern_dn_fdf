@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row ">
            <div class="col-sm-6 btn-center mt-30">
                <a href="{{ route('admin.users.index') }}" class="btn btn-primary ">
                    <i class="fas fa-backward"></i>
                    @lang('users.back')
                </a>
            </div>
        </div>
    </div>
    <div class="main-body">
        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="" alt="Admin" class="rounded-circle img-fluid">
                            <div class="mt-3">
                                <h4>{{ $user->name }}</h4>
                                <p class="text-secondary mb-1">{{ $user->city }}</p>
                                <p class="text-muted font-size-sm">{{ $user->address }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">@lang('users.email')</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $user->email }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">@lang('users.phone-number')</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $user->phone }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">@lang('users.address')</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $user->address }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">@lang('users.create-at')</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $user->created_at }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-6">
                                <h6 class="mb-0">@lang('users.num-order')</h6>
                            </div>
                            <div class="col-sm-6 text-secondary">
                                <strong>{{ $user->orders->count() }}</strong>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-6">
                                <h6 class="mb-0">@lang('users.num-suggest')</h6>
                            </div>
                            <div class="col-sm-6 text-secondary">
                                <strong>{{ $user->suggestProducts->count() }}</strong>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-6">
                                <h6 class="mb-0">@lang('users.num-favorite')</h6>
                            </div>
                            <div class="col-sm-6 text-secondary">
                                <strong>{{ $user->favoriteProducts->count() }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
