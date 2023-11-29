


@extends('chef.layout')

@section('main')

<div class="">
   

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
                    <th>service</th>
                    <th>Categorie</th>
                    <th>Fichier</th>

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
                    <td>{{ $fich->service ? $fich->service->nom : 'N/A' }}</td>
                    <td>{{ $fich->categorie->nom }}</td>
                    <td>
                        <a href="{{ asset('storage/pdfs/'.$fich->fichier) }}" target="_blank">View PDF</a>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-end">
        {{ $fichiers->links() }}
    </div>

    <script>
        function confirmDelete() {
            return confirm('Voulez-vous supprimer ce fichier ?');
        }
    </script>

</div>

@endsection
