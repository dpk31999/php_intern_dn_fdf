@extends('admin.layouts.app')

@section('content')
    <div class="course-container">
        <div class="course-heading">
            <a href="#" class="info-title" style=" font-size: 20px;">
                <i class="fas fa-users-cog fa-lg fa-fw mr-2 text-gray-400"></i>
                <h5 class="title">@lang('categories.hello') {{ Auth::guard('admin')->user()->fullname }}</h5>
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
                            @lang('order.orders')
                        </a>
                    </div>
                    <div class="info-table-course">
                        <table class="table table-st">
                            <thead class="color__theme">
                                <tr>
                                    <th>@lang('homepage.order_id')</th>
                                    <th>@lang('users.fullname')</th>
                                    <th>@lang('homepage.order_status')</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr id="order-{{ $order->id }}">
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->user->name }}</td>
                                        <form method="POST" action="{{ route('admin.orders.update', $order->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <td>
                                                <select @if ($order->status !== 'Pending') disabled @endif name="status" id="status" class="form-control">
                                                    <option value="Done" {{ $order->status == 'Done' ? 'selected' : '' }}>
                                                        @lang('order.done')</option>
                                                    <option value="Pending"
                                                        {{ $order->status == 'Pending' ? 'selected' : '' }}>
                                                        @lang('order.pending')</option>
                                                    <option value="Cancel"
                                                        {{ $order->status == 'Cancel' ? 'selected' : '' }}>
                                                        @lang('order.cancel')</option>
                                                </select>
                                                <input type="hidden" name="old_status" value="{{ $order->status }}">
                                            </td>
                                            <td>
                                                <button type="submit" class="btn btn-success">@lang('products.update')</button>
                                                <a class="btn btn-primary mr-2"
                                                    href="{{ route('admin.orders.show', $order->id) }}">
                                                    @lang('users.detail')
                                                </a>
                                            </td>
                                        </form>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ $orders->links() }}
@endsection
