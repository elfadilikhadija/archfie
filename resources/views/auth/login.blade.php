@extends('layouts.app')
@section('main')
    <div class="container">
        <div class="image">
            <h1>Bienvenu sur le portail</h1>
            <span>d'archiffe</span></h1>
        </div>
        <div class="content">
            <img src="{{ asset('images/R.png') }}" alt="">
            {{-- <h1>{{ __('connexion') }}</h1> --}}
            <h1>{{ __('WILAYADELAREGION BENI MELLAL-KHENIFRA SECRETARIAT GENERAL DES AFFAIRES REGIONALES') }}</h1>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="">{{ __("Nom d'utilisateur") }}</label>
                    <br>
                    <input type="text" class="form-control" name="name" id="txt" aria-describedby="helpId"
                        @error('name') is-invalid @enderror name="name" value="{{ old('name') }}" required autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">{{ __('Mot de pass') }}</label>
                    <br>
                    <input type="password" class="form-control" name="password" id="txt"
                        @error('password') is-invalid @enderror name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn">{{ __('Login') }}</button>
            </form>
        </div>
    </div>
@endsection

