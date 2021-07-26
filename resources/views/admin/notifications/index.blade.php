@extends('admin.layouts.app')

@section('content')
    <div class="course-container">
        <div class="course-heading">
            <a href="#" class="info-title">
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
                    <div class="col-sm-12 text-center">
                        <a href="" class="exam-title-class">
                            <i class="fa fa-list-alt"></i>
                            @lang('notification.notifications')
                        </a>
                    </div>
                    <div class="info-table-course">
                        <table class="table table-st">
                            <thead class="color__theme">
                                <tr>
                                    <th>@lang('notification.type')</th>
                                    <th>@lang('notification.message')</th>
                                    <th>@lang('notification.send_at')</th>
                                    <th>@lang('notification.reat_at')</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($notifications as $notify)
                                    <tr>
                                        <td>@if (isset($notify->data['order'])) @lang('notification.order') @else @lang('notification.daily') @endif</td>
                                        <td>{{ $notify->data['message'] }}</td>
                                        <td>{{ $notify->created_at }}</td>
                                        <td>{{ $notify->read_at ?? trans('notification.unread') }}</td>
                                        <td class="d-flex justify-content-center">
                                            <a href="@if (isset($notify->data['order'])){{ route('admin.orders.show', $notify->data['order']['id']) }} @else {{ route('order.index') }} @endif" class="btn btn-primary mr-2">@lang('users.detail')</a>
                                            <form action="{{ route('admin.notifications.update', $notify->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                @if (!$notify->read_at)
                                                    <button class="btn btn-success btn-mark-read" data-id="{{ $notify->id }}">@lang('notification.mark_read')</button>
                                                @else
                                                    <button class="btn btn-secondary btn-mark-unread" data-id="{{ $notify->id }}">@lang('notification.mark_unread')</button>
                                                @endif
                                            </form>
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
    {{ $notifications->links() }}
@endsection
