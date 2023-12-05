@extends('admine.layout')

@section('main')
    <div class="container mt-4">
        <h1 class="text-center mb-5">list d'utilisateur</h1>


        <form method="GET" action="{{ route('admine.searchByName') }}">
            @csrf
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="search" placeholder="rechercher par nom" aria-label="Search" aria-describedby="basic-addon2">
                <button class="btn btn-outline-secondary" type="submit">Rechercher</button>
            </div>
        </form>


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
                        <td>
                            @if($user->division)
                                {{ $user->division->nom }}
                            @else
                                No Division Assigned
                            @endif
                        </td>

                        <td>{{ $user->role }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('admine.modifye', ['id' => $user->id]) }}" >modifier </a>
                            <a onclick="alert('vous vouler suprimer ce utilisateur')" href="{{ route('admine.deleteUser', ['id' => $user->id]) }}" class="btn  btn-danger">suprimer</a>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
