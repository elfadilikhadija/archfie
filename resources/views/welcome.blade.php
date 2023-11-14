<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Archifats</title>

</head>

<body>


    <div class="content">
        @if (Route::has('login'))
            <div class="card">
                @auth
                    @if (auth()->user()->role == 'admin')
                        <a href="{{ url('/admin/home') }}">Home</a>
                    @elseif (auth()->user()->role == 'user')
                        <a href="{{ url('/user/home') }}">Home</a>
                    @else
                        <a href="{{ url('/home') }}">Home</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="se-connecter-btn">Se Connecter</a>
                @endauth
            </div>
        @endif

    </div>

</body>

</html>
