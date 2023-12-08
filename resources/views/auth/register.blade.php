@extends('layouts.app')
@section('deco')
<style>
    .container {

height: 500px;
width: 650px;
box-shadow: 0px 30px 40px black;
display: flex;
border-radius: 10px;
}
.image h1 {
    margin-top: 70%;
}
</style>
@endsection
@section('content')
    <div class="container">
        <div class="image">
            <h1>Bienvenu sur le portail</h1>
            <span>d'archiffe</span></h1>
        </div>
        <div class="content">
        <img src="{{ asset('images/R.png') }}" alt="">
        <h1>{{ __('WILAYADELAREGION BENI MELLAL-KHENIFRA SECRETARIAT GENERAL DES AFFAIRES REGIONALES') }}</h1>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group"> <label for="">{{ __("Nom d'utilisateur") }}</label>
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
<div class="flo">

                            <label for="service_id" class="col-md-4 col-form-label text-md-end">{{ __('') }}</label>

                            <div class="col-md-6">
                                <select id="service_id" class="form-select @error('service_id') is-invalid @enderror" name="service_id" required>
                                    <option value="0" >Choose Service</option>
                              @foreach ($services as $service)
                                    <option value="1">{{$service->nom}}</option>
                                    @endforeach
                                </select>
                                @error('service_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>



                            <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('') }}</label>

                            <div class="col-md-6">
                                <select id="role" class="form-select @error('role') is-invalid @enderror" name="role" required>
                                    <option disabled selected> choose Role</option>
                                    <option value="cadre">Cadre</option>
                                    <option value="sg">SG</option>
                                    <option value="admin">Admin</option>
                                    <option value="chef">Chef</option>
                                </select>

                                @error('role')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                    </div>

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

            <div class="form-group">
                <label for="password-confirm">{{ __('Confirm Password') }}</label>

                <br>

                <input   id="txt" type="password" class="form-control" name="password_confirmation" required
                    autocomplete="new-password">

            </div>
            <button type="submit" class="btn">
                {{ __('Register') }}
            </button>
        </form>
    </div>
    </div>
@endsection
