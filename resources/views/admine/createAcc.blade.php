@extends('admine.layout')
@section('style')
<style>
    .vanille {
        background-color: #fff;
        box-shadow: 0px 1px 1.5px #333;
        height: 510px;
        width: 750px;
    }
    .vanille__left-title {
        font-size: 2rem;
        color: #bb3b0e;
    }

    .vanille__left-body {
        padding: 30px 20px;
    }
    .form-group label {
        font-weight: 400;
        font-size: 20px;
        color: #000;
    }
   .btn-primary {
        background-color: #bb3b0e !important;
        border: #ff5500 !important;
        font-size: 0.9rem !important;
        font-weight: 400 !important;
        margin-top: 15px;
    }
    .vanille__right-image {
       background-color: #bb3b0e;
        height:510px;
    }
    .title-right {
        text-align: center;
        color: #fff;
        font-size: 1rem;
        margin-top: 200px;
    }
    .vanille__right-image img{
        border: none;
        border-radius: 50%;
        width: 60%;
        margin-top: 10px;
        margin-left: 60px ;
    }
</style>
@endsection
@section('content')
<div class="vanille row "  style="margin-right: 3rem; margin-left: 15rem;">
        <div class="vanille__left col-12 col-lg-6 py-4 px-4 ">
            <div class="vanille__left-title text-center">
                <i class="fa fa-users"></i>
                <span>Créer<b> un compte</b></span>
            </div>
            <div class="vanille__left-body">
                <form method="POST" action="{{ route('admine.register') }}" class="py-4">
                    @csrf
                    <label for="name">{{ __('Name') }}</label>
                    <div class="form-group ">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}" required autocomplete="name" autofocus />
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <label for="division_id">{{ __('Division') }}</label>
                    <div class="form-group">
                        <select id="division_id" class="form-select @error('division_id') is-invalid @enderror"
                            name="division_id" required>
                            <option value="" disabled selected>Select a Division</option>
                            @foreach($divisions as $division)
                            <option value="{{ $division->id }}">{{ $division->nom }}</option>
                            @endforeach
                        </select>
                        @error('division_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                    <label for="role" class="">{{ __('Role') }}</label>
                    <div class="form-group">
                        <select id="role" class="form-select @error('role') is-invalid @enderror" name="role" required>
                            <option disabled selected>Choose a role</option>
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
                    <div class="form-group">
                        <label for="password">{{ __('Password') }}</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                            required autocomplete="new-password" />
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password-confirm">{{ __('Confirm Password') }}</label>
                        <input type="password" class="form-control" name="password_confirmation" required
                            autocomplete="new-password" />
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class=" btn btn-primary">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="vanille__right-image col-lg-6 d-none d-lg-block">
            <h6 class="title-right">Les archives sont les gardiennes silencieuses de la réputation, tissant l'histoire et préservant la sagesse des actions passées</h6>
       <img src="{{ asset('images/ar.png') }}" alt="">
        </div>
    </div>

@endsection
