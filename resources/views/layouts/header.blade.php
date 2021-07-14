<header class="top-navbar">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars-rs-food" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbars-rs-food">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a class="nav-link" href="{{ route('home') }}">@lang('homepage.home')</a></li>
                    <li class="nav-item"><a class="nav-link" href="">@lang('homepage.menu')</a></li>
                    <li class="nav-item"><a class="nav-link" href="">@lang('homepage.about')</a></li>
                    <li class="nav-item"><a class="nav-link" href="">@lang('homepage.suggest')</a></li>
                    <li class="nav-item"><a class="nav-link" href="">@lang('homepage.cart')</a></li>
                    <li class="nav-item"><a class="nav-link" href="">@lang('homepage.check_out')</a></li>
                    @guest('web')
                        <li class="nav-item"><a class="nav-link" href="">@lang('homepage.login')</a></li>
                        <li class="nav-item"><a class="nav-link" href="">@lang('homepage.register')</a></li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="">{{ Auth::guard('web')->user()->name }}</a></li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>
