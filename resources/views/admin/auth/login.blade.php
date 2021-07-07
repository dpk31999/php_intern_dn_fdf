@extends('admin.layouts.app')

@section('content')
    <div class="form-container-admin" style="margin-top: -10px;">
        <div class="container-admin">
            <div class="form-heading">
                <a href="#" class="form-title-link">
                    <i class="fas fa-user-circle fa-2x text-gray-300" id="icon-custom"></i>
                    <h3 class="title">@lang('auth.welcome_to_login')</h3>
                </a>
            </div>
            @include('common.error')
            @include('common.message')
            <form method="POST" action="{{ route('admin.excute.login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">@lang('auth.email') :</label>
                    <div class="form-input">
                        <i class="fas fa-user fa-sm fa-fw mr-2 " id="icon-custom"></i>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="pwd">@lang('auth.password') :</label>
                    <div class="form-input">
                        <i class="fas fa-lock fa-sm fa-fw mr-2" id="icon-custom"></i>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password">
                    </div>
                </div>
                <div class="form-button">
                    <button type="submit" class="btn__default btn--add center__btn-admin">@lang('auth.login')</button>
                </div>
            </form>
        </div>
    </div>
@endsection
