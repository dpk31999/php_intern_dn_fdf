<header class="top-navbar">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars-rs-food" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbars-rs-food">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item {{ Route::is('home') ? 'active' : '' }}"><a class="nav-link" href="{{ route('home') }}">@lang('homepage.home')</a></li>
                    <li class="nav-item {{ Route::is('menu') ? 'active' : '' }}"><a class="nav-link" href="{{ route('menu') }}">@lang('homepage.menu')</a></li>
                    <li class="nav-item"><a class="nav-link" href="">@lang('homepage.about')</a></li>
                    <li class="nav-item"><a class="nav-link" href="">@lang('homepage.suggest')</a></li>
                    <li class="nav-item"><a class="nav-link" href="">@lang('homepage.cart')</a></li>
                    <li class="nav-item"><a class="nav-link" href="">@lang('homepage.check_out')</a></li>
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
                                    <button class="dropdown-item cursor">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        @lang('auth.logout')
                                    </button>
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>
