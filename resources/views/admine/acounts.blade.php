
@extends('admine.layout ')

@section('main')

        <h1>User List</h1>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        {{-- <td>{{ $user->division }}</td> --}}
                        <td>{{ $user->role }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

</div>
@endsection


