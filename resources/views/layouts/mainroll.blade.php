<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'CGX'))</title>
     
    <!-- Stylesheets-->
    <link rel="stylesheet" href="{{ asset('build/assets/CSS/theme.css') }}">
    
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    <!-- Additional styles -->
    @yield('styles')
</head>

<body>
    <main class="main" id="top">
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 d-block" data-navbar-on-scroll="data-navbar-on-scroll">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="d-inline-block" src="{{ asset('build/assets/imgs/logo.png') }}" width="50" alt="logo" />
                    <span class="fw-bold text-primary ms-2">CGX</span>
                </a>
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @yield('left-nav')
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="btn btn-voyage-outline order-0 mr-2" href="{{ route('login') }}">Sign in</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="btn btn-voyage-outline order-1" href="{{ route('register') }}">Sign Up</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item me-3">
                                <a class="btn btn-primary" href="#">View Status</a>
                            </li>
                            <li class="nav-item me-3">
                                <span class="nav-link fw-bold">{{ Auth::user()->name }}</span>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-outline-danger" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
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

        <section class="mt-7 py-0">
            @yield('content')
        </section>
    </main>

    <script src="{{ asset('build/assets/js/theme.js') }}"></script>
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- Additional scripts -->
    @yield('scripts')
</body>
</html>