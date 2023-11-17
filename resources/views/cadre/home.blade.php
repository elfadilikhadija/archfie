


@extends('cadre.layout')

@section('main')

<div class="">
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Rechercher..." aria-label="Rechercher">
                <button class="btn btn-outline-secondary" type="button">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>
        <div class="col-md-6 text-end">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-outline-secondary">
                    <i class="bi bi-filter"></i> Filtrer par Destinateur
                </button>
                <button type="button" class="btn btn-outline-secondary">
                    <i class="bi bi-filter"></i> Filtrer par Destinataire
                </button>
                <button type="button" class="btn btn-outline-secondary">
                    <i class="bi bi-filter"></i> Filtrer par Date
                </button>
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
                @foreach ($fichiers as $fichier)
                <tr>
                    <td>{{ $fichier->id }}</td>
                    <td>{{ $fichier->objet }}</td>
                    <td>{{ $fichier->numero }}</td>
                    <td>{{ $fichier->destinateurt }}</td>
                    <td>{{ $fichier->destinataire }}</td>
                    <td>{{ $fichier->date }}</td>
                    <td>{{ $fichier->division->nom }}</td>
                    <td>{{ $fichier->categorie->nom }}</td>
                    <td>
                        <a href="{{ asset('public/pdfs', 'Open the pdf' . $fichier->fichier) }}">{{ $fichier->fichier }}</a>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-primary">Update</button>
                        <button class="btn btn-sm btn-danger">Delete</button>
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
