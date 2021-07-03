@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-sm-6 btn-center mt-30">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-primary ">
                <i class="fas fa-backward"></i>
                @lang('users.back')
            </a>
        </div>
    </div>
</div>
<div class="info-container">
    <div class="info-heading">
        <a href="#" class="info-title">
            <h5 class="title">@lang('categories.add')</h5>
        </a>
    </div>
    <hr class="sidebar-divider my-0">
    <form method="POST" action="{{ route('admin.categories.store') }}">
        @csrf
        <div class="form-group">
            <label for="type">@lang('categories.type') </label>
            <select name="type" id="type_cate" class="form-control">
                <option value="0" selected>@lang('categories.parent')</option>
                <option value="1">@lang('categories.child')</option>
            </select>
        </div>
        <div id="chose_parent" class="form-group d-none">
            <label for="parent">@lang('categories.chose-parent') </label>
            <select name="parent" id="parent" class="form-control">
                @forelse ($categories as $cate)
                    <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                @empty
                    <option disabled selected>@lang('categories.there-no-parent')</option>
                @endforelse
            </select>
        </div>
        <div class="form-group">
            <label for="name">@lang('categories.cate-name') </label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"  value="{{ old('name') }}" required autocomplete="name" required autofocus>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">@lang('categories.description') </label>
            <textarea class="form-control @error('description') is-invalid @enderror" rows="6" id="description" name="description" value="{{ old('description') }}" required autocomplete="description" autofocus required>
            </textarea>

            @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn__default btn--add center__btn">@lang('categories.add')</button>
    </form>
</div>
@endsection
