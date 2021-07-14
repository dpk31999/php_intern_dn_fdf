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
            <h5 class="title">@lang('categories.edit_cate')</h5>
        </a>
    </div>
    <hr class="sidebar-divider my-0">
    <form method="POST" action="{{ route('admin.categories.update', $category->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="type">@lang('categories.type') </label>
            <select name="type" id="type_cate" class="form-control">
                <option value="0" {{ $category->type == '0' ? 'selected' : '' }}>@lang('categories.parent')</option>
                <option value="1" {{ $category->type == '1' ? 'selected' : '' }}>@lang('categories.child')</option>
            </select>
        </div>
        <div id="chose_parent" class="form-group @if ($category->type == '0') d-none @endif>
            <label for="parent">@lang('categories.chose_parent') :</label>
            <select name="parent" id="parent" class="form-control">
                @forelse ($categories as $cate)
                    <option value="{{ $cate->id }}" {{ $cate->id == $category->id ? 'selected' : '' }}>{{ $cate->name }}</option>
                @empty
                    <option disabled selected>@lang('categories.there_no_parent')</option>
                @endforelse
            </select>
        </div>
        <div class="form-group">
            <label for="name">@lang('categories.cate_name') </label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"  value="{{ $category->name }}" required autocomplete="name" required autofocus>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">@lang('categories.description') </label>
            <textarea class="form-control @error('description') is-invalid @enderror" rows="6" id="description" name="description" required autocomplete="description" autofocus required>
            {{ $category->description }}
            </textarea>

            @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn__default btn--add center__btn">@lang('categories.update')</button>
    </form>
</div>
@endsection
