@extends('admin.layouts.app')

@section('content')
    <div class="course-container">
        <div class="course-heading">
            <a href="#" class="info-title">
                <i class="fas fa-users-cog fa-lg fa-fw mr-2 text-gray-400"></i>
                <h5 class="title">@lang('users.hello') {{ Auth::guard('admin')->user()->fullname }}</h5>
            </a>
        </div>
        <div id="message"></div>
        <div class="course-heading-title">
            <div class="row exam-title-color-class">
                <div class="container">
                    <div class="col-sm-12 text-center">
                        <a href="" class="exam-title-class">
                            <i class="fas fa-users"></i>
                            @lang('users.user-system')
                        </a>
                    </div>
                    <div class="info-table-course">
                        <table class="table table-st">
                            <thead class="color__theme">
                                <tr>
                                    <th>@lang('users.fullname')</th>
                                    <th>@lang('users.email')</th>
                                    <th>@lang('users.phone-number')</th>
                                    <th>@lang('users.num-order')</th>
                                    <th>@lang('users.num-suggest')</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr id="user-{{ $user->id }}">
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->orders_count }}</td>
                                        <td>{{ $user->suggest_products_count }}</td>
                                        <td class="d-flex">
                                            <a class="btn btn-primary mr-2"
                                                href="{{ route('admin.users.show', $user->id) }}">
                                                @lang('users.detail')
                                            </a>
                                            <button type="submit" data-id="{{ $user->id }}" class="btn-delete btn btn-danger">
                                                @lang('users.delete')
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
    {{ $users->links() }}
@endsection
