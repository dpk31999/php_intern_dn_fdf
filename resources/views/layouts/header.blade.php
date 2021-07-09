<header class="top-navbar">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars-rs-food" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbars-rs-food">
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2 rounded border border-secondary border-top-0" type="search" placeholder="Search" aria-label="Search">
                </form>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item {{ Route::is('home') ? 'active' : '' }}"><a class="nav-link" href="{{ route('home') }}">@lang('homepage.home')</a></li>
                    <li class="nav-item {{ Route::is('menu') ? 'active' : '' }}"><a class="nav-link" href="{{ route('menu') }}">@lang('homepage.menu')</a></li>
                    <li class="nav-item"><a class="nav-link" href="">@lang('homepage.suggest')</a></li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center cursor" data-toggle="modal" data-target="#cartModal">
                            @lang('homepage.cart') <span class="badge badge-success ml-2" id="nav_count">{{ session()->get('cart')->totalQuantity ?? '0' }}</span>
                        </a>
                    </li>
                    @guest('web')
                        <li class="nav-item"><a class="nav-link cursor" data-toggle="modal" data-target="#modalLogin">@lang('homepage.login')</a></li>
                        <li class="nav-item"><a class="nav-link cursor" data-toggle="modal" data-target="#modalRegister">@lang('homepage.register')</a></li>
                    @else
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span>{{ Auth::guard('web')->user()->name }}</strong></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <form id="logout-form" method="POST">
                                    @csrf
                                    <a class="dropdown-item cursor"><button class="btn btn-outline-light">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        @lang('auth.logout')
                                    </button>
                                    </a>
                                </form>
                                <a class="dropdown-item" href="{{ route('profile.index') }}">Profile</a>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>
