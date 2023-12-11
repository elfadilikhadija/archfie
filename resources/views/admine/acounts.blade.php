@extends('admine.layout')
@section('content')
    <div class="container">
       <div class="row mb-3"> <h3 class="text-center mb-5">list d'utilisateur</h3>
        <form method="GET" action="{{ route('admine.searchByName') }}">
            @csrf
            <div class="input-group mb-3 w-25">
                <input type="text" class="form-control" name="search" placeholder="rechercher par nom" aria-label="Search" aria-describedby="basic-addon2">
                <button class="btn btn-outline-secondary" type="submit"> <i class="fa fa-search"></i></button>
            </div>
        </form>
        <table class="table border">
            <thead>
                <tr>
                    <th>nom</th>
                    <th>Division</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>
                            @if($user->division)
                                       {{ $user->division->nom }}
                            @else
                                No Division Assigned
                            @endif
                        </td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <a data-toggle="modal" data-target="#updateModal" class="btn btn-primary" href="{{ route('admine.modifye', ['id' => $user->id]) }}" >modifier </a>
                            <a onclick="alert('vous vouler suprimer ce utilisateur')" href="{{ route('admine.deleteUser', ['id' => $user->id]) }}" class="btn  btn-danger">suprimer</a>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

                        <!-- start  Modal -->
                        <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h5 class="modal-title" style=" font-size: 24px;
                                        color: #333;
                                        margin-bottom: 10px;
                                        text-transform: uppercase;
                                        font-weight: bolder;
                                        border-bottom: 4px solid #3498db;
                                        margin-right: 30%;"id="updateModalLabel"> <img src="{{ asset('images/paw.png') }}"  width="30px">modifier utilisateur</h5>
                                        <button type="button" class="close bg-warning border-warning" data-dismiss="modal" aria-label="Close">
                                            <span  aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <!-- Modal Body (Your Form Goes Here) -->
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('admine.modify', ['id' => $user->id]) }}">
                                            @csrf
                                            @method('PUT')

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">{{ __('Name') }}</label>
                                                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label for="division_id" class="form-label">{{ __('Division') }}</label>
                                                        <select id="division_id" class="form-select" name="division_id" required>
                                                            <option value="" disabled>Select a Division</option>
                                                            @foreach($divisions as $division)
                                                                <option value="{{ $division->id }}" @if($user->division_id == $division->id) selected @endif>{{ $division->nom }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label for="role" class="form-label">{{ __('Role') }}</label>
                                                        <select id="role" class="form-select" name="role" required>
                                                            <option value="" disabled>Select a Role</option>
                                                            <option value="cadre" @if($user->role == 'cadre') selected @endif>Cadre</option>
                                                            <option value="sg" @if($user->role == 'sg') selected @endif>SG</option>
                                                            <option value="admin" @if($user->role == 'admin') selected @endif>Admin</option>
                                                            <option value="chef" @if($user->role == 'chef') selected @endif>Chef</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label for="password" class="form-label">{{ __('Password') }}</label>
                                                        <input type="password" id="password" class="form-control" name="password" placeholder="Leave blank to keep current password">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                                                        <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    <button type="submit" class="btn btn-primary"> {{ __('Update') }}</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div></div>
                        </div>

                        {{-- end modal --}}

@endsection
