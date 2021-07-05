<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@lang('auth.title-admin')</title>

    <script src="{{ asset('js/app.js') }}" defer></script>

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-green sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
                <div class="sidebar-brand-text mx-3">@lang('auth.admin')</div>
            </a>
            <hr class="sidebar-divider my-0">
            @auth('admin')
                <li class="nav-item active">
                    <a class="nav-link" href="" style="text-align: center "><span>@lang('auth.title-admin')</span></a>
                </li>
                <hr class="sidebar-divider">

                <li class="nav-item">
                    <a class="nav-link " style="cursor: pointer"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i><span>@lang('auth.logout')</span></a>
                </li>
            @endauth

            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <ul class="navbar-nav ml-auto">
                        @auth('admin')
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span><strong>@lang('auth.title-admin')</strong></span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                                <a style="cursor: pointer" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    @lang('auth.logout')
                                </a>
                                <form id="admin-logout-form" action="" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endauth
                    </ul>

                </nav>
                <!-- End of Topbar -->
                <div class="container">
                    @yield('content')
                </div>
                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>@lang('auth.copyright') &copy; DPK3</span>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
</body>
</html>
