<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Octa Project</title>
    <link rel="shortcut icon" href="{{ asset('img/Logo.png') }}">

    {{-- My CSS --}}
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/post.css">
    <link rel="stylesheet" href="css/profile.css">

    <!-- Bootstrap CSS -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- Admin LTE --}}
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    @stack('styles')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm sticky-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('img/Logo.png') }}" alt="Logo" width="30" class="mb-1">
                    {{-- {{ config('app.name', 'Laravel') }} --}}
                    Octa Project
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
    
                    
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                    </ul>

                    <!-- Center Side Of Navbar -->
                    <div class="collapse navbar-collapse justify-content-center" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                          <a class="nav-link {{ Request::is('/*', 'posts*') ? 'active' : '' }}" aria-current="page" href="/">Home</a>
                          <a class="nav-link {{ Request::is('profile*') ? 'active' : '' }}" href="/profile">Profile</a>
                          <a class="nav-link disabled" href="#">Category</a>
                        </div>
                    </div>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
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
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                    
                    
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-dark animate-menu slideIn-menu" aria-labelledby="navbarDropdown">
                    
                                    {{-- Profile --}}
                                    <a href="{{ route('home') }}" class="d-block text-dark text-decoration-none fw-bold fs-6">
                                        <div class="card bg-dark m-2 pt-2">
                                            <div class="justify-content-center d-flex mb-2">
                                                <div class="image">
                                                    @if (auth()->user()->images)
                                                        <img src="{{ asset('storage/images/' . Auth::user()->images) }}" class="rounded rounded-circle" alt="User Image" width="40" height="40" style="border: 3px black solid">
                                                    @else
                                                        <img src="{{ asset('vendor/admin-lte/img/user-profile-default.jpg') }}" class="rounded rounded-circle" alt="User Image" width="40" height="40" style="border: 3px black solid">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="info px-2">
                                                <p class="text-center d-block text-white text-decoration-none fw-bold fs-6">{{ Auth()->user()->name }}</p>
                                            </div>
                                        </div>
                                    </a>

                                    {{-- Dashboard --}}
                                    @if (auth()->user()->role != 'Member')
                                        <a class="dropdown-item" href="{{ route('home') }}">
                                            {{ __('Dashboard') }}
                                        </a>

                                        <hr class="dropdown-divider">
                                    @endif
                    
                    
                                    {{-- Edit Profile --}}
                                    <a class="dropdown-item" href="{{ route('my.profile.index') }}">
                                        {{ __('Edit Profile') }}
                                    </a>
                    
                                    <hr class="dropdown-divider">
                    
                                    {{-- Logout --}}
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                    
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>


    
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/admin-lte/adminlte.min.js') }}"></script>
    @stack('scripts')
</body>
</html>