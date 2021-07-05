@extends('admin.layouts.app')

@section('content')
    <div class="course-container">
        <div class="course-heading">
            <a href="#" class="info-title" style=" font-size: 20px;">
                <i class="fas fa-users-cog fa-lg fa-fw mr-2 text-gray-400"></i>
                <h5 class="title">@lang('categories.hello') {{ Auth::guard('admin')->user()->fullname }}</h5>
            </a>
        </div>
        <div class="icon_sub">
            <a href="{{ route('admin.products.create') }}">
                <i class="fas fa-plus-circle fa-lg fa-fw mr-2 color__admin "></i>
                @lang('products.add-product')
            </a>
        </div>
        @include('common.message')
        @include('common.error')
        <div id="message"></div>
        <div class="course-heading-title">
            <div class="row exam-title-color-class">
                <div class="container">
                    <div class="col-sm-12 " style="text-align: center" ;>
                        <a href="" class="exam-title-class">
                            <i class="fa fa-list-alt"></i>
                            @lang('products.products')
                        </a>
                    </div>
                    <div class="info-table-course">
                        <table class="table table-st">
                            <thead class="color__theme">
                                <tr>
                                    <th>@lang('products.name-cate')</th>
                                    <th>@lang('products.name-product')</th>
                                    <th>@lang('products.price')</th>
                                    <th>@lang('products.num-image')</th>
                                    <th>@lang('products.avg-rate')</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr id="product-{{ $product->id }}">
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ number_format($product->price, 2) }}</td>
                                        <td>{{ $product->images->count() }}</td>
                                        <td>{{ $product->avgRating }}</td>
                                        <td class="d-flex">
                                            <a class="btn btn-primary mr-2"
                                                href="{{ route('admin.products.edit', $product->id) }}">
                                                @lang('products.edit')
                                            </a>
                                            <button type="submit" data-id="{{ $product->id }}" class="btn-delete-product btn btn-danger">
                                                @lang('products.delete')
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
    {{ $products->links() }}
@endsection
