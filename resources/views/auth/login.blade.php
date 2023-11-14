<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&family=Niconne&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('asset/aceuill.css')}}">
</head>
<body>
    <div class="container">
        <div class="image">
            <h1> وزارة الداخلية
                <span>Province</span></h1>
        </div>

        <div class="content">
            <h1>{{ __('connexion') }}</h1>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="">{{ __("Nom d'utilisateur" ) }}</label>
                    <br>
                    <input type="text" class="form-control" name="" id="txt" aria-describedby="helpId"
                        @error('name') is-invalid @enderror name="name" value="{{ old('name') }}" required autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">{{ __('Password') }}</label>
                            <br>
                            <input type="password" class="form-control" name="" id="txt"
                                @error('password') is-invalid @enderror name="password" required
                                autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                </div>
                <div class="form-group">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
                @if (Route::has('password.request'))
                    <a class="fp" href="{{ route('password.request') }}"> {{ __('Forgot Your Password?') }}</a>
                @endif
                <br>
                <button type="button" class="btn"><a href="#"> {{ __('Login') }}</a></button>
            </form>
        </div>
        </div>


</body>
</html>
