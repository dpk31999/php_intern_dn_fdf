@extends('admin.layouts.app')

@section('content')
    <div class="course-container">
        <div class="course-heading">
            <a href="#" class="info-title">
                <i class="fas fa-users-cog fa-lg fa-fw mr-2 text-gray-400"></i>
                <h5 class="title">@lang('categories.hello') {{ Auth::guard('admin')->user()->fullname }}</h5>
            </a>
        </div>
        <div class="icon_sub">
            <a href="{{ route('admin.categories.create') }}">
                <i class="fas fa-plus-circle fa-lg fa-fw mr-2 color__admin "></i>
                @lang('categories.add')
            </a>
        </div>
        @include('common.message')
        @include('common.error')
        <div id="message"></div>
        <div class="course-heading-title">
            <div class="row exam-title-color-class">
                <div class="container">
                    <div class="col-sm-12 text-center">
                        <a href="" class="exam-title-class">
                            <i class="fa fa-list-alt"></i>
                            @lang('categories.categories')
                        </a>
                    </div>
                    <div class="info-table-course">
                        <table class="table table-st">
                            <thead class="color__theme">
                                <tr>
                                    <th>@lang('categories.name-cate')</th>
                                    <th>@lang('categories.description')</th>
                                    <th>@lang('categories.parent-cate')</th>
                                    <th>@lang('categories.type')</th>
                                    <th>@lang('categories.num-product')</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $cate)
                                    <tr id="category-{{ $cate->id }}">
                                        <td>{{ $cate->name }}</td>
                                        <td>{{ $cate->description }}</td>
                                        <td>{{ $cate->parentCategory->name ?? trans('categories.no-parent') }}</td>
                                        <td>{{ $cate->type }}</td>
                                        <td>{{ $cate->products->count() }}</td>
                                        <td class="d-flex">
                                            <a class="btn btn-primary mr-2"
                                                href="{{ route('admin.categories.edit', $cate->id) }}">
                                                @lang('categories.edit')
                                            </a>
                                            <button type="submit" data-id="{{ $cate->id }}" class="btn-delete-cate btn btn-danger">
                                                @lang('categories.delete')
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ $categories->links() }}
@endsection
