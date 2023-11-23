@extends('admine.layout')

@section('main')
    <div class="container mt-4">
        <h1 class="text-center mb-5">list d'utilisateur</h1>

        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="rechercher par nom" aria-label="Search" aria-describedby="basic-addon2">
            <button class="btn btn-outline-secondary" type="button">Rechercher</button>
        </div>

        <table class="table border">
            <thead>
                <tr>
                    <th>nom</th>
                    <th>Service</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->service->nom }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-primary">Edit</a>
                            <a href="#" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
