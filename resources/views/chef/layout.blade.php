<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Meta tags -->
    <!-- Include your meta tags here -->

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
     <!-- Fonts -->
     <link rel="dns-prefetch" href="//fonts.bunny.net">
     <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Merriweather&family=Poltawski+Nowy&display=swap" rel="stylesheet">
   
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&family=Poltawski+Nowy&display=swap" rel="stylesheet">
    <style>
        /* Custom styles */
        img.logo {
            width: 8%;
            margin-right: 10px; /* Adjust the margin as needed */
        }
        body {
            font-family: 'Merriweather', serif;
        }
        /* Other styles for your navbar go here */

    </style>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Your other scripts and stylesheets -->
    <!-- ... -->

</head>
<body>
    <div id="app">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <img class="logo" src="{{ asset('images/r.png') }}" alt="Your Logo">

                <!-- Navbar toggle button for mobile -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <!-- Left side of the navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a href="{{ route('chef.home') }}" class="nav-link">Home</a>
                        </li>
                    </ul>

                    <!-- Search bar -->
                    <form class="d-flex" method="POST" action="{{ route('chef.search') }}">
                        @csrf
                        <input class="form-control me-2" type="search" name="query" placeholder="Rechercher..." aria-label="Search">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>

                    <!-- Right side of the navbar -->
                    <ul class="navbar-nav ms-auto">
                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                <!-- Your main content goes here -->
                @yield('main')
            </div>
        </main>
    </div>
</body>
</html>
