<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm p-0 m-0">
    <div class="container-fluid p-0 m-0">
            <a class="navbar-brand" href="{{ url('/') }}" style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">
                <img class="navbar-brand container-fluid p-0 m-0" src="{{ asset('images/logo-v1.png') }}"  class="me-2" height="70" alt="{{ asset('images/no-image.png') }}">
            </a>
            <a class="navbar-brand" href="{{ url('/') }}" style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">
                Create Post
            </a>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto px-5">
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
                @if ($role == "")
                    <span class="nav-item nav-text">Guest</span>
                @elseif ($role == 0)
                    <span class="nav-item nav-text">User</span>
                @elseif ($role == 1)
                    <span class="nav-item nav-text">Admin</span>
                @endif
                    
                </li>
                <li class="nav-item">
                    <h2><a class="nav-link">{{ Auth::user()->name }}</a></h2>
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
