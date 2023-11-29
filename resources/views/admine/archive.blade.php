


@extends('admine.layout')

@section('main')

<div class="">
    <div class="row mb-3">
        <div class="col-md-6">
            <form method="POST" action="{{ route('admine.search') }}" class="input-group">
                @csrf
                <input type="text" class="form-control" name="query" placeholder="Rechercher..." aria-label="Rechercher">
                <button class="btn btn-outline-secondary" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>

        <div class="btn-group" role="group">
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="categoryDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-filter"></i> Filtrer par Catégorie
                </button>
                <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
                    @foreach($categories as $category)
                        <li>
                            <a class="dropdown-item" href="{{ route('admine.filteredByCategory', $category->id) }}">
                                {{ $category->nom }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="divisionDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-filter"></i> Filtrer par Division
                </button>
                <ul class="dropdown-menu" aria-labelledby="divisionDropdown">
                    @foreach($divisions as $division)
                        <li><a class="dropdown-item" href="{{ route('admine.filteredByDivision', $division->id) }}">{{ $division->nom }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Objet</th>
                    <th>Numero</th>
                    <th>Destinateur</th>
                    <th>Destinataire</th>
                    <th>Date</th>
                    <th>Division</th>
                    <th>Categorie</th>
                    <th>Fichier</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fichiers as $fich)
                <tr>
                    <td>{{ $fich->id }}</td>
                    <td>{{ $fich->objet }}</td>
                    <td>{{ $fich->numero }}</td>
                    <td>{{ $fich->destinateurt }}</td>
                    <td>{{ $fich->destinataire }}</td>
                    <td>{{ $fich->date }}</td>
                    <td>{{ $fich->division->nom }}</td>
                    <td>{{ $fich->service->nom }}</td>
                    <td>{{ $fich->categorie->nom }}</td>
                    <td>
                        <a href="{{ asset('storage/pdfs/'.$fich->fichier) }}" target="_blank">View PDF</a>
                    </td>
                    <td>
                        <a href="{{ route('admine.edit', ['id' => $fich->id]) }}" class="btn btn-sm btn-primary">Update</a>
                        <form action="{{ route('admine.desarchife', ['id' => $fich->id]) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-secondary" onclick="return confirm('Are you sure you want to unarchive this file?')">récupererr</button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-end">
        {{ $fichiers->links() }}
    </div>



</div>

@endsection
