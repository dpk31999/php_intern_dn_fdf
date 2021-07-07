@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-sm-6 btn-center mt-30">
            <a href="{{ route('admin.products.index') }}" class="btn btn-primary ">
                <i class="fas fa-backward"></i>
                @lang('users.back')
            </a>
        </div>
    </div>
</div>
<div class="info-container">
    <div class="info-heading">
        <a href="#" class="info-title">
            <h5 class="title">@lang('products.add_product')</h5>
        </a>
    </div>
    <hr class="sidebar-divider my-0">
    <form method="POST" action="{{ route('admin.products.store') }}">
        @csrf
        <div class="form-group">
            <label for="cate">@lang('products.name_cate') </label>
            <select name="cate" id="cate" class="form-control">
                @forelse ($categories as $cate)
                    <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                @empty
                    <option disabled selected>@lang('products.there_no_parent')</option>
                @endforelse
            </select>
        </div>
        <div class="form-group">
            <label for="name">@lang('products.name_product') </label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"  value="{{ old('name') }}" required autocomplete="name" required autofocus>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="price">@lang('products.price') </label>
            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" id="price"  value="{{ old('price') }}" required autocomplete="price" autofocus required>

            @error('price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">@lang('products.description') </label>
            <textarea class="form-control @error('description') is-invalid @enderror" rows="6" id="description" name="description" value="{{ old('description') }}" required autocomplete="description" autofocus required>
            </textarea>

            @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn__default btn--add center__btn">@lang('products.add')</button>
    </form>
</div>
@endsection
