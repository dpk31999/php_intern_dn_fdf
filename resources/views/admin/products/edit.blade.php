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
@include('common.message')
@include('common.error')
<div id="message"></div>
<div class="info-container">
    <hr class="sidebar-divider my-0">
    <div class="info-heading">
        <div class="info-title">
            <h5 class="title">@lang('products.edit-images')</h5>
        </div>
        <div class="icon_sub">
            <form id="form_add_image" action="{{ route('admin.image.store', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="image" class="cursor">
                    <i class="fas fa-plus-circle fa-lg fa-fw mr-2 color__admin "></i>
                    @lang('products.add-image')
                </label>
                <input id="image" class="d-none" type="file" name="image" onchange="this.form.submit()"/>
            </form>
        </div>
        <div class="row">
            @foreach ($product->images as $image)
                <div class="col-sm-4 mt-3" id="image-{{ $image->id }}">
                    <a href="/storage/{{ $image->image_path }}" target="_blank"><img src="/storage/{{ $image->image_path }}" width="150" height="150" alt=""></a>
                    <button data-id="{{ $image->id }}" class="btn-delete-image btn btn-danger">@lang('products.delete')</button>
                </div>
            @endforeach
        </div>
    </div>
    <div class="info-heading">
        <div class="info-title">
            <h5 class="title">@lang('products.add-product')</h5>
        </div>
    </div>
    <hr class="sidebar-divider my-0 mt-4">
    <form method="POST" action="{{ route('admin.products.update', $product->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="cate">@lang('products.name-cate') </label>
            <select name="cate" id="cate" class="form-control">
                @forelse ($categories as $cate)
                    <option value="{{ $cate->id }}" {{ $cate->id == $product->cate_id ? 'selected' : '' }}>{{ $cate->name }}</option>
                @empty
                    <option disabled selected>@lang('products.there-no-parent')</option>
                @endforelse
            </select>
        </div>
        <div class="form-group">
            <label for="name">@lang('products.name-product') </label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"  value="{{ $product->name }}" required autocomplete="name" required>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="price">@lang('products.price') </label>
            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" id="price"  value="{{ $product->price }}" required autocomplete="price" required>

            @error('price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">@lang('products.description') </label>
            <textarea class="form-control @error('description') is-invalid @enderror" rows="6" id="description" name="description" value="{{ old('description') }}" required autocomplete="description" required>
            {{ $product->description }}
            </textarea>

            @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn__default btn--add center__btn">@lang('products.edit')</button>
    </form>
</div>
@endsection
