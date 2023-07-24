<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}" style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">
            MEMEHUB
        </a>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                {{-- Name --}}
                <li class="nav-item">
                @php
                    $role = Auth::user()->role_as;
                @endphp
                @if ($role == 0)
                    <span class="nav-item nav-text">User</span>
                @else
                    <span class="nav-item nav-text">Admin</span>
                @endif
                </li>
                <li class="nav-item">
                    <a class="nav-link">{{ Auth::user()->name }}</a>
                </li>

                {{-- New logout --}}
                <li class="nav-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-flex">
                        {{ csrf_field() }}
                        <button type="submit" style="text-decoration: none"  class="btn btn-link text-primary btn-primary btn-hover text-danger">Logout</button>
                    </form>
                </li>
            @endguest
        </ul>
    </div>
</nav>
