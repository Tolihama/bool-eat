<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="min-height: 55px">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="https://fontmeme.com/permalink/220310/1dc46317c469762d332506d29f531b9b.png" alt="" style="width: 200px">
        </a>
        

        <div class="navbar" id="navbarSupportedContent">
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto flex-shrink-1">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fa-solid fa-right-to-bracket mr-2"></i>{{ __('Login') }}
                        </a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                {{ __('Registrati') }}
                            </a>
                        </li>
                    @endif
                @else
                    <li class="nav-item mr-2 mb-2 mb-md-0">
                        <a id="nav-link" class="btn btn-primary" href="{{ route('admin.home') }}">
                            <i class="fa-solid fa-user icon mr-2"></i> {{ Auth::user()->name }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-danger" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            <i class="fa-solid fa-right-from-bracket icon mr-2"></i>{{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>