@extends('admine.layout')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Form for modifying user details -->
            <form method="POST" action="{{ route('admine.modify', ['id' => $user->id]) }}">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="mb-3 row">
                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                    </div>
                </div>


                </div>

                <!-- Division -->
                <div class="mb-3 row">
                    <label for="division_id" class="col-md-4 col-form-label text-md-end">{{ __('Division') }}</label>
                    <div class="col-md-6">
                        <select id="division_id" class="form-select" name="division_id" required>
                            <option value="" disabled>Select a Division</option>
                            @foreach($divisions as $division)
                                <option value="{{ $division->id }}" @if($user->division_id == $division->id) selected @endif>{{ $division->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Role -->
                <div class="mb-3 row">
                    <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>
                    <div class="col-md-6">
                        <select id="role" class="form-select" name="role" required>
                            <option value="" disabled>Select a Role</option>
                            <option value="cadre" @if($user->role == 'cadre') selected @endif>Cadre</option>
                            <option value="sg" @if($user->role == 'sg') selected @endif>SG</option>
                            <option value="admin" @if($user->role == 'admin') selected @endif>Admin</option>
                            <option value="chef" @if($user->role == 'chef') selected @endif>Chef</option>
                        </select>
                    </div>
                </div>

                <!-- Password -->
                <div class="mb-3 row">
                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password" placeholder="Leave blank to keep current password">
                    </div>
                </div>

                <!-- Confirm Password -->
                <div class="mb-3 row">
                    <label for="password_confirmation" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                    <div class="col-md-6">
                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                    </div>
                </div>

                <!-- Submit button -->
                <div class="row">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Update') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
