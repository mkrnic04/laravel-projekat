<header class="header_area">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand logo_h" href="{{ route('home') }}">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto">
                        <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item {{ request()->routeIs('shop.index') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('shop.index') }}">Shop</a>
                        </li>
                        <li class="nav-item {{ request()->routeIs('contact') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                        </li>

                        @guest
                            <li class="nav-item {{ request()->is('login') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('login') }}">Prijava</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item {{ request()->is('register') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('register') }}">Registracija</a>
                                </li>
                            @endif
                        @else
                            @if(auth()->user()->role_id == 1)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.dashboard') }}" style="color: #ffba00; font-weight: bold;">
                                        <i class="fas fa-chart-line"></i> Admin Panel
                                    </a>
                                </li>
                            @endif
                            <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                                 aria-expanded="false"><i class="fa fa-user"></i> {{ Auth::user()->name }}</a>
                                <ul class="dropdown-menu">
                                    {{--<li class="nav-item">
                                        <a class="nav-link" href="{{ url('/dashboard') }}">Moj Profil</a>
                                    </li>--}}
                                    <li class="nav-item">
                                        <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display: none;">
                                            @csrf
                                        </form>
                                        <a class="nav-link" href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                           style="cursor: pointer;">
                                            Odjavi se
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                        </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="nav-item">
                            <a href="{{ route('cart.index') }}" class="cart">
                                <span class="ti-bag"></span>
                                <span class="nav-shop__circle">{{ count((array) session('cart')) }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

</header>
