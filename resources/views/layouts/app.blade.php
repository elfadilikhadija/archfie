<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- title name --}}
    <title>{{ config('app.name', 'Laravel') }}</title>
    {{-- css of intro page --}}
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&family=Niconne&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('asset/aceuill.css')}}">

</head>
<body>
    <div>
        <main>
            @yield('main')
        </main>
    </div>
</body>
</html>
