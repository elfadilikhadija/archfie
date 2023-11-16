<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&family=Poltawski+Nowy&display=swap" rel="stylesheet">
    <style>
        img{
            width: 8%;
            margin-right:10%;
        }
        body{
            font-family: 'Merriweather', serif;
            font-family: 'Poltawski Nowy', serif;

        }

        </style>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <img   src="{{ asset('images/r.png') }}" alt="Your Image">


                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">

                    <ul class="navbar-nav me-auto">

                        <li class="nav-item">
                            <a href="{{ route('cadre.home') }}" class="nav-link">Acceuil</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cadre.create') }}" class="nav-link">Ajouter une fichier</a>
                        </li>

                    </ul>


                    <ul class="navbar-nav ms-auto">

                        @auth
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit">Logout</button>
                                </form>

                            </div>
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
